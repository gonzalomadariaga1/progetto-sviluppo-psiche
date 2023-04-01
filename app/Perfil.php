<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
    protected $table ='perfil';

    protected $fillable = [
        'nombre_perfil'
    ];

    public function opciones(){
        return $this->belongsToMany(Opcion::class, 'opcion_perfil');
    }

}
