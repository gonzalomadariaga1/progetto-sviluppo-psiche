<?php

namespace App\Http\Controllers;

use App\Faq;
use App\User;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    const PERMISSIONS = [
        'create' => 'admin-faq-create',
        'show' => 'admin-faq-show',
        'edit' => 'admin-faq-edit',
        'delete' => 'admin-faq-delete',
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
        $rows = Faq::orderBy('id')->paginate();
        

        return view('admin.faq.index', [
            'rows' => $rows,
        ]);
    }

    public function create()
    {
        $user = User::all();
        return view('admin.faq.create', compact('user'));
    }

    public function store(Request $request)
    {
           
        //dd($request->all());

        $row = new Faq;
        $row->name_it = $request->get('name_it');
        $row->name_es = $request->get('name_es');
        $row->content_it = $request->get('content_it');
        $row->content_es = $request->get('content_es');


        $row->save();

        toast('La FAQ se ha creado correctamente.','success')->timerProgressBar();
        return redirect()->route('admin.faq.index');
    }

    public function show($id)
    {
        $faq = Faq::findOrFail($id);
        
        return view('admin.faq.show', [ 'row' => $faq]);
    }

    public function edit( $id)
    {
        $faq = Faq::findOrFail($id);
        
        return view('admin.faq.edit', [ 'row' => $faq]);
    }

    public function update(Request $request, $id)
    {
        $faq = Faq::findOrFail($id);
        $faq->update($request->all());
        toast('La FAQ se ha actualizado correctamente.','success')->timerProgressBar();
        return redirect()->route('admin.faq.index');

    }

    public function destroy($id)
    {
        $faq = Faq::findOrFail($id);
        $faq->delete();
        toast('La FAQ se ha eliminado correctamente.','success')->timerProgressBar();
        return redirect()->route('admin.faq.index');

    }
}
