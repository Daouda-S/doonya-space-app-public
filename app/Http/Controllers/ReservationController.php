<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\User;
use App\Models\Espace;
use App\Models\Reservation;
use Illuminate\Support\Arr;
use App\Models\EspaceOption;
use Illuminate\Http\Request;
use App\Models\ReservationOption;
use Illuminate\Support\Facades\Validator;

class ReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::with(['espace','options','user'])->get();
        // $espaces = Espace::with(['options'])->get();
        $total = Reservation::count();
        return view('admin.reservation.home', compact(['reservations']));
    }

    public function create(Espace $espace)
    {
        $users = User::all();

    //    $options = EspaceOption::where('espace_id', $espace['id'])->get();
       $options = EspaceOption::with('espace')->where('espace_id', $espace['id'])->get();
    //    dd($options['id']);

        // Retourner la vue avec les données nécessaires
        return view('admin.reservation.create', compact('espace', 'users', 'options'));
    }

    public function getOptionsByEspace($espaceId)
    {
        // Récupérer les options associées à l'espace
        $options = EspaceOption::with('option')->where('espace_id', $espaceId)->get();

        // Retourner les données en JSON
        return response()->json($options);
    }

    

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
            'option.*' => 'nullable|integer',
        ]);
        
        $reservation = new Reservation();
        $reservation->espace_id = $request->espace;
        $reservation->user_id = $request->user;
        $reservation->dateDebut = $request->dateDebut;
        $reservation->dateFin = $request->dateFin;
        $reservation->prix = $request->prix;
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
            return redirect(route('admin.reservations'));
        } else {
            session()->flash('error', 'Une erreur est survenue');
            return redirect(route('admin.reservations.create'));
        }
    }

    public function edit(Reservation $reservation)
    {
         // Récupérer tous les espaces disponibles
         $espaces = Espace::all();

         // Récupérer tous les utilisateurs (si nécessaire, tu peux filtrer cela par rôle ou autre condition)
         $users = User::all();
         // Initialiser les options comme un tableau vide (elles seront chargées dynamiquement selon l'espace choisi)
         $options = EspaceOption::with('espace')->where('espace_id', $reservation['espace_id'])->get();
 
         // Retourner la vue avec les données nécessaires
         return view('admin.reservation.edit', compact( 'reservation', 'espaces', 'users', 'options'));
    }

    public function update(Request $request, Reservation $reservation)
    {

        Validator::extend('custom_datetime', function ($attribute, $value, $parameters, $validator) {
            $format = 'd/m/Y H:i'; // Custom datetime format
            $date = \DateTime::createFromFormat($format, $value);
            return $date && $date->format($format) === $value;
        });
        

        $validation = $request->validate([
            'espace' => 'required|string',
            'user' => 'required|string',
            'dateDebut' => 'required|date',
            'dateFin' => 'required|date',
            'prix' => 'required|integer',
            'option.*' => 'nullable|integer',
        ]);

        try {
            $reservation->espace_id = $request->espace;
            $reservation->user_id = $request->user;
            $reservation->dateDebut = $request->dateDebut;
            $reservation->dateFin = $request->dateFin;
            $reservation->prix = $request->prix;
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
            return redirect()->route('admin.reservations');
        } catch (\Exception $e) {
            // Message d'erreur en cas de problème
            session()->flash('error', 'Une erreur est survenue');
            return redirect()->route('admin.reservations.edit', $reservation);
        }
    }

    public function destroy($id)
    {
        // Récupérer la reservation à supprimer avec ses relations avec les options
        $reservation = Reservation::findOrFail($id);
        try {
            // Supprimer les relations dans la table pivot 'espace_option'
            if ($reservation->options()->exists()) {
                $reservation->options()->detach();
            }
            $reservation->delete();
            // Message de succès
            session()->flash('success', 'Espace et ses images supprimées avec succès');
            return redirect()->route('admin.reservations');
        } catch (\Exception $e) {
            // Message d'erreur en cas de problème
            session()->flash('error', 'Une erreur est survenue lors de la suppression');
            return redirect()->route('admin.reservations');
        }
    }
}
