<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    //
    protected $fillable = ['name_es',	'name_it',	'user_id'];
    
    public function user()
    {
        return $this->belongsTo('App\User' , 'user_id');
    }

    
}
