<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Cita extends Model
{
    protected $table ='citas';

    protected $fillable = [
        'paciente_nombres',
        'paciente_apellidos',
        'paciente_email',
        'paciente_telefono',
        'dia',
        'hora_inicio',
        'hora_fin',
        'estado',
        'modalidad_id',
        'servicio_id',
        'especialista_id',
        'cupon_id'
    ];

    public function servicio()
    {
        return $this->belongsTo('App\Servicio' , 'servicio_id');
    }

    public function modalidad()
    {
        return $this->belongsTo('App\Modalidad' , 'modalidad_id');
    }

    public function cupon()
    {
        return $this->belongsTo('App\Cupon' , 'cupon_id');
    }

    public function especialista()
    {
        return $this->belongsTo('App\User' , 'especialista_id');
    }

    protected static function booted()
    {
        if (auth()->check() && !auth()->user()->can('Superadmin')){

            static::addGlobalScope('user', function (Builder $builder) {
                $builder->where('especialista_id', auth()->id() );
            });

        }

    }
}
