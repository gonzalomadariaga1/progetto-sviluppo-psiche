<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cupon extends Model
{
    protected $table = 'cupones';

    protected $fillable = [
        'codigo',
        'tipo',
        'limite_uso',
        'quedan_por_usar',
        'multi_uso',   
    ];
}
