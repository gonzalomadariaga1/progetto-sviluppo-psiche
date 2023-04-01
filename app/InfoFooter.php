<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InfoFooter extends Model
{
    protected $table = 'infofooter';

    protected $fillable = [
        'content_it',
        'content_es',
    ];
}
