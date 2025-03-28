<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Espace;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $nbr_reservations = Reservation::where('status','!=','Non payé')->count();
        $today_reservations = Reservation::whereDate('created_at', now()->toDateString())->where('status','!=','Non payé')->count();
        $today_reservations_en_cours = Reservation::where('dateFin', '>=', now()->today())->where('status','Payé')->count();
        $caisse = Reservation::sum('prix');
        $nbr_espaces = Espace::count();
        $nbr_users = User::count();
        $nbr_users_reservations = Reservation::distinct('user_id')->count('user_id');
        $nbr_espaces_disponibles = Espace::where('status', 'disponible')->count();
        $reservations = Reservation::with(['espace','options','user'])->where('status', '!=', 'Non payé')->get();
        foreach ($reservations as $reservation) {
            // Vérifier si la date de fin est inférieure à aujourd'hui
            if (Carbon::parse($reservation->dateFin)->isBefore(Carbon::today()) && $reservation->status !== 'Terminée') {
                $reservation->status = 'Terminée';
                $reservation->save();
                $espace = Espace::find($reservation->espace_id);
                $espace->status = 'disponible';
                $espace->save();
            }
        }

        return view('admin.dashboard', compact('nbr_reservations', 'today_reservations', 'today_reservations_en_cours', 'caisse', 'nbr_espaces', 'nbr_users', 'nbr_users_reservations', 'nbr_espaces_disponibles'));
    }
}
