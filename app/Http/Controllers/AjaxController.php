<?php

namespace App\Http\Controllers;

use App\Post;
use App\Image;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function upload_image(Request $request, $id)
    {
        if ($request->ajax()) {
            $post = Post::find($id);

            $urlimages = [];
            $filesLink = array();
            if($request->hasFile('files')){
                $images=$request->file('files');
                foreach ($images as $image ) {
                    $nombre = time().'_'.$image->getClientOriginalName();
                    $ruta = public_path().'/imagenes/';
                    $image->move($ruta,$nombre);
                    $urlimages[]['url']='/imagenes/'.$nombre;
                    $url = '/imagenes/'.$nombre;
                    array_push($filesLink,$url);
                }
            }
            //dd($filesLink);
            $post->images()->createMany($urlimages);
            return $filesLink;
        }
    }

    public function get_images($id)
    {
        $post = Post::find($id);
        $images = $post->images->pluck('url');
        return response()->json($images);
    }

    public function file_delete(Request $request){
        $image = Image::find($request->key);
        $image->delete();
        return true;
        
    }
}
