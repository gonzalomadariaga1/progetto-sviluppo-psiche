<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    protected $table = 'faq';

    protected $fillable = [
        'name_es',
        'name_it',
        'content_it',
        'content_es',
    ];
}
