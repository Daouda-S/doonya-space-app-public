<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Espace;
use App\Models\Reservation;
use App\Models\EspaceOption;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
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
        $bureauIndividuels = Espace::with(['espaceImage', 'options'])->where('nom', 'bureau individuel')->orderBy('created_at', 'desc')->get();
        $salleConferences = Espace::with(['espaceImage', 'options'])->where('nom','salle de conference')->orderBy('created_at', 'desc')->get();
        $espaceCoworkings = Espace::with(['espaceImage', 'options'])->where('nom','espace coworking')->orderBy('created_at', 'desc')->get();
        $espaceIndividuels = Espace::with(['espaceImage', 'options'])->where('nom','espace coworking vip')->orderBy('created_at', 'desc')->get();

        $ReservationDateFin  = Reservation::all();
        return view('pages.boutique', compact(['bureauIndividuels','salleConferences','espaceCoworkings','espaceIndividuels', 'ReservationDateFin']));
    }
    public function createReservation(Espace $espace)
    {
        $Reservation  = Reservation::where('espace_id', $espace['id'])->where('status','Payé')->latest()->first();
        if (Auth::check()) {
            $user = Auth::user();
            $options = EspaceOption::with('espace')->where('espace_id', $espace['id'])->get();
        }
        if ($Reservation == null) {
            $Reservation = today()->format('Y-m-d');
        }elseif($Reservation!= null){
            $Reservation = Carbon::parse($Reservation->dateFin)->format('Y-m-d');
        }
        return view('reservationPages.index', compact('espace', 'user', 'options', 'Reservation'));
    }
}
