<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Espace;
use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $nbr_reservations = Reservation::where('status','!=','Non payé')->count();
        $today_reservations = Reservation::whereDate('created_at', now()->toDateString())->count();
        $today_reservations_en_cours = Reservation::where('dateFin', '>=', now()->today())->count();
        $caisse = Reservation::sum('prix');
        $nbr_espaces = Espace::count();
        $nbr_users = User::count();
        $nbr_users_reservations = Reservation::distinct('user_id')->count('user_id');
        $nbr_espaces_disponibles = Espace::where('status', 'disponible')->count();

        return view('admin.dashboard', compact('nbr_reservations', 'today_reservations', 'today_reservations_en_cours', 'caisse', 'nbr_espaces', 'nbr_users', 'nbr_users_reservations', 'nbr_espaces_disponibles'));
    }
}
