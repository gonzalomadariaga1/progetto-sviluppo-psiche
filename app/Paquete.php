<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paquete extends Model
{
    protected $table = 'paquetes';

    protected $fillable = [
        'name_es',
        'name_it',
        'duracion',
        'precio',
        'descuento',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo('App\User' , 'user_id');
    }
}
