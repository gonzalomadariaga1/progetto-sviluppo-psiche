<?php

namespace App\Http\Controllers;

use App\Modalidad;
use Illuminate\Http\Request;

class ModalidadController extends Controller
{
    const PERMISSIONS = [
        'create' => 'admin-modalidad-create',
        'show' => 'admin-modalidad-show',
        'edit' => 'admin-modalidad-edit',
        'delete' => 'admin-modalidad-delete',
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
        $rows = Modalidad::orderBy('id')->paginate();

        return view('admin.modalidad.index', [
            'rows' => $rows,
        ]);
    }

    public function create()
    {
        return view('admin.modalidad.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name_it' => 'required|unique:modalidad|max:255',
            'name_es' => 'required|unique:modalidad|max:255',
            'duracion' => 'required|integer',
            'precio' => 'required|integer'
        ]);

        $row = new Modalidad;
        $row->name_it = $request->get('name_it');
        $row->name_es = $request->get('name_es');
        $row->duracion = $request->get('duracion');
        $row->precio = $request->get('precio');

        $row->save();
        toast('La modalildad se ha creado correctamente.','success')->timerProgressBar();
        return redirect()->route('admin.modalidad.index');
    }

    public function show($id)
    {
        $modalidad = Modalidad::findOrFail($id);
        return view('admin.modalidad.show', [ 'row' => $modalidad]);
    }

    public function edit( $id)
    {
        $modalidad = Modalidad::findOrFail($id);
        return view('admin.modalidad.edit', [ 'row' => $modalidad]);
    }

    public function update(Request $request, $id)
    {
        $modalidad = Modalidad::findOrFail($id);
        $modalidad->update($request->all());
        toast('La modalidad se ha actualizado correctamente.','success')->timerProgressBar();
        return redirect()->route('admin.modalidad.index');

    }

    public function destroy($id)
    {
        $modalidad = Modalidad::findOrFail($id);
        $modalidad->delete();
        toast('La modalidad se ha eliminado correctamente.','success')->timerProgressBar();
        return redirect()->route('admin.modalidad.index');

    }

}
