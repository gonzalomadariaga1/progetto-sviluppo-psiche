<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CarouselTarifa extends Model
{
    //
    protected $table = 'carouseltarifa';

    protected $fillable = [
        'title_it',
        'title_es',
        'subtitle_it',
        'subtitle_es'
    ];
}
