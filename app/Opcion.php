<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Opcion extends Model
{
    protected $table ='opcion';

    protected $fillable = [
        'id',
        'nombre_menu',
        'id_opcion_padre',
        'descripcion',
        'url',
        'alias',
        'estado',
    ];

    public function perfil(){
        return $this->belongsToMany(Perfil::class, 'opcion_perfil');
    }
}
