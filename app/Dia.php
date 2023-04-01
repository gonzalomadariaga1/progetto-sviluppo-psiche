<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dia extends Model
{
    protected $table ='dias';

    protected $fillable = [
        'dia',
    ];

    public function horario(){
        return $this->belongsToMany(Hora::class, 'horario');
    }
}
