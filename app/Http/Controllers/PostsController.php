<?php

namespace App\Http\Controllers;

use App\Post;
use App\Etiqueta;
use App\Categoria;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    const PERMISSIONS = [
        'create' => 'admin-post-create',
        'show' => 'admin-post-show',
        'edit' => 'admin-post-edit',
        'delete' => 'admin-post-delete',
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
        $rows = Post::orderBy('id')->paginate();
        
        return view('admin.posts.index', [
            'rows' => $rows,
        ]);
    }


    public function create()
    {
        $categorias = Categoria::get();
        
        $etiquetas = Etiqueta::all();
        return view('admin.posts.create', compact('categorias','etiquetas'));
    }


    public function store(Request $request, Post $post)
    {
        //dd($request->all());
        $user = auth()->user()->id;
        
        $post = $post->my_store($request,$user);
        
        return redirect()->route('admin.posts.edit', $post->id);
    }


    public function show($id)
    {
        $post = Post::findOrFail($id);
        return view('admin.posts.show', compact('post'));
    }


    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $categorias = Categoria::get();
        
        $etiquetas = Etiqueta::all();

        
        
        return view('admin.posts.edit', compact('post','categorias','etiquetas'));
    }


    public function update(Request $request, Post $post)
    {
        // switch ($request->status) {
        //     case 'draft':
        //         return 
        //         $request->merge([
        //             'published_at' => null,
        //         ])
        //         ;
        //     case 'public':
        //         return 
        //         $request->merge([
        //             'published_at' => now(),
        //         ])
        //         ;
        //     case 'hidden':
        //         return 
        //         $request->merge([
        //             'published_at' => null,
        //         ])
        //         ;
        //     case 'program':
        //         return 
        //         $request->merge([
        //             'published_at' => null,
        //         ])
        //         ;
        //     default:
        //         # code...
        //         break;
        // }
       
        $categoria = $request->get('categorias_id');
        
        $post->my_update($request,$categoria);
        toast('El post se ha actualizado correctamente.','success')->timerProgressBar();
        return redirect()->route('admin.posts.index');
    }


    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
        toast('El post se ha eliminado correctamente.','success')->timerProgressBar();
        return redirect()->route('admin.posts.index');
    }
}
