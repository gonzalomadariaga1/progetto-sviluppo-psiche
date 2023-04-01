<?php

namespace App\Services;



use App\Cita;
use App\User;

use App\CuentaBancaria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;

class TransferenciaService
{
    

    public function handlePayment(Request $request)
    {
        //dd($request->all());

        $lang = app()->getLocale();
        
        $especialista = User::where('id',$request->get('especialista_id'))->select('name','email')->first();

        

        $cita = new Cita;
        $cita->paciente_nombres = $request->get('paciente_nombres');
        $cita->paciente_apellidos = $request->get('paciente_apellidos');
        $cita->paciente_email = $request->get('paciente_email');
        $cita->paciente_telefono = $request->get('paciente_telefono');
        $cita->dia = $request->get('fecha_selected');
        $cita->hora_inicio = $request->get('hora_selected');
        $cita->hora_fin = $request->get('hora_selected_fin');
        $cita->valor = $request->get('valor');
        $cita->estado = 'PENDIENTE';
        $cita->modalidad_id = $request->get('modalidad_id');
        $cita->servicio_id = $request->get('servicio_id');
        $cita->especialista_id = $request->get('especialista_id');
        $cita->cupon_id = $request->get('cupon_id');
        $cita->save();

        $cuenta = CuentaBancaria::first();

        
        if ( $lang == "es"){
            //dd($dataRequest['paciente_email']);
            Mail::send('emails.reservaPorConfirmar', ['request' => $request , 'cuenta' => $cuenta , 'especialista' => $especialista ], 
            function($message) use ($request , $cuenta , $especialista){
                $message->to($request['paciente_email'])
                ->subject('RESERVA POR CONFIRMAR');
            });

            Mail::send('emails.reservaPorConfirmarToEspecialista', ['request' => $request , 'especialista' => $especialista], function($message) use ($request , $especialista){
                $message->to($especialista['email'])
                ->subject('NUEVA RESERVA POR CONFIRMAR');
            });

            Alert::html('Reserva por confirmar', "Muchas gracias, <b>{$request->get('paciente_nombres')} {$request->get('paciente_apellidos')}</b>. Hemos recibido tu solicitud de reserva. Te hemos enviado un mensaje al correo: <b>{$request->get('paciente_email')}</b> con  
             los datos bancarios para la transferencia. Una vez confirmado el pago, se te enviará un nuevo correo electrónico confirmando tu reserva.",'success')->autoClose(30000);
            return redirect()->route('inicio');
        }else{

            Mail::send('emails.reservaPorConfirmarit', ['request' => $request , 'cuenta' => $cuenta , 'especialista' => $especialista ], 
            function($message) use ($request , $cuenta , $especialista){
                $message->to($request['paciente_email'])
                ->subject('PRENOTAZIONE DA CONFERMARE');
            });

            Mail::send('emails.reservaPorConfirmarToEspecialista', ['request' => $request , 'especialista' => $especialista], function($message) use ($request , $especialista){
                $message->to($especialista['email'])
                ->subject('NUEVA RESERVA POR CONFIRMAR');
            });

            Alert::html('Prenotazione da confermare', "Grazie mille, <b>{$request->get('paciente_nombres')} {$request->get('paciente_apellidos')}</b>. Abbiamo ricevuto la tua richiesta di prenotazione. Ti abbiamo inviato un messaggio all'e-mail: <b>{$request->get('paciente_email')}</b> con le coordinate bancarie per il bonifico. Una volta confermato il pagamento, ti verrà inviata una nuova email di conferma della prenotazione.",'success')->autoClose(30000);
            return redirect()->route('inicio');
        }

        
    }

}