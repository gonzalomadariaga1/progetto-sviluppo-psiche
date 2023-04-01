<?php

namespace App\Http\Controllers;

use App\LinkUtil;
use Illuminate\Http\Request;

class LinksUtilesController extends Controller
{
    const PERMISSIONS = [
        'create' => 'admin-linksutiles-create',
        'show' => 'admin-linksutiles-show',
        'edit' => 'admin-linksutiles-edit',
        'delete' => 'admin-linksutiles-delete',
    ];

    public function __construct()
    {
        $this->middleware('permission:'.self::PERMISSIONS['create'])->only(['create', 'store']);
        $this->middleware('permission:'.self::PERMISSIONS['show'])->only(['index', 'show']);
        $this->middleware('permission:'.self::PERMISSIONS['edit'])->only(['edit', 'update']);
        $this->middleware('permission:'.self::PERMISSIONS['delete'])->only('destroy');
    }

    public function index(){

        $rows = LinkUtil::orderBy('id')->paginate();

        return view('admin.linksutiles.index', [
            'rows' => $rows,
        ]);
    }

    public function create()
    {
        
        return view('admin.linksutiles.create');
    }

    public function store(Request $request)
    {
           
        //dd($request->all());

        $row = new LinkUtil;
        $row->link_it = $request->get('link_it');
        $row->link_es = $request->get('link_es');
        $row->link = $request->get('link');


        $row->save();

        toast('El link útil se ha creado correctamente.','success')->timerProgressBar();
        return redirect()->route('admin.linksutiles.index');
    }

    public function edit( $id)
    {
        $linkutil = LinkUtil::findOrFail($id);
        
        return view('admin.linksutiles.edit', [ 'row' => $linkutil]);
    }

    public function update(Request $request, $id)
    {
        $linkutil = LinkUtil::findOrFail($id);
        $linkutil->update($request->all());
        toast('El link útil se ha actualizado correctamente.','success')->timerProgressBar();
        return redirect()->route('admin.linksutiles.index');

    }

    public function destroy($id)
    {
        $linkutil = LinkUtil::findOrFail($id);
        $linkutil->delete();
        toast('El link útil se ha eliminado correctamente.','success')->timerProgressBar();
        return redirect()->route('admin.linksutiles.index');

    }
}
