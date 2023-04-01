<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Termino extends Model
{
    protected $table = 'terminos';

    protected $fillable = [
        'title_es',
        'title_it',
        'content_it',
        'content_es',
    ];
}
