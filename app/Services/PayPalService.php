<?php

namespace App\Services;

use App\Cita;
use App\User;
use App\Cupon;
use App\Horario;
use App\UsedCupon;
use App\PaymentPlatform;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Traits\ConsumesExternalServices;
use RealRashid\SweetAlert\Facades\Alert;

class PayPalService
{
    use ConsumesExternalServices;

    protected $baseUri;

    protected $clientId;

    protected $clientSecret;

    protected $plans;

    public function __construct()
    {
        $this->baseUri = config('services.paypal.base_uri');
        $this->clientId = config('services.paypal.client_id');
        $this->clientSecret = config('services.paypal.client_secret');
        $this->plans = config('services.paypal.plans');
    }

    public function resolveAuthorization(&$queryParams, &$formParams, &$headers)
    {
        $headers['Authorization'] = $this->resolveAccessToken();
    }

    public function decodeResponse($response)
    {
        return json_decode($response);
    }

    public function resolveAccessToken()
    {
        $credentials = base64_encode("{$this->clientId}:{$this->clientSecret}");

        return "Basic {$credentials}";
    }

    public function handlePayment(Request $request)
    {
        //dd($request->all());

        $currency = 'eur';
        $order = $this->createOrder($request->valor, $currency);

        $orderLinks = collect($order->links);

        $approve = $orderLinks->where('rel', 'approve')->first();

        $especialistas_Test = User::where('id',$request->especialista_id)->first();

        $forma_pago = PaymentPlatform::where('id',$request->payment_platform)->first();

        
        session()->put('approvalId', $order->id);
        session()->put('dataRequest', [
            'servicio_id' => $request->get('servicio'), //esto es el nombre de servicio
            'servicio_id_orig' => $request->get('servicio_id'), //esto es el nombre de servicio
            'modalidad_id' => $request->get('modalidad'), //esto es el nombre de modalidad
            'modalidad_id_orig' => $request->get('modalidad_id'), //esto es el nombre de modalidad
            'especialista_id_orig' => $request->get('especialista_id'), //
            'especialista_id' => $especialistas_Test->name,
            'especialista_email' => $especialistas_Test->email,
            'fecha_selected' => $request->get('fecha_selected'),
            'hora_selected' => $request->get('hora_selected'),
            'hora_selected_fin' => $request->get('hora_selected_fin'),
            'paciente_nombres' => $request->get('paciente_nombres'),
            'paciente_apellidos' => $request->get('paciente_apellidos'),
            'paciente_email' => $request->get('paciente_email'),
            'paciente_telefono' => $request->get('paciente_telefono'),
            'valor' => $request->get('valor'),
            'cupon_id' => $request->get('cupon_id'),
            'tiene_limite' => $request->get('tiene_limite'),
            'payment_platform' => $forma_pago->name,
        ]);
        
        
        return redirect($approve->href);
    }

