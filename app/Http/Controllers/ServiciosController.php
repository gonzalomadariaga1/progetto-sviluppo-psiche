<?php

namespace App\Http\Controllers;

use App\User;
use App\Servicio;
use Illuminate\Http\Request;

class ServiciosController extends Controller
{
    const PERMISSIONS = [
        'create' => 'admin-servicios-create',
        'show' => 'admin-servicios-show',
        'edit' => 'admin-servicios-edit',
        'delete' => 'admin-servicios-delete',
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
        $rows = Servicio::orderBy('id')->paginate();

        return view('admin.servicios.index', [
            'rows' => $rows,
        ]);
    }

    public function create()
    {
        $user = User::all();
        return view('admin.servicios.create', compact('user'));
    }

    public function store(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'name_it' => 'required|unique:servicios|max:255',
            'name_es' => 'required|unique:servicios|max:255',
            'user_id' => 'required'
        ]);

        $row = new Servicio;
        $row->name_it = $request->get('name_it');
        $row->name_es = $request->get('name_es');
        $row->user_id = $request->get('user_id');

        $row->save();
        toast('El servicio se ha creado correctamente.','success')->timerProgressBar();
        return redirect()->route('admin.servicios.index');
    }

    public function show($id)
    {
        $servicios = Servicio::findOrFail($id);
        $user = User::all();
        return view('admin.servicios.show', [ 'row' => $servicios, 'user' => $user]);
    }

    public function edit( $id)
    {
        $servicios = Servicio::findOrFail($id);
        $especialistas = User::all();
        return view('admin.servicios.edit', [ 'row' => $servicios, 'especialistas' => $especialistas]);
    }

    public function update(Request $request,  $id)
    {
        //dd($request->all());
        $servicios = Servicio::findOrFail($id);
        $servicios->update($request->all());
        toast('El servicio se ha actualizado correctamente.','success')->timerProgressBar();
        return redirect()->route('admin.servicios.index');

    }

    public function destroy($id)
    {
        $servicios = Servicio::findOrFail($id);
        $servicios->delete();
        toast('El servicio se ha eliminado correctamente.','success')->timerProgressBar();
        return redirect()->route('admin.servicios.index');

    }
}
