<?php

namespace App\Http\Controllers;

use App\Etiqueta;
use Illuminate\Http\Request;

class EtiquetaController extends Controller
{
    const PERMISSIONS = [
        'create' => 'admin-etiqueta-create',
        'show' => 'admin-etiqueta-show',
        'edit' => 'admin-etiqueta-edit',
        'delete' => 'admin-etiqueta-delete',
    ];

    public function __construct()
    {
        $this->middleware('permission:'.self::PERMISSIONS['create'])->only(['create', 'store']);
        $this->middleware('permission:'.self::PERMISSIONS['show'])->only(['index', 'show']);
        $this->middleware('permission:'.self::PERMISSIONS['edit'])->only(['edit', 'update']);
        $this->middleware('permission:'.self::PERMISSIONS['delete'])->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rows = Etiqueta::orderBy('id')->paginate();

        return view('admin.etiquetas.index', [
            'rows' => $rows,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.etiquetas.create', [
            'row' => new Etiqueta()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name_it' => 'required|unique:etiquetas|max:255',
            'name_es' => 'required|unique:etiquetas|max:255',
            'description_it' => 'required|max:255',
            'description_es' => 'required|max:255',
        ]);

        $row = new Etiqueta;
        $row->name_it = $request->get('name_it');
        $row->name_es = $request->get('name_es');
        $row->description_it = $request->get('description_it');
        $row->description_es = $request->get('description_es');

        $row->save();
        toast('La etiqueta se ha creado correctamente.','success')->timerProgressBar();
        return redirect()->route('admin.etiquetas.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Etiqueta  $etiqueta
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $etiqueta = Etiqueta::findOrFail($id);
        return view('admin.etiquetas.show', [ 'row' => $etiqueta]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Etiqueta  $etiqueta
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        $etiqueta = Etiqueta::findOrFail($id);
        return view('admin.etiquetas.edit', [ 'row' => $etiqueta]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Etiqueta  $etiqueta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $etiqueta = Etiqueta::findOrFail($id);
        $etiqueta->update($request->all());
        toast('La etiqueta se ha actualizado correctamente.','success')->timerProgressBar();
        return redirect()->route('admin.etiquetas.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Etiqueta  $etiqueta
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $etiqueta = Etiqueta::findOrFail($id);
        $etiqueta->delete();
        toast('La etiqueta se ha eliminado correctamente.','success')->timerProgressBar();
        return redirect()->route('admin.etiquetas.index');

    }
}
