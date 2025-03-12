<?php

namespace App\Models;

use App\Models\Espace;
use App\Models\Option;
use App\Models\Reservation;
use Illuminate\Database\Eloquent\Model;

class EspaceOption extends Model
{
    protected $table = 'espace_options';
    protected $fillable = ['espace_id','option_id'];

    // Relation : Une reservation peut être liée à plusieurs options / EspaceOption
    public function reservation()
    {
        return $this->belongsToMany(Reservation::class, 'reservation_options', 'reservation_id', 'espace_option_id');
    }

    public function espace()
    {
        return $this->belongsTo(Espace::class);
    }

    public function option()
    {
        return $this->belongsTo(Option::class);
    }
}
