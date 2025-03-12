<?php

namespace App\Models;

use App\Models\Espace;
use App\Models\OptionImage;
use App\Models\EspaceOption;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Option extends Model
{
    use HasFactory;
    protected $table = 'options';
    protected $fillable = [
        'matricule',
        'materiel',
        'description',
        'prix',
    ];

    // Relation : Une option peut être liée à plusieurs espaces
    public function espaces()
    {
        return $this->belongsToMany(Espace::class, 'espace_options', 'option_id', 'espace_id');
    }

    // Relation : Une option peut avoir plusieurs images
    public function optionImage()
    {
        return $this->hasMany(OptionImage::class, 'option_id','id');
    }
}
