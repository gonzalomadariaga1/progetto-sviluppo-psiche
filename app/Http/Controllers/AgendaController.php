<?php

namespace App\Http\Controllers;

use App\Cita;
use App\Evento;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AgendaController extends Controller
{
    const PERMISSIONS = [
        'show' => 'admin-miagenda-show',
    ];

    public function __construct()
    {
        $this->middleware('permission:'.self::PERMISSIONS['show'])->only(['index', 'show','store','show','edit']);
    }

    public function index(){

        return view('admin.agenda.index');
    }

    public function store(Request $request){
        
        //dd($request->all());
        request()->validate(Evento::$rules);
        $evento = Evento::create($request->all());
    }

    public function show(Evento $evento){

        $id_user = Auth::user()->id;
        $evento = Cita::where('especialista_id',$id_user)->where('estado','APROBADA')->get();

        //dd($evento);

        
        $data = [];
        for ($cont = 0 ; $cont < count($evento) ; $cont++){

            $start = $evento[$cont]->dia .' '. $evento[$cont]->hora_inicio;
            $end = $evento[$cont]->dia .' '. $evento[$cont]->hora_fin;
            
            $data[] = [
                'id' => $evento[$cont]->id,
                'title' => $evento[$cont]->paciente_nombres.' '.$evento[$cont]->paciente_apellidos,
                'description' => $evento[$cont]->paciente_email,
                'start' => Carbon::createFromFormat('d-m-Y H:i', $start)->format('Y-m-d H:i:s'),
                'end' => Carbon::createFromFormat('d-m-Y H:i', $end)->format('Y-m-d H:i:s')
            ];
            
        }

        return response()->json($data);
    }

    public function edit($id){
        //dd("llegue aca");
        

        $evento = DB::table('citas')
            ->join('modalidad','citas.modalidad_id','=','modalidad.id')
            ->join('servicios','citas.servicio_id','=','servicios.id')
            ->join('users','citas.especialista_id','=','users.id')
            ->select('citas.*' , 'servicios.name_es as servicio_name','modalidad.name_es','modalidad.precio')
            ->orderBy('id','ASC')
            ->where('citas.id','=',$id)
            ->first();
        
        //dd($evento);
        return response()->json($evento);
    }
}
