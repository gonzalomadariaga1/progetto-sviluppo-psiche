<?php

namespace App;

use App\User;
use App\Etiqueta;
use App\Categoria;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Post extends Model
{
    protected $fillable = [
        'title_es',
        'title_it',
        'slug',
        'status',
        'resumen_es',
        'resumen_it',
        'content_it',
        'content_es',
        'iframe',
        'published_at',
        'categoria_id',
        'userId'
    ];

    // public function getRouteKeyName(){
    //     return 'slug';
    // }
    public function user()
    {
        return $this->belongsTo('App\User' , 'userId');
    }

    public function images()
    {
        return $this->morphMany('App\Image' , 'imageable');
    }

    public function category()
    {
        return $this->belongsTo('App\Categoria','categoria_id');
    }

    public function tags()
    {
        return $this->morphToMany('App\Etiqueta','taggable');
    }

    public function my_store($request,$user)
    {
        $post = self::create($request->all()+[
            'slug' => Str::slug($request->title_es, '_'),
            'userId' => $user,
        ]);
        return $post;
    }

    public function my_update($request, $categoria)
    {
        if( $request->published_at )
        {

            $this->update($request->all()+[
                'slug' => Str::slug($request->title_es,'_'),
                'categoria_id' => $categoria
            ]);
        }else
        {
            $request->merge([
                'published_at' => now()
            ]);
            $this->update($request->all()+[
                'slug' => Str::slug($request->title_es,'_'),
                'categoria_id' => $categoria
            ]);
        }
        
        
        $this->tags()->sync($request->get('etiquetas'));
    }

    protected static function booted()
    {
        if (auth()->check() && !auth()->user()->can('Superadmin')){

            static::addGlobalScope('user', function (Builder $builder) {
                $builder->where('userId', auth()->id() );
            });

        }

    }
}
