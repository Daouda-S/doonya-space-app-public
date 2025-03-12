<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OptionImage extends Model
{
    protected $table = 'option_images';
    protected $fillable = ['option_id', 'image'];
}

