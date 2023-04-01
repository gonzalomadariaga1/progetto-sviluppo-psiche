<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Modalidad extends Model
{
    protected $table ='modalidad';

    protected $fillable = [
        'name_es', 'name_it', 'duracion' , 'precio'
    ];
}
