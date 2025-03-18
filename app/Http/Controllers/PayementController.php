<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Models\ReservationOption;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class PayementController extends Controller
{
    
    public function save(Request $request)
    {
        Validator::extend('custom_datetime', function ($attribute, $value, $parameters, $validator) {
            $format = 'd/m/Y H:i'; // Custom datetime format
            $date = DateTime::createFromFormat($format, $value);
            return $date && $date->format($format) === $value;
        });
        
        
        $validation = $request->validate([
            'espace' => 'required|string',
            'user' => 'required|string',
            'dateDebut' => 'required|date',
            'dateFin' => 'required|date',
            'prix' => 'required|integer',
            'status' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'option.*' => 'nullable|integer',
        ]);
        
        $reservation = new Reservation();
        $reservation->espace_id = $request->espace;
        $reservation->user_id = $request->user;
        $reservation->dateDebut = $request->dateDebut;
        $reservation->dateFin = $request->dateFin;
        $reservation->prix = $request->prix;
        $reservation->status = 'Non payé';
        // $reservation->image = ;
        $reservation->save();    
        
        if ( $request->option ){
            foreach ( $request->option as $option ){
                $option = (int) $option;
                try {
                    $reservationOption = new ReservationOption();
                    $reservationOption->reservation_id = $reservation->id;
                    $reservationOption->espace_option_id = $option;
                    $reservationOption->save();
                } catch (\Exception $e) {
                    
                    session()->flash('error', 'Erreur lors de l\'enregistrement de l\'option: ' . $e->getMessage());
                    return $e->getMessage();
                }
            }
        }

        if ($reservation) {
            session()->flash('success', 'Reservation créee avec succès');
            return redirect(route('payement.create', ['reservation' => $reservation->id]));
        } else {
            session()->flash('error', 'Une erreur est survenue');
            return redirect(route('reservationPages.reservation'));
        }
    }

    public function create(Reservation $reservation)
    {
        return view('reservationPages.payement', compact('reservation'));
    }

    public function validate(Request $request, Reservation $reservation)
    {
        Validator::extend('custom_datetime', function ($attribute, $value, $parameters, $validator) {
            $format = 'd/m/Y H:i'; // Custom datetime format
            $date = \DateTime::createFromFormat($format, $value);
            return $date && $date->format($format) === $value;
        });
    
        // dd($request->all());
    $validation = $request->validate([
        'espace' => 'required|string',
        'user' => 'required|string',
        'dateDebut' => 'required|date',
        'dateFin' => 'required|date',
        'prix' => 'required|integer',
        'status' => 'required|string',
        'phone' => 'required|string',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'option.*' => 'nullable|integer',
    ]);

    try {
        $reservation->espace_id = $request->espace;
        $reservation->user_id = $request->user;
        $reservation->dateDebut = $request->dateDebut;
        $reservation->dateFin = $request->dateFin;
        $reservation->prix = $request->prix;
        $reservation->status = 'En cours de validation';
        $reservation->image = $request->image->store('upload/reservation/images', 'public');
        $reservation->phone = $request->phone;
        $reservation->save();
        
        $reservation->options()->detach();
        if ($request->has('option')) {
        foreach ( $request->option as $option ){
            $reservationOption = new ReservationOption();
            $reservationOption->reservation_id = $reservation->id;
            $reservationOption->espace_option_id = $option;
            $reservationOption->save();
        }
    }
        // Message de succès
        session()->flash('success', 'reservation mise à jour avec succès');
        return redirect()->route('dashboard');
    } catch (\Exception $e) {
        // Message d'erreur en cas de problème
        session()->flash('error', 'Une erreur est survenue');
        return redirect()->route('dashboard');
    }
    }

}
