<?php

namespace App\Http\Controllers;

use App\Dia;
use App\Cita;
use App\Hora;
use App\User;
use App\Horario;
use App\Etiqueta;
use App\Modalidad;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HorarioController extends Controller
{
    const PERMISSIONS = [
        'create' => 'admin-horario-create',
        'show' => 'admin-horario-show',
        'edit' => 'admin-horario-edit',
        'delete' => 'admin-horario-delete',
    ];

    public function __construct()
    {
        $this->middleware('permission:'.self::PERMISSIONS['create'])->only(['create', 'store']);
        $this->middleware('permission:'.self::PERMISSIONS['show'])->only(['index', 'show']);
        $this->middleware('permission:'.self::PERMISSIONS['edit'])->only(['edit', 'update']);
        $this->middleware('permission:'.self::PERMISSIONS['delete'])->only('destroy');
    }
    public function index()
    {
        $rows = Etiqueta::orderBy('id')->paginate();

        return view('admin.horario.index', [
             'rows' => $rows,
        ]);
    }

    public function create(){
        $users = User::all();
        $modalidades = Modalidad::all();
        return view('admin.horario.create', compact('users','modalidades'));
    }

    public function store(Request $request){

        dd($request->all());
     
        $array_dias = $request['dia'];
        $array_hora_i = $request['hora_inicio'];
        $array_hora_f = $request['hora_fin'];
      

      
        
       
      $data = []; 
        foreach ($array_dias as $key => $dias) {
            foreach ($array_hora_i as $key_i => $h_i) {
                  foreach ($array_hora_f as $key_f => $h_f) {
                  if($key_i == $key_f){
                        $data []  = [
                            'especialista_id' => $request->especialista_id,
                            'modalidad_id' => $request->modalidad_id,
                            'dia'         => $dias,
                            'hora_inicio' => $h_i,
                            'hora_fin'    => $h_f
                        ];                
                    }
                  }
            }
        }
        
        foreach ($data as $key => $value) {
            $cita =  new Horario ;
            $cita->especialista_id = $value['especialista_id'];
            $cita->modalidad_id = $value['modalidad_id'];
            $cita->dia = $value['dia'];
            $cita->hora_inicio = $value['hora_inicio'];
            $cita->hora_fin = $value['hora_fin'];
            $cita->save();
        }
       

        toast('El horario se ha creado correctamente.','success')->timerProgressBar();
        return redirect()->route('admin.horario.index');
    }

    public function get_horarios(){

        
        $horarios_json = DB::table('horarios')
                    ->join('users','horarios.especialista_id','=','users.id')
                    ->join('modalidad','horarios.modalidad_id','=','modalidad.id')
                    ->select('horarios.*','users.name as especialista_name','modalidad.name_es as modalidad_name')
                    ->orderby('id','desc')
                    ->get();
        
       

        $data = [];
        $results = [];

        
        foreach($horarios_json as $horario){
            $row[0]=$horario->id;
            $row[1]=$horario->dia;
            $row[1]=Carbon::createFromFormat('d-m-Y', $horario->dia)->format('Y-m-d');
            $row[2]=$horario->hora_inicio;
            $row[3]=$horario->hora_fin;
            if ($horario->estado == 'DISPONIBLE' ){
                $row[4]='
                        <div class="text-center">
                            <span class="badge bg-success">Disponible</span>
                        </div>
                        ';
            }else{
                $row[4]='
                        <div class="text-center">
                            <span class="badge bg-danger">Reservada</span></i>
                        </div>
                        ';
   
            }
            $row[5]=$horario->especialista_name;
            $row[6]=$horario->modalidad_name;
            $row[7]='<div class="btn-group btn-group-sm">
                    
                    <a href="/horario/'.$horario->id.'/edit" class="btn btn-primary-violet btn-sm" style="margin-right:3px;"><i class="bi bi-pencil-square"></i></a>
                    <a href="#" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal" data-usuid='.$horario->id.'><i class="bi bi-x-lg"></i></a>
                    </div> 
                    ';

            
            // $row[6]='<div class="btn-group btn-group-sm">
            //         <a href="/ventas/'.$productos_json->id.'/" class="btn btn-primary" style="margin-right:3px;"><i class="fas fa-eye"></i></a>
            //         <a href="/ventas/'.$productos_json->id.'/edit" class="btn btn-primary" style="margin-right:3px;"><i class="fas fa-edit"></i></a>
                    
                    
            //         </div> 
            //         ';
            $data[]=$row;
        }

        $results = [
            "sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data

        ];

        return json_encode($results);
    }

    public function show(){

    }

    public function edit($id){
        $horario = Horario::findOrFail($id);
        $especialistas = User::all();
        return view('admin.horario.edit', compact('horario','especialistas'));
    }

    public function update(Request $request, $id){
        //dd($request->all());

        $horario = Horario::findOrFail($id);

        $horario->especialista_id = $request->get('especialista_id');
        $horario->hora_inicio = $request->get('hora_inicio');
        $horario->hora_fin = $request->get('hora_fin');

        $newfecha = $request->get('newfecha');

        if ($newfecha == null ){
            $horario->dia = $request->get('oldfecha');
            $horario->update();
            toast('El horario se ha actualizado correctamente.','success')->timerProgressBar();
            return redirect()->route('admin.horario.index');
        }else{
            $horario->dia = $request->get('newfecha');
            $horario->update();
            toast('El horario se ha actualizado correctamente.','success')->timerProgressBar();
            return redirect()->route('admin.horario.index');
        }
        

    }

    public function destroy($id)
    {
        $horario = Horario::findOrFail($id);
        $horario->delete();
        toast('El horario se ha eliminado correctamente.','success')->timerProgressBar();
        return redirect()->route('admin.horario.index');
    }

    public function selected_reservadas(Request $request) {
        $respuesta = $request->all();
        $data = $request->data;
        $cont = 0;
        
        
    
        while ($cont < count($data)){
            $horario = Horario::findOrFail($data[$cont]);
            $horario->estado = 'RESERVADA';
           
            $horario->update();
            
            $cont=$cont+1;
        }

        return 1; 


        
    }

    public function selected_disponibles(Request $request){
        $respuesta = $request->all();
        $data = $request->data;
        $cont = 0;
        
        
    
        while ($cont < count($data)){
            $horario = Horario::findOrFail($data[$cont]);
            $horario->estado = 'DISPONIBLE';
           
            $horario->update();
            
            $cont=$cont+1;
        }

        return 1; 

    }

    public function selected_delete(Request $request){
        $respuesta = $request->all();
        $data = $request->data;
        $cont = 0;
        
        
    
        while ($cont < count($data)){
            $horario = Horario::findOrFail($data[$cont]);
            $horario->delete();
           
            
            
            $cont=$cont+1;
        }

        return 1; 

    }
}
