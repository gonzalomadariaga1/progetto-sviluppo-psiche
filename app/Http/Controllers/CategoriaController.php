<?php

namespace App\Http\Controllers;

use App\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    const PERMISSIONS = [
        'create' => 'admin-categoria-create',
        'show' => 'admin-categoria-show',
        'edit' => 'admin-categoria-edit',
        'delete' => 'admin-categoria-delete',
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
        $rows = Categoria::orderBy('id')->paginate();

        return view('admin.categorias.index', [
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
        return view('admin.categorias.create', [
            'row' => new Categoria()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Categoria $categoria)
    {
        $request->validate([
            'name_it' => 'required|unique:categorias|max:255',
            'name_es' => 'required|unique:categorias|max:255',
            'description_it' => 'required|unique:categorias|max:255',
            'description_es' => 'required|unique:categorias|max:255',
        ]);

        $categoria->my_store($request);


        toast('La categoría se ha creado correctamente.','success')->timerProgressBar();
        return redirect()->route('admin.categorias.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $categoria = Categoria::findOrFail($id);

        return view('admin.categorias.show', [ 'row' => $categoria]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        
        $categoria = Categoria::findOrFail($id);
        
        return view('admin.categorias.edit', [ 'row' => $categoria]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Categoria $categoria)
    {
        // $request->validate([
        //     'name_it' => 'required|unique:categorias|max:255',
        //     'name_es' => 'required|unique:categorias|max:255',
        //     'description_it' => 'required|unique:categorias|max:255',
        //     'description_es' => 'required|unique:categorias|max:255',
        // ]);


        $categoria->my_update($request);


        toast('La categoría se ha actualizado correctamente.','success')->timerProgressBar();
        return redirect()->route('admin.categorias.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $categoria = Categoria::findOrFail($id);
        $categoria->delete();
        toast('La categoría se ha eliminado correctamente.','success')->timerProgressBar();
        return redirect()->route('admin.categorias.index');

    }
}
