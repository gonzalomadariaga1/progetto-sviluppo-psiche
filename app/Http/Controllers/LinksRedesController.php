<?php

namespace App\Http\Controllers;

use App\LinksRedes;
use Illuminate\Http\Request;

class LinksRedesController extends Controller
{
    const PERMISSIONS = [
        'create' => 'admin-linksredes-create',
        'show' => 'admin-linksredes-show',
        'edit' => 'admin-linksredes-edit',
        'delete' => 'admin-linksredes-delete',
    ];

    public function __construct()
    {
        $this->middleware('permission:'.self::PERMISSIONS['create'])->only(['create', 'store']);
        $this->middleware('permission:'.self::PERMISSIONS['show'])->only(['index', 'show']);
        $this->middleware('permission:'.self::PERMISSIONS['edit'])->only(['edit', 'update']);
        $this->middleware('permission:'.self::PERMISSIONS['delete'])->only('destroy');
    }

    public function index(){

        $rows = LinksRedes::orderBy('id')->paginate();

        return view('admin.linksredes.index', [
            'rows' => $rows,
        ]);
    }

    public function create()
    {
        
        return view('admin.linksredes.create');
    }

    public function store(Request $request)
    {
           
        //dd($request->all());

        $row = new LinksRedes;
        $row->name = $request->get('name');
        $row->link = $request->get('link');
        $row->icono = $request->get('icono');


        $row->save();

        toast('La red social se ha creado correctamente.','success')->timerProgressBar();
        return redirect()->route('admin.linksredes.index');
    }

    public function edit( $id)
    {
        $linksredes = LinksRedes::findOrFail($id);
        
        return view('admin.linksredes.edit', [ 'row' => $linksredes]);
    }

    public function update(Request $request, $id)
    {
        $linksredes = LinksRedes::findOrFail($id);
        $linksredes->update($request->all());
        toast('La red social se ha actualizado correctamente.','success')->timerProgressBar();
        return redirect()->route('admin.linksredes.index');

    }

    public function destroy($id)
    {
        $linksredes = LinksRedes::findOrFail($id);
        $linksredes->delete();
        toast('La red social se ha eliminado correctamente.','success')->timerProgressBar();
        return redirect()->route('admin.linksredes.index');

    }
}
