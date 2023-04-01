<?php

namespace App;

use App\Post;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = [
        'url'
    ];

    public function imageable()
    {
        return $this->morphTo(Post::class);
    }
}
