<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CuentaBancaria extends Model
{
    protected $table ='cuentabancaria';

    protected $fillable = [
        'banco',
        'tipo_cuenta',
        'numero_cuenta',
        'nombre_persona',
        'email',
        'especialista_id'
    ];
}
