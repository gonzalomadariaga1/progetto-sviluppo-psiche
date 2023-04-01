<?php

namespace App;
use App\Post;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table ='categorias';

    protected $fillable = [
        'name_es','name_it','description_es','description_it'
    ];

    public function getRouteKeyName()
    {
        return 'name_es';
    }

    public function posts()
    {
        return $this->hasMany('App\Post');
    }


    public function my_store($request){
        self::create([
            'name_es' => $request->name_es,
            'name_it' => $request->name_it,
            
            'description_es' => $request->description_es,
            'description_it' => $request->description_it,
        ]);
    }

    public function my_update($request){
        $this->update([
            'name_es' => $request->name_es,
            'name_it' => $request->name_it,
            'description_es' => $request->description_es,
            'description_it' => $request->description_it,
        ]);
    }

}

