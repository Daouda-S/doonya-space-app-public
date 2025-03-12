<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EspaceImage extends Model
{
    protected $table = 'espace_images';
    protected $fillable = ['espace_id', 'image'];
}
