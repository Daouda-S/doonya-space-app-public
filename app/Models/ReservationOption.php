<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReservationOption extends Model
{
    protected $table = 'reservation_options';
    protected $fillable = ['reservation_id','espace_option_id'];
}
