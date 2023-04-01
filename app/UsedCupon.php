<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsedCupon extends Model
{
    protected $table = 'used_cupones';

    protected $fillable = [
        'cupon_id',
        'email_paciente',
        'telefono_paciente',   
    ];
}
