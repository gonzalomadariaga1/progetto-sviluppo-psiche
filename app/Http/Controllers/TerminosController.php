<?php

namespace App\Http\Controllers;

use App\Termino;
use Illuminate\Http\Request;

class TerminosController extends Controller
{
    const PERMISSIONS = [
        'create' => 'admin-terminos-create',
        'show' => 'admin-terminos-show',
        'edit' => 'admin-terminos-edit',
        'delete' => 'admin-terminos-delete',
    ];

    public function __construct()
    {
        $this->middleware('permission:'.self::PERMISSIONS['create'])->only(['create', 'store']);
        $this->middleware('permission:'.self::PERMISSIONS['show'])->only(['index', 'show']);
        $this->middleware('permission:'.self::PERMISSIONS['edit'])->only(['edit', 'update']);
        $this->middleware('permission:'.self::PERMISSIONS['delete'])->only('destroy');
    }

    public function index(){

        $rows = Termino::orderBy('id')->paginate();

        return view('admin.terms.index', [
            'rows' => $rows,
        ]);
    }

    public function create()
    {
        
        return view('admin.terms.create');
    }

    public function store(Request $request)
    {
           
        //dd($request->all());

        $row = new Termino;
        $row->title_it = $request->get('title_it');
        $row->title_es = $request->get('title_es');
        $row->content_it = $request->get('content_it');
        $row->content_es = $request->get('content_es');


        $row->save();

        toast('El TyC se ha creado correctamente.','success')->timerProgressBar();
        return redirect()->route('admin.terms.index');
    }

    public function edit( $id)
    {
        $termino = Termino::findOrFail($id);
        
        return view('admin.terms.edit', [ 'row' => $termino]);
    }

    public function update(Request $request, $id)
    {
        $termino = Termino::findOrFail($id);
        $termino->update($request->all());
        toast('El TyC se ha actualizado correctamente.','success')->timerProgressBar();
        return redirect()->route('admin.terms.index');

    }

    public function destroy($id)
    {
        $termino = Termino::findOrFail($id);
        $termino->delete();
        toast('El TyC se ha eliminado correctamente.','success')->timerProgressBar();
        return redirect()->route('admin.terms.index');

    }
}
