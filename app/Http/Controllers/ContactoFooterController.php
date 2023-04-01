<?php

namespace App\Http\Controllers;

use App\ContactoFooter;
use Illuminate\Http\Request;

class ContactoFooterController extends Controller
{
    const PERMISSIONS = [
        'create' => 'admin-contactofooter-create',
        'show' => 'admin-contactofooter-show',
        'edit' => 'admin-contactofooter-edit',
        'delete' => 'admin-contactofooter-delete',
    ];

    public function __construct()
    {
        $this->middleware('permission:'.self::PERMISSIONS['create'])->only(['create', 'store']);
        $this->middleware('permission:'.self::PERMISSIONS['show'])->only(['index', 'show']);
        $this->middleware('permission:'.self::PERMISSIONS['edit'])->only(['edit', 'update']);
        $this->middleware('permission:'.self::PERMISSIONS['delete'])->only('destroy');
    }
    public function index(){

        $rows = ContactoFooter::orderBy('id')->paginate();

        return view('admin.contactofooter.index', [
            'rows' => $rows,
        ]);
    }

    public function create()
    {
        
        return view('admin.contactofooter.create');
    }

    public function store(Request $request)
    {
           
        //dd($request->all());

        $row = new ContactoFooter;
        $row->content_it = $request->get('content_it');
        $row->content_es = $request->get('content_es');


        $row->save();

        toast('La sección Contacto del footer se ha creado correctamente.','success')->timerProgressBar();
        return redirect()->route('admin.contactofooter.index');
    }

    public function edit( $id)
    {
        $politica = ContactoFooter::findOrFail($id);
        
        return view('admin.contactofooter.edit', [ 'row' => $politica]);
    }

    public function update(Request $request, $id)
    {
        $politica = ContactoFooter::findOrFail($id);
        $politica->update($request->all());
        toast('La sección Contacto del footer se ha actualizado correctamente.','success')->timerProgressBar();
        return redirect()->route('admin.contactofooter.index');

    }

    public function destroy($id)
    {
        $politica = ContactoFooter::findOrFail($id);
        $politica->delete();
        toast('La sección Contacto del footer se ha eliminado correctamente.','success')->timerProgressBar();
        return redirect()->route('admin.contactofooter.index');

    }
}
