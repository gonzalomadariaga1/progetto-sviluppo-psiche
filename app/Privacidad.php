<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Privacidad extends Model
{
    protected $table = 'privacidad';

    protected $fillable = [
        'title_es',
        'title_it',
        'content_it',
        'content_es',
    ];
}
