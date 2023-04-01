<?php

namespace App\Http\Controllers;

use App\User;
use App\Paquete;
use Illuminate\Http\Request;

class PaquetesController extends Controller
{
    const PERMISSIONS = [
        'create' => 'admin-paquetes-create',
        'show' => 'admin-paquetes-show',
        'edit' => 'admin-paquetes-edit',
        'delete' => 'admin-paquetes-delete',
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
        $rows = Paquete::orderBy('id')->paginate();

        return view('admin.paquetes.index', [
            'rows' => $rows,
        ]);
    }

    public function create()
    {
        $user = User::all();
        return view('admin.paquetes.create', compact('user'));
    }

    public function store(Request $request)
    {
        
        $request->validate([
            'name_it' => 'required|unique:paquetes|max:255',
            'name_es' => 'required|unique:paquetes|max:255',
            'duracion' => 'required|integer',
            'precio' => 'required|integer',
            'descuento' => 'required|integer',
            'user_id' => 'required'
        ]);

        $row = new Paquete;
        $row->name_it = $request->get('name_it');
        $row->name_es = $request->get('name_es');
        $row->duracion = $request->get('duracion');
        $row->precio = $request->get('precio');
        $row->descuento = $request->get('descuento');
        $row->user_id = $request->get('user_id');

        $row->save();
        toast('El paquete se ha creado correctamente.','success')->timerProgressBar();
        return redirect()->route('admin.paquetes.index');
    }

    public function show($id)
    {
        $paquete = Paquete::findOrFail($id);
        $user = User::all();
        return view('admin.paquetes.show', [ 'row' => $paquete, 'user' => $user]);
    }

    public function edit( $id)
    {
        $paquete = Paquete::findOrFail($id);
        $user = User::all();
        return view('admin.paquetes.edit', [ 'row' => $paquete, 'especialistas' => $user]);
    }

    public function update(Request $request, $id)
    {
        $paquete = Paquete::findOrFail($id);
        $paquete->update($request->all());
        toast('El paquete se ha actualizado correctamente.','success')->timerProgressBar();
        return redirect()->route('admin.paquetes.index');

    }

    public function destroy($id)
    {
        $paquete = Paquete::findOrFail($id);
        $paquete->delete();
        toast('El paquete se ha eliminado correctamente.','success')->timerProgressBar();
        return redirect()->route('admin.paquetes.index');

    }
}
