<?php

namespace App\Http\Requests;


use App\Cita;
use App\Horario;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Foundation\Http\FormRequest;

class ReservaStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * request para la validacion de dia y hora inicio y hora fin
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $r)
    {
        
        return [
            'especialista_id' => 'required',
            'fecha_selected'  => 'required',
            'hora_selected'   =>  ['required','date_format:H:i',
                function($attributes, $value, $fail) use($r){
                   
                    $i_date =  date('Y-m-d H:i:s', strtotime($r->fecha_selected." ".$r->hora_selected));
                    $f_date = date('Y-m-d H:i:s', strtotime($r->fecha_selected." ".$r->hora_selected_fin));

                   $cita = Cita::whereBetween('hora_inicio',[$i_date, $f_date])
                   ->where('modalidad_id','=' ,$r->modalidad_id)
                   ->where('especialista_id','=' ,$r->especialista_id)
                   ->orWhere(function($q) use($i_date, $f_date){
                    $q->whereBetween('hora_fin', [$i_date, $f_date]);
                   })
                   ->orWhere(function ($q) use ($i_date, $f_date, $r) {
                    $q->whereBetween('hora_inicio', [$i_date, $f_date]);
                    })
                    ->orWhere(function ($q) use ($i_date, $f_date, $r) {
                        $q->where("hora_inicio", "<=", $i_date);
                        $q->where("hora_fin", ">=", $f_date);
                      
                    })
                   ->count();
                    //dd($cita);
                   if ($cita >= 1) {
                     
                    Alert::error('Error', "Ya existe una cita entre ese rango de horas.")->autoClose(5000);
                    
                    $fail("Ya existe una cita entre ese rango de horas.");
                 
                  
                   }
                }],
            'hora_selected_fin' => 'required|date_format:H:i', 
            'paciente_email'  => 'required',            
        ];
    }
}
