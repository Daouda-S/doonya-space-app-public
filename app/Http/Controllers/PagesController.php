<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Espace;
use App\Models\Reservation;
use App\Models\EspaceOption;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PagesController extends Controller
{
    public function apropos()
    {
        return view('pages.apropos');
    }
    public function services()
    {
        return view('pages.services');
    }

    public function boutique()
    {
        $bureauIndividuels = Espace::with(['espaceImage', 'options'])->where('nom', 'bureau individuel')->get();
        $salleConferences = Espace::with(['espaceImage', 'options'])->where('nom','salle de conference')->get();
        $espaceCoworkings = Espace::with(['espaceImage', 'options'])->where('nom','espace coworking')->get();
        $espaceIndividuels = Espace::with(['espaceImage', 'options'])->where('nom','espace coworking vip')->get();

        $ReservationDateFin  = Reservation::all();
        return view('pages.boutique', compact(['bureauIndividuels','salleConferences','espaceCoworkings','espaceIndividuels', 'ReservationDateFin']));
    }
    public function createReservation(Espace $espace)
    {
        $Reservation  = Reservation::where('espace_id', $espace['id'])->first();
        if (Auth::check()) {
            $user = Auth::user();
            $options = EspaceOption::with('espace')->where('espace_id', $espace['id'])->get();
        }
        if ($Reservation == null) {
            $Reservation = today()->format('Y-m-d');
        }elseif($Reservation!= null){
            $Reservation = $Reservation->dateFin;
        }
        return view('reservationPages.index', compact('espace', 'user', 'options', 'Reservation'));
    }
}
