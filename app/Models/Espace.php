<?php

namespace App\Models;

use App\Models\Option;
use App\Models\EspaceImage;
use App\Models\Reservation;
use App\Models\EspaceOption;
use Illuminate\Database\Eloquent\Model;

class Espace extends Model
{
    protected $table = 'espaces';
    protected $fillable = ['nom', 'description', 'status', 'prix'];

    // Relation : Une option peut avoir plusieurs images
    public function espaceImage()
    {
        return $this->hasMany(EspaceImage::class, 'espace_id','id');
    }
    // Relation : Un espace peut être liée à plusieurs options
    public function options()
    {
        return $this->belongsToMany(Option::class, 'espace_options', 'espace_id', 'option_id');
    }
}
