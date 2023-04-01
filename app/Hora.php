<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hora extends Model
{
    protected $table ='horas';

    protected $fillable = [
        'hora_inici', 'hora_fin'
    ];

    public function horario(){
        return $this->belongsToMany(Dia::class, 'horario');
    }
}
