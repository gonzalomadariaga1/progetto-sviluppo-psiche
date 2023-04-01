<?php

namespace App\Services;

use App\User;
use App\Cupon;
use App\Horario;
use App\UsedCupon;
use App\PaymentPlatform;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Traits\ConsumesExternalServices;
use RealRashid\SweetAlert\Facades\Alert;

class StripeService
{
    use ConsumesExternalServices;

    protected $key;

    protected $secret;

    protected $baseUri;

    protected $plans;

    public function __construct()
    {
        $this->baseUri = config('services.stripe.base_uri');
        $this->key = config('services.stripe.key');
        $this->secret = config('services.stripe.secret');
        $this->plans = config('services.stripe.plans');
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
        return "Bearer {$this->secret}";
    }

    public function handlePayment(Request $request)
    {
        //dd($request->all());

        $request->validate([
            'payment_method' => 'required',
        ]);
        

        $currency = 'eur';

        $especialistas_Test = User::where('id',$request->especialista_id)->first();

        $forma_pago = PaymentPlatform::where('id',$request->payment_platform)->first();

        $intent = $this->createIntent($request->valor, $currency, $request->payment_method);

        session()->put('paymentIntentId', $intent->id);
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

        return redirect()->route('approval');
    }

    public function handleApproval()
    {
        $lang = app()->getLocale();
        $dataRequest = session()->get('dataRequest');
        

        if (session()->has('paymentIntentId')) {
            $paymentIntentId = session()->get('paymentIntentId');

            $confirmation = $this->confirmPayment($paymentIntentId);

            if ($confirmation->status === 'requires_action') {
                $clientSecret = $confirmation->client_secret;

                return view('stripe.3d-secure')->with([
                    'clientSecret' => $clientSecret,
                ]);
            }

            if ($confirmation->status === 'succeeded') {

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

                

                $name = $confirmation->charges->data[0]->billing_details->name;
                $currency = strtoupper($confirmation->currency);
                $amount = $confirmation->amount / $this->resolveFactor($currency);

                if ( $lang == "es"){
                    Mail::send('emails.reservaConfirmada', ['dataRequest' => $dataRequest], function($message) use ($dataRequest){
                        $message->to($dataRequest['paciente_email'])
                        ->subject('RESERVA CONFIRMADA');
                    });

                    Mail::send('emails.reservaConfirmadaToEspecialista', ['dataRequest' => $dataRequest], function($message) use ($dataRequest){
                        $message->to($dataRequest['especialista_email'])
                        ->subject('NUEVA CITA');
                    });    
                    Alert::success('Reserva confirmada', "Muchas gracias, {$name}. Hemos recibido tu pago de {$amount} {$currency}. 
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

            }
        }

        if ( $lang == "es"){
            Alert::error('Error', "No pudimos obtener tu pago. Intenta nuevamente.")->autoClose(5000);
            return redirect()->route('inicio');
        }else{
            Alert::error('Errore', "Non siamo riusciti a ricevere il tuo pagamento. Riprova.")->autoClose(5000);
            return redirect()->route('inicio');
        }
    }

    public function handleSubscription(Request $request)
    {
        $customer = $this->createCustomer(
            $request->user()->name,
            $request->user()->email,
            $request->payment_method
        );

        $subscription = $this->createSubscription(
            $customer->id,
            $request->payment_method,
            $this->plans[$request->plan]
        );

        if ($subscription->status == 'active') {
            session()->put('subscriptionId', $subscription->id);

            return redirect()->route(
                'subscribe.approval',
                [
                    'plan' => $request->plan,
                    'subscription_id' => $subscription->id,
                ],
            );
        }

        $paymentIntent = $subscription->latest_invoice->payment_intent;

        if ($paymentIntent->status === 'requires_action') {
            $clientSecret = $paymentIntent->client_secret;

            session()->put('subscriptionId', $subscription->id);

            return view('stripe.3d-secure-subscription')->with([
                'clientSecret' => $clientSecret,
                'plan' => $request->plan,
                'paymentMethod' => $request->payment_method,
                'subscriptionId' => $subscription->id,
            ]);
        }

        return redirect()->route('subscribe.show')
            ->withErrors('We were unable to activate your subscription. Try again, please.');
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

    public function createIntent($value, $currency, $paymentMethod)
    {
        return $this->makeRequest(
            'POST',
            '/v1/payment_intents',
            [],
            [
                'amount' => round($value * $this->resolveFactor($currency)),
                'currency' => strtolower($currency),
                'payment_method' => $paymentMethod,
                'confirmation_method' => 'manual',
            ],
        );
    }

    public function confirmPayment($paymentIntentId)
    {
        return $this->makeRequest(
            'POST',
            "/v1/payment_intents/{$paymentIntentId}/confirm",
        );
    }

    public function createCustomer($name, $email, $paymentMethod)
    {
        return $this->makeRequest(
            'POST',
            '/v1/customers',
            [],
            [
                'name' => $name,
                'email' => $email,
                'payment_method' => $paymentMethod,
            ],
        );
    }

    public function createSubscription($customerId, $paymentMethod, $priceId)
    {
        return $this->makeRequest(
            'POST',
            '/v1/subscriptions',
            [],
            [
                'customer' => $customerId,
                'items' => [
                    ['price' => $priceId],
                ],
                'default_payment_method' => $paymentMethod,
                'expand' => ['latest_invoice.payment_intent']
            ],
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