<?php

namespace App\Http\Controllers;

use App\InfoFooter;
use Illuminate\Http\Request;

class InfoFooterController extends Controller
{
    const PERMISSIONS = [
        'create' => 'admin-infofooter-create',
        'show' => 'admin-infofooter-show',
        'edit' => 'admin-infofooter-edit',
        'delete' => 'admin-infofooter-delete',
    ];

    public function __construct()
    {
        $this->middleware('permission:'.self::PERMISSIONS['create'])->only(['create', 'store']);
        $this->middleware('permission:'.self::PERMISSIONS['show'])->only(['index', 'show']);
        $this->middleware('permission:'.self::PERMISSIONS['edit'])->only(['edit', 'update']);
        $this->middleware('permission:'.self::PERMISSIONS['delete'])->only('destroy');
    }
    public function index(){

        $rows = InfoFooter::orderBy('id')->paginate();

        return view('admin.infofooter.index', [
            'rows' => $rows,
        ]);
    }

    public function create()
    {
        
        return view('admin.infofooter.create');
    }

    public function store(Request $request)
    {
           
        //dd($request->all());

        $row = new InfoFooter;
        $row->content_it = $request->get('content_it');
        $row->content_es = $request->get('content_es');


        $row->save();

        toast('La sección Info del footer se ha creado correctamente.','success')->timerProgressBar();
        return redirect()->route('admin.infofooter.index');
    }

    public function edit( $id)
    {
        $infofooter = InfoFooter::findOrFail($id);
        
        return view('admin.infofooter.edit', [ 'row' => $infofooter]);
    }

    public function update(Request $request, $id)
    {
        $infofooter = InfoFooter::findOrFail($id);
        $infofooter->update($request->all());
        toast('La sección Contacto del footer se ha actualizado correctamente.','success')->timerProgressBar();
        return redirect()->route('admin.infofooter.index');

    }

    public function destroy($id)
    {
        $infofooter = InfoFooter::findOrFail($id);
        $infofooter->delete();
        toast('La sección Contacto del footer se ha eliminado correctamente.','success')->timerProgressBar();
        return redirect()->route('admin.infofooter.index');

    }
}
