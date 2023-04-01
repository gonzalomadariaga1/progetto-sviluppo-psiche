<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LinkUtil extends Model
{
    protected $table = 'linksutiles';

    protected $fillable = [
        'link_es',
        'link_it',
        'link'
    ];
}
