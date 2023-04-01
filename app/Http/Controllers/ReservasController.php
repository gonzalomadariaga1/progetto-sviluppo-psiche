<?php

namespace App\Http\Controllers;

use App\Cita;
use App\User;
use App\Cupon;
use App\Horario;
use App\UsedCupon;
use App\CuentaBancaria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;

class ReservasController extends Controller
{
    const PERMISSIONS = [
        'cuentabancaria' => 'admin-cuentanbancaria',
        'reservasporconfirmar' => 'admin-reservasporconfirmar',
    ];

    public function __construct()
    {
        $this->middleware('permission:'.self::PERMISSIONS['cuentabancaria'])->only(['update', 'cuenta_bancaria' ,'edit_cuenta_bancaria']);
        $this->middleware('permission:'.self::PERMISSIONS['reservasporconfirmar'])->only(['index','aprobar_cita', 'rechazar_cita' , 'show']);

    }
    public function index(){

        $rows = Cita::where('estado','PENDIENTE')->get();
        
        return view('admin.reservas.index', [
            'rows' => $rows
        ]);
    }

    public function update(Request $request, $id){
        
        //dd($request->all());
        
        $request->validate([
            'banco' => 'required',
            'tipo_cuenta' => 'required',
            'numero_cuenta' => 'required',
            'bic_swift' => 'required',
            'nombre_persona' => 'required',
            'email' => 'required|email',
            'especialista_id' => 'required',
        ]);

        $cuenta = CuentaBancaria::findOrFail($id);
        
        $cuenta->update($request->all());
        toast('La cuenta bancaria se ha actualizada correctamente.','success')->timerProgressBar();
        return redirect()->route('admin.reservas.cuenta-bancaria');


    }

    public function cuenta_bancaria(){

        $row = CuentaBancaria::first();
        $users = User::all();

        return view('admin.reservas.cuenta-bancaria', [
            'row' => $row,
            'users' => $users,
        ]);
    }

    public function edit_cuenta_bancaria(){

        $row = CuentaBancaria::first();
        $users = User::all();
        //dd($row);

        return view('admin.reservas.edit-cuenta-bancaria', [
            'row' => $row,
            'users' => $users,
        ]);

    }


    public function aprobar_cita($id){

        $lang = app()->getLocale();

        $cita = Cita::findOrFail($id);

        $especialista = User::where('id',$cita->especialista_id)->select('name','email')->first();

        $hora = Horario::where('dia',$cita->dia)->where('hora_inicio',$cita->hora_inicio)->first();

        $hora->estado = 'RESERVADA';
        $hora->update();

        $cita->estado = 'APROBADA';
        $cita->update();

        //AQUI PARTE DE CUPON, VERIFICAR SI TIENE LIMITE, EN CASO DE QUE SI, DESCONTAR STOCK

        $cupon = Cupon::where('id',$cita->cupon_id)->first();

        //dd($cupon);
        
        if ( $cupon != null ){
            if( $cupon->limite_uso == 1 ){
                $cantidad_uso = $cupon->quedan_por_usar;
                $nueva_cantidad_uso = ( $cantidad_uso - 1);
                $actualizar_stock = Cupon::findOrFail($cupon->id);
                $actualizar_stock->quedan_por_usar = $nueva_cantidad_uso;
                $actualizar_stock->update();
    
                //se usa el cupon 
    
                $usar_cupon = new UsedCupon;
                $usar_cupon->cupon_id = $cupon->id;
                $usar_cupon->email_paciente = $cita->paciente_email;
                $usar_cupon->telefono_paciente = $cita->paciente_telefono;
                $usar_cupon->save();
            }else{
    
                //se usa el cupon 
    
                $usar_cupon = new UsedCupon;
                $usar_cupon->cupon_id = $cupon->id;
                $usar_cupon->email_paciente = $cita->paciente_email;
                $usar_cupon->telefono_paciente = $cita->paciente_telefono;
                $usar_cupon->save();
    
            }
        }

        
        

        //AQUI CORREO ELECTRONICO

        if ( $lang == "es"){
            //dd($dataRequest['paciente_email']);
            
            Mail::send('emails.check_reservas.reservaConfirmada', ['cita' => $cita], function($message) use ($cita){
                $message->to($cita['paciente_email'])
                ->subject('RESERVA CONFIRMADA');
            });

            Mail::send('emails.check_reservas.reservaConfirmadaToEspecialista', ['cita' => $cita, 'especialista' => $especialista], function($message) use ($cita){
                $message->to($cita->especialista['email'])
                ->subject('NUEVA CITA');
            });

            Alert::success('¡Buen trabajo!', 'La reserva ha sido aprobado exitosamente. Se ha enviado un correo electrónico al paciente y al especialista con los detalles.');
            return redirect()->route('admin.reservas.index');
        }else{

            Mail::send('emails.check_reservas.reservaConfirmadait', ['cita' => $cita], function($message) use ($cita){
                $message->to($cita['paciente_email'])
                ->subject('PRENOTAZIONE CONFERMATA');
            });

            Mail::send('emails.check_reservas.reservaConfirmadaToEspecialista', ['cita' => $cita, 'especialista' => $especialista], function($message) use ($cita){
                $message->to($cita->especialista['email'])
                ->subject('NUEVA CITA');
            });

            Alert::success('¡Buen trabajo!', 'La reserva ha sido aprobada exitosamente. Se ha enviado un correo electrónico al paciente y al especialista con los detalles.');
            return redirect()->route('admin.reservas.index');
        }

        
    }

    public function rechazar_cita($id){

        //dd("rechazarcita",$id);

        $cita = Cita::findOrFail($id);
        $cita->estado = 'ANULADA';
        $cita->update();

        //AQUI CORREO ELECTRONICO

        Alert::success('¡Buen trabajo!', 'La reserva ha sido anulada exitosamente');
        return redirect()->route('admin.reservas.index');



    }

    public function show($id){
        $cita = Cita::findOrFail($id);

        

        return view('admin.reservas.show', [
            'row' => $cita
        ]);
    }

    // 
    public function destroy($id){
        //
    }
    public function create(){
        //
    }

    
    public function store(Request $request){
      //  
    }
    
    public function edit($id){
        //
    }

   
    

    
}
