<?php

namespace App\Http\Controllers;

use App\CarouselTarifa;
use Illuminate\Http\Request;

class CarouselTarifasController extends Controller
{
    const PERMISSIONS = [
        'create' => 'admin-carouseltarifas-create',
        'show' => 'admin-carouseltarifas-show',
        'edit' => 'admin-carouseltarifas-edit',
        'delete' => 'admin-carouseltarifas-delete',
    ];

    public function __construct()
    {
        $this->middleware('permission:'.self::PERMISSIONS['create'])->only(['create', 'store']);
        $this->middleware('permission:'.self::PERMISSIONS['show'])->only(['index', 'show']);
        $this->middleware('permission:'.self::PERMISSIONS['edit'])->only(['edit', 'update']);
        $this->middleware('permission:'.self::PERMISSIONS['delete'])->only('destroy');
    }

    public function index(){

        $rows = CarouselTarifa::orderBy('id')->paginate();

        return view('admin.carouseltarifas.index', [
            'rows' => $rows,
        ]);
    }

    public function create()
    {
        
        return view('admin.carouseltarifas.create');
    }

    public function store(Request $request)
    {
           
        //dd($request->all());

        $row = new CarouselTarifa;
        $row->title_es = $request->get('title_es');
        $row->title_it = $request->get('title_it');
        $row->subtitle_it = $request->get('subtitle_it');
        $row->subtitle_it = $request->get('subtitle_it');


        $row->save();

        toast('El carousel se ha creado correctamente.','success')->timerProgressBar();
        return redirect()->route('admin.carouseltarifas.index');
    }

    public function edit( $id)
    {
        $carouseltarifa = CarouselTarifa::findOrFail($id);
        
        return view('admin.carouseltarifas.edit', [ 'row' => $carouseltarifa]);
    }

    public function update(Request $request, $id)
    {
        $carouseltarifa = CarouselTarifa::findOrFail($id);
        $carouseltarifa->update($request->all());
        toast('El carousel se ha actualizado correctamente.','success')->timerProgressBar();
        return redirect()->route('admin.carouseltarifas.index');

    }

    public function destroy($id)
    {
        $carouseltarifa = CarouselTarifa::findOrFail($id);
        $carouseltarifa->delete();
        toast('El carousel se ha eliminado correctamente.','success')->timerProgressBar();
        return redirect()->route('admin.carouseltarifas.index');

    }

}
