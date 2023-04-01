<?php

namespace App\Http\Controllers;

use App\Faq;
use App\User;
use App\Cupon;
use Illuminate\Http\Request;

class CuponesController extends Controller
{

    const PERMISSIONS = [
        'create' => 'admin-cupones-create',
        'show' => 'admin-cupones-show',
        'edit' => 'admin-cupones-edit',
        'delete' => 'admin-cupones-delete',
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
        $rows = Cupon::orderBy('id')->paginate();
        

        return view('admin.cupones.index', [
            'rows' => $rows,
        ]);
    }

    public function create()
    {
        $user = User::all();
        return view('admin.cupones.create', compact('user'));
    }

    public function store(Request $request)
    {
           
        //dd($request->all());

        $row = new Cupon;
        $row->codigo = $request->get('codigo');
        $row->tipo = $request->get('tipo');

        if( $request->get('tipo') == 'cantidadfija'){
            $row->valor = $request->get('cantidadfija');
        }else{
            $row->valor = $request->get('porcentaje');
        }

        $row->limite_uso = $request->get('limite_uso');
        $row->quedan_por_usar = $request->get('quedan_por_usar');
        $row->multi_uso = $request->get('multi_uso');


        $row->save();

        toast('El cupón se ha creado correctamente.','success')->timerProgressBar();
        return redirect()->route('admin.cupones.index');
    }

    public function show($id)
    {
        $cupones = Cupon::findOrFail($id);
        
        return view('admin.cupones.show', [ 'row' => $cupones]);
    }

    public function edit( $id)
    {
        $cupones = Cupon::findOrFail($id);
        
        return view('admin.cupones.edit', [ 'row' => $cupones]);
    }

    public function update(Request $request, $id)
    {
        
        $row = Cupon::findOrFail($id);
        
        $row->codigo = $request->get('codigo');
        $row->tipo = $request->get('tipo');

        if( $request->get('tipo') == 'cantidadfija'){
            $row->valor = $request->get('cantidadfija');
        }else{
            $row->valor = $request->get('porcentaje');
        }

        $row->limite_uso = $request->get('limite_uso');
        $row->quedan_por_usar = $request->get('quedan_por_usar');
        $row->multi_uso = $request->get('multi_uso');


        $row->update();
        toast('El cupón se ha actualizado correctamente.','success')->timerProgressBar();
        return redirect()->route('admin.cupones.index');

    }

    public function destroy($id)
    {
        
        $cupones = Cupon::findOrFail($id);
        
        $cupones->delete();
        toast('El cupón se ha eliminado correctamente.','success')->timerProgressBar();
        return redirect()->route('admin.cupones.index');

    }
}
