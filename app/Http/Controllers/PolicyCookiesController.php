<?php

namespace App\Http\Controllers;

use App\PoliticaCookies;
use Illuminate\Http\Request;

class PolicyCookiesController extends Controller
{
    const PERMISSIONS = [
        'create' => 'admin-policycookies-create',
        'show' => 'admin-policycookies-show',
        'edit' => 'admin-policycookies-edit',
        'delete' => 'admin-policycookies-delete',
    ];

    public function __construct()
    {
        $this->middleware('permission:'.self::PERMISSIONS['create'])->only(['create', 'store']);
        $this->middleware('permission:'.self::PERMISSIONS['show'])->only(['index', 'show']);
        $this->middleware('permission:'.self::PERMISSIONS['edit'])->only(['edit', 'update']);
        $this->middleware('permission:'.self::PERMISSIONS['delete'])->only('destroy');
    }
    public function index(){

        $rows = PoliticaCookies::orderBy('id')->paginate();

        return view('admin.policycookies.index', [
            'rows' => $rows,
        ]);
    }

    public function create()
    {
        
        return view('admin.policycookies.create');
    }

    public function store(Request $request)
    {
           
        //dd($request->all());

        $row = new PoliticaCookies;
        $row->title_it = $request->get('title_it');
        $row->title_es = $request->get('title_es');
        $row->content_it = $request->get('content_it');
        $row->content_es = $request->get('content_es');


        $row->save();

        toast('La política de cookies se ha creado correctamente.','success')->timerProgressBar();
        return redirect()->route('admin.policycookies.index');
    }

    public function edit( $id)
    {
        $politica = PoliticaCookies::findOrFail($id);
        
        return view('admin.policycookies.edit', [ 'row' => $politica]);
    }

    public function update(Request $request, $id)
    {
        $politica = PoliticaCookies::findOrFail($id);
        $politica->update($request->all());
        toast('La política de cookies se ha actualizado correctamente.','success')->timerProgressBar();
        return redirect()->route('admin.policycookies.index');

    }

    public function destroy($id)
    {
        $politica = PoliticaCookies::findOrFail($id);
        $politica->delete();
        toast('La política de cookies se ha eliminado correctamente.','success')->timerProgressBar();
        return redirect()->route('admin.policycookies.index');

    }
}
