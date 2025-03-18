<?php

namespace App\Models;

use App\Models\User;
use App\Models\Espace;
use App\Models\Reservation;
use App\Models\EspaceOption;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $table = 'reservations';
    protected $fillable = ['id','espace_id', 'user_id','dateDebut','status','image', 'dateFin', 'prix', 'phone'];

    // Conversion automatique des champs en instances Carbon
    protected $dates = ['dateDebut', 'dateFin', 'created_at', 'updated_at'];

    // Exemple de méthode pour afficher la date et l'heure de début de réservation dans un format lisible
    public function getFormattedStartDateTimeAttribute()
    {
        return Carbon::parse($this->dateDebut)->format('d/m/Y H:i');
    }

    // Exemple de méthode pour afficher la date et l'heure de fin de réservation dans un format lisible
    public function getFormattedEndDateTimeAttribute()
    {
        return Carbon::parse($this->dateFin)->format('d/m/Y H:i');
    }

    // Relation : Une réservation appartient à un espace
    public function espace()
    {
        return $this->belongsTo(Espace::class);
    }

    // Relation : Une réservation appartient à un utilisateur
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relation : Une reservation peut être liée à plusieurs options / EspaceOption
    public function options()
    {
        return $this->belongsToMany(EspaceOption::class, 'reservation_options', 'reservation_id', 'espace_option_id');
    }

}

