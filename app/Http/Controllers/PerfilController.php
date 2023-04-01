<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Perfil;
use App\Opcion;

class PerfilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perfiles = Perfil::orderBy('id','desc')->get();

        return view('admin.perfiles.index', ['perfiles' => $perfiles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('admin.perfiles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->perfil_opciones);

        $request->validate([
            'nombre_perfil' => 'required|unique:perfil|max:255'
        ]);

        $perfil = new Perfil;
        $perfil->nombre_perfil = $request->get('nombre_perfil');
        $perfil->save();
        
        $listaopciones = explode(',',$request->perfil_opciones);

        foreach ($listaopciones as $opcion) {
            $opciones = new Opcion();
            $opciones->nombre_menu = $opcion;
            $opciones->save();
            $perfil->opciones()->attach($opciones->id);
            $perfil->save();

        }

        

        toast('El perfil se ha creado correctamente.','success')->timerProgressBar();
        return redirect('/perfiles');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $perfiles = Perfil::findOrFail($id);
        return view('admin.perfiles.show', ['perfiles' => $perfiles]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $perfiles = Perfil::findOrFail($id);
        
        return view("admin.perfiles.edit",["perfiles"=>$perfiles]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //dd($request);

        $perfiles = Perfil::findOrFail($id);

        $perfiles->nombre_perfil = $request->get('nombre_perfil');
        

        $perfiles->update();

        $listaopciones = explode(',',$request->perfil_opciones);

        foreach ($listaopciones as $opcion) {
            $opciones = new Opcion();
            $opciones->nombre_menu = $opcion;
            $opciones->update();
            $perfiles->opciones()->attach($opciones->id);
            $perfiles->update();
            //arreglar por dd 
        }


        toast('El perfil se ha actualizado correctamente.','success')->timerProgressBar();


        return redirect('/perfiles');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $perfiles = Perfil::findOrFail($id);
        $perfiles->opciones()->delete();
        $perfiles->opciones()->detach();
        $perfiles->delete();

        toast('El perfil se ha eliminado correctamente.','success')->timerProgressBar();
        return redirect('/perfiles');
    }
}
