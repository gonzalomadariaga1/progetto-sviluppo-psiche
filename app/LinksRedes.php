<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LinksRedes extends Model
{
    protected $table = 'linksredes';

    protected $fillable = [
        'name',
        'link',
        'icono'
    ];
}
