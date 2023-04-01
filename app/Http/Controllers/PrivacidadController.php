<?php

namespace App\Http\Controllers;

use App\Privacidad;
use Illuminate\Http\Request;

class PrivacidadController extends Controller
{
    const PERMISSIONS = [
        'create' => 'admin-privacidad-create',
        'show' => 'admin-privacidad-show',
        'edit' => 'admin-privacidad-edit',
        'delete' => 'admin-privacidad-delete',
    ];

    public function __construct()
    {
        $this->middleware('permission:'.self::PERMISSIONS['create'])->only(['create', 'store']);
        $this->middleware('permission:'.self::PERMISSIONS['show'])->only(['index', 'show']);
        $this->middleware('permission:'.self::PERMISSIONS['edit'])->only(['edit', 'update']);
        $this->middleware('permission:'.self::PERMISSIONS['delete'])->only('destroy');
    }
    public function index(){

        $rows = Privacidad::orderBy('id')->paginate();

        return view('admin.privacy.index', [
            'rows' => $rows,
        ]);
    }

    public function create()
    {
        
        return view('admin.privacy.create');
    }

    public function store(Request $request)
    {
           
        //dd($request->all());

        $row = new Privacidad;
        $row->title_it = $request->get('title_it');
        $row->title_es = $request->get('title_es');
        $row->content_it = $request->get('content_it');
        $row->content_es = $request->get('content_es');


        $row->save();

        toast('La política de privacidad se ha creado correctamente.','success')->timerProgressBar();
        return redirect()->route('admin.privacy.index');
    }

    public function edit( $id)
    {
        $privacidad = Privacidad::findOrFail($id);
        
        return view('admin.privacy.edit', [ 'row' => $privacidad]);
    }

    public function update(Request $request, $id)
    {
        
        $privacidad = Privacidad::findOrFail($id);
        $privacidad->update($request->all());
        toast('La política de privacidad se ha actualizado correctamente.','success')->timerProgressBar();
        return redirect()->route('admin.privacy.index');

    }

    public function destroy($id)
    {
        $privacidad = Privacidad::findOrFail($id);
        $privacidad->delete();
        toast('La política de privacidad se ha eliminado correctamente.','success')->timerProgressBar();
        return redirect()->route('admin.privacy.index');

    }
}
