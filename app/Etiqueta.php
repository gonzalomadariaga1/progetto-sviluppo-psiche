<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Etiqueta extends Model
{
    protected $table ='etiquetas';

    protected $fillable = [
        'name_es','name_it','description_es','description_it'
    ];

    public function getRouteKeyName(){
        return 'name_es';
    }

    public function taggables(){
        return $this->hasMany('App\Taggable');
    }

    public function posts(){
        return $this->morphedByMany('App\Post','taggable');
    }
}
