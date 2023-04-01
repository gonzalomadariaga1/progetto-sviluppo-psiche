<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PoliticaCookies extends Model
{
    protected $table = 'politicacookies';

    protected $fillable = [
        'title_es',
        'title_it',
        'content_it',
        'content_es',
    ];
}
