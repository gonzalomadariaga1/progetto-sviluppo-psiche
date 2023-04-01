<?php

namespace App\Http\Controllers;

use App\Cita;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $id_user_logeado = Auth::user()->id;
       
        
        $recent_posts = Post::latest('published_at')->where('status','public')->take(4)->get();
        //dd($recent_posts);
        
        $citas = Cita::latest('id')->where('estado','APROBADA')->take(5)->get();

        $citasporconfirmar = Cita::latest('id')->where('estado','PENDIENTE')->count();
        $citasconfirmadas = Cita::latest('id')->where('estado','APROBADA')->count();

        $ganancia = Cita::latest('id')->where('estado','APROBADA')->sum('valor');
        //dd($ganancia);

        return view('home', compact('recent_posts','citas','citasporconfirmar','citasconfirmadas','ganancia'));
    }
}
