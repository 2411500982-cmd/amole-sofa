<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WebsiteImage extends Model
{
    protected $fillable = [
        'image_key',
        'image',
        'description',
    ];
}
