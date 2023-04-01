<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactoFooter extends Model
{
    protected $table = 'contactofooter';

    protected $fillable = [
        'content_it',
        'content_es',
    ];
}
