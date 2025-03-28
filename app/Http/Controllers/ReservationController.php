<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\User;
use App\Models\Espace;
use App\Models\Reservation;
use Illuminate\Support\Arr;
use App\Models\EspaceOption;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\ReservationOption;
use Illuminate\Support\Facades\Validator;

class ReservationController extends Controller
{
    public function index()
    {
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
            'status' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'option.*' => 'nullable|integer',
        ]);
        
        $reservation = new Reservation();
        $reservation->espace_id = $request->espace;
        $reservation->user_id = $request->user;
        $reservation->dateDebut = $request->dateDebut;
        $reservation->dateFin = $request->dateFin;
        $reservation->prix = $request->prix;
        $reservation->status = $request->status;
        $reservation->image = $request->image->store('upload/reservation/images', 'public');
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

        $espace = Espace::find($request->espace);
        $espace->status = 'déjà loué';
        $espace->save();

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
        $espace = Espace::find($reservation['espace_id']);
        // Récupérer tous les utilisateurs (si nécessaire, tu peux filtrer cela par rôle ou autre condition)
        $users = User::all();
        // Initialiser les options comme un tableau vide (elles seront chargées dynamiquement selon l'espace choisi)
        $options = EspaceOption::with('espace')->where('espace_id', $reservation['espace_id'])->get();
        // Vérifier si les dates sont des instances de Carbon et les formater sans l'heure
        $dateDebut = Carbon::parse($reservation->dateDebut)->format('Y-m-d');
        $dateFin = Carbon::parse($reservation->dateFin)->format('Y-m-d');
         // Retourner la vue avec les données nécessaires
         return view('admin.reservation.edit', compact( 'reservation', 'espaces', 'users', 'options', 'dateDebut', 'dateFin', 'espace'));
    }

    public function update(Request $request, Reservation $reservation)
    {
        Validator::extend('custom_datetime', function ($attribute, $value, $parameters, $validator) {
            $format = 'd/m/Y H:i'; // Custom datetime format
            $date = \DateTime::createFromFormat($format, $value);
            return $date && $date->format($format) === $value;
        });
    
        // Validation des données de la requête
        $validation = $request->validate([
            'espace' => 'required|string',
            'user' => 'required|string',
            'dateDebut' => 'required|date',
            'dateFin' => 'required|date',
            'prix' => 'required|integer',
            'status' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // image est nullable
            'option.*' => 'nullable|integer',
        ]);
    
        try {
            // Mise à jour des autres champs
            $reservation->espace_id = $request->espace;
            $reservation->user_id = $request->user;
            $reservation->dateDebut = $request->dateDebut;
            $reservation->dateFin = $request->dateFin;
            $reservation->prix = $request->prix;
            $reservation->status = $request->status;
    
            // Vérifier si une nouvelle image a été téléchargée
            if ($request->hasFile('image')) {
                // Stocker la nouvelle image et mettre à jour le champ image
                $reservation->image = $request->image->store('upload/reservation/images', 'public');
            }
    
            // Sauvegarder les changements de réservation
            $reservation->save();
    
            // Gérer les options associées à la réservation
            if ($request->has('option')) {
                $reservation->options()->detach(); // Détacher les anciennes options
                foreach ($request->option as $option) {
                    $reservationOption = new ReservationOption();
                    $reservationOption->reservation_id = $reservation->id;
                    $reservationOption->espace_option_id = $option;
                    $reservationOption->save();
                }
            }
    
            // Message de succès
            session()->flash('success', 'Réservation mise à jour avec succès');
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
    public function validate($id){
        $reservation = Reservation::find($id);
        $reservation->status = 'Payé';
        $reservation->save();
        $espace = Espace::find($reservation->espace_id);
        $espace->status = 'déjà loué';
        $espace->save();
        return redirect()->route('admin.reservations');
    }

    // public function status(Request $request, Reservation $reservation)
    // {
    //     dd($reservation);
    //     Validator::extend('custom_datetime', function ($attribute, $value, $parameters, $validator) {
    //         $format = 'd/m/Y H:i'; // Custom datetime format
    //         $date = \DateTime::createFromFormat($format, $value);
    //         return $date && $date->format($format) === $value;
    //     });
    
    //     $validation = $request->validate([
    //         'espace' => 'required|string',
    //         'user' => 'required|string',
    //         'dateDebut' => 'required|date',
    //         'dateFin' => 'required|date',
    //         'prix' => 'required|integer',
    //         'status' => 'required|string',
    //         'phone' => 'required|string',
    //         'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    //         'option.*' => 'nullable|integer',
    //     ]);

    //     try {
    //         $reservation->espace_id = $request->espace;
    //         $reservation->user_id = $request->user;
    //         $reservation->dateDebut = $request->dateDebut;
    //         $reservation->dateFin = $request->dateFin;
    //         $reservation->prix = $request->prix;
    //         $reservation->status = 'En cours de validation';
    //         $reservation->image = $request->image->store('upload/reservation/images', 'public');
    //         $reservation->phone = $request->phone;
    //         $reservation->save();
            
    //         $reservation->options()->detach();
    //         if ($request->has('option')) {
    //         foreach ( $request->option as $option ){
    //             $reservationOption = new ReservationOption();
    //             $reservationOption->reservation_id = $reservation->id;
    //             $reservationOption->espace_option_id = $option;
    //             $reservationOption->save();
    //         }
    //     }
    //         // Message de succès
    //         session()->flash('success', 'reservation mise à jour avec succès');
    //         return redirect()->route('dashboard');
    //     } catch (\Exception $e) {
    //         // Message d'erreur en cas de problème
    //         session()->flash('error', 'Une erreur est survenue');
    //         return redirect()->route('dashboard');
    //     }
    // }

}
