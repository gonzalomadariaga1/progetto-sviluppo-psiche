<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    static $rules=[
        'title' => 'required',
        'descripcion' => 'required',
        'start' => 'required',
        'end' => 'required'
    ];

    protected $fillable=['title','descripcion','start','end'];
}