    public function handleApproval()
    {

        $lang = app()->getLocale();
        
        $dataRequest = session()->get('dataRequest');

        
        
        if (session()->has('approvalId')) {
            $approvalId = session()->get('approvalId');

            //SECCION DE CUPON
            if ($dataRequest['cupon_id'] != null ){

                $existecupon = Cupon::where('id',$dataRequest['cupon_id'])->first();
                
                if ( $dataRequest['tiene_limite'] == 'si' ){
                    
                    $cantidad_usos = $existecupon->quedan_por_usar;
                    $nueva_cantidad_uso = ( $cantidad_usos - 1);
                    $actualizar_stock = Cupon::findOrFail($existecupon->id);
                    $actualizar_stock->quedan_por_usar = $nueva_cantidad_uso;
                    $actualizar_stock->update();

                    //se usa el cupon 

                    $usar_cupon = new UsedCupon;
                    $usar_cupon->cupon_id = $existecupon->id;
                    $usar_cupon->email_paciente = $dataRequest['paciente_email'];
                    $usar_cupon->telefono_paciente = $dataRequest['paciente_telefono'];
                    $usar_cupon->save();
                }else{
                    $usar_cupon = new UsedCupon;
                    $usar_cupon->cupon_id = $existecupon->id;
                    $usar_cupon->email_paciente = $dataRequest['paciente_email'];
                    $usar_cupon->telefono_paciente = $dataRequest['paciente_telefono'];
                    $usar_cupon->save();
                }

            }

            //SECCION CREAR CITA
            $cita = new Cita;
            $cita->paciente_nombres = $dataRequest['paciente_nombres'];
            $cita->paciente_apellidos = $dataRequest['paciente_apellidos'];
            $cita->paciente_email = $dataRequest['paciente_email'];
            $cita->paciente_telefono = $dataRequest['paciente_telefono'];
            $cita->dia = $dataRequest['fecha_selected'];
            $cita->hora_inicio = $dataRequest['hora_selected'];
            $cita->hora_fin = $dataRequest['hora_selected_fin'];
            $cita->valor = $dataRequest['valor'];
            $cita->estado = 'APROBADA';
            $cita->modalidad_id = $dataRequest['modalidad_id_orig'];
            $cita->servicio_id = $dataRequest['servicio_id_orig'];
            $cita->especialista_id = $dataRequest['especialista_id_orig'];
            $cita->cupon_id = $dataRequest['cupon_id'];
            $cita->save();

            $change_state = Horario::where('dia',$dataRequest['fecha_selected'])
                ->where('hora_inicio',$dataRequest['hora_selected'])
                ->first();

            $change_state->estado = 'RESERVADA';
            $change_state->update();
            

            $payment = $this->capturePayment($approvalId);

           

            $name = $payment->payer->name->given_name;
            $payment = $payment->purchase_units[0]->payments->captures[0]->amount;
            $amount = $payment->value;
            $currency = $payment->currency_code;

            

            if ( $lang == "es"){
                //dd($dataRequest['paciente_email']);
                
                Mail::send('emails.reservaConfirmada', ['dataRequest' => $dataRequest], function($message) use ($dataRequest){
                    $message->to($dataRequest['paciente_email'])
                    ->subject('RESERVA CONFIRMADA');
                });

                Mail::send('emails.reservaConfirmadaToEspecialista', ['dataRequest' => $dataRequest], function($message) use ($dataRequest){
                    $message->to($dataRequest['especialista_email'])
                    ->subject('NUEVA CITA');
                });

                Alert::success('Reserva confirmada', "Muchas gracias, {$name}. Hemos recibido tu pago de {$amount}{$currency}. 
                Te hemos enviado un correo electrónico con mas detalles.")->autoClose(10000);
                return redirect()->route('inicio');
            }else{

                Mail::send('emails.reservaConfirmadait', ['dataRequest' => $dataRequest], function($message) use ($dataRequest){
                    $message->to($dataRequest['paciente_email'])
                    ->subject('PRENOTAZIONE CONFERMATA');
                });

                Mail::send('emails.reservaConfirmadaToEspecialista', ['dataRequest' => $dataRequest], function($message) use ($dataRequest){
                    $message->to($dataRequest['especialista_email'])
                    ->subject('NUEVA CITA');
                });

                Alert::success('Prenotazione confermata', "Grazie mille, {$name}. Abbiamo ricevuto il tuo pagamento da {$amount}{$currency}. 
                Ti abbiamo inviato un'e-mail con maggiori dettagli.")->autoClose(10000);
                return redirect()->route('inicio');
            }

            // return redirect()
            //     ->route('home')
            //     ->withSuccess(['payment' => "Thanks, {$name}. We received your {$amount}{$currency} payment."]);
        }

        if ( $lang == "es"){
            Alert::error('Error', "No pudimos obtener tu pago. Intenta nuevamente.")->autoClose(5000);
            return redirect()->route('inicio');
        }else{
            Alert::error('Errore', "Non siamo riusciti a ricevere il tuo pagamento. Riprova.")->autoClose(5000);
            return redirect()->route('inicio');
        }

        // Alert::error('Error Title', 'Error Message');
        // return redirect()
        //     ->route('home')
        //     ->withErrors('We cannot capture your payment. Try again, please');
    }

    public function handleSubscription(Request $request)
    {
        $subscription = $this->createSubscription(
            $request->plan,
            $request->user()->name,
            $request->user()->email
        );

        $subscriptionLinks = collect($subscription->links);

        $approve = $subscriptionLinks->where('rel', 'approve')->first();

        session()->put('subscriptionId', $subscription->id);

        return redirect($approve->href);
    }

    public function validateSubscription(Request $request)
    {
        if (session()->has('subscriptionId')) {
            $subscriptionId = session()->get('subscriptionId');

            session()->forget('subscriptionId');

            return $request->subscription_id == $subscriptionId;
        }

        return false;
    }

    public function createOrder($value, $currency)
    {
        return $this->makeRequest(
            'POST',
            '/v2/checkout/orders',
            [],
            [
                'intent' => 'CAPTURE',
                'purchase_units' => [
                    0 => [
                        'amount' => [
                            'currency_code' => strtoupper($currency),
                            'value' => round($value * $factor = $this->resolveFactor($currency)) / $factor,
                        ]
                    ]
                ],
                'application_context' => [
                    'brand_name' => config('app.name'),
                    'shipping_preference' => 'NO_SHIPPING',
                    'user_action' => 'PAY_NOW',
                    'return_url' => route('approval'),
                    'cancel_url' => route('cancelled'),
                ]
            ],
            [],
            $isJsonRequest = true,
        );
    }

    public function capturePayment($approvalId)
    {
        return $this->makeRequest(
            'POST',
            "/v2/checkout/orders/{$approvalId}/capture",
            [],
            [],
            [
                'Content-Type' => 'application/json',
            ],
        );
    }

    public function createSubscription($planSlug, $name, $email)
    {
        return $this->makeRequest(
            'POST',
            '/v1/billing/subscriptions',
            [],
            [
                'plan_id' => $this->plans[$planSlug],
                'subscriber' => [
                    'name' => [
                        'given_name' => $name,
                    ],
                    'email_address' => $email,
                ],
                'application_context' => [
                    'brand_name' => config('app.name'),
                    'shipping_preference' => 'NO_SHIPPING',
                    'user_action' => 'SUBSCRIBE_NOW',
                    'return_url' => route('subscribe.approval', ['plan' => $planSlug]),
                    'cancel_url' => route('subscribe.cancelled'),
                ]
            ],
            [],
            $isJsonRequest = true,
        );
    }

    public function resolveFactor($currency)
    {
        $zeroDecimalCurrencies = ['JPY'];

        if (in_array(strtoupper($currency), $zeroDecimalCurrencies)) {
            return 1;
        }

        return 100;
    }
}