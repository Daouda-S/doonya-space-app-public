<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\ReservationOption;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use setasign\Fpdi\TcpdfFpdi;
use TCPDF;

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
            return redirect(route('payement.create', ['reservation' => $reservation]));
        } else {
            session()->flash('error', 'Une erreur est survenue');
            return redirect(route('reservationPages.index'));
        }
    }

    public function create(Reservation $reservation)
    {
        return view('reservationPages.payement', compact('reservation'));
    }

    public function validate(Request $request, Reservation $reservation)
    {
        // dd($reservation);
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
        
        if ($request->has('option')) {
            $reservation->options()->detach();
            foreach ( $request->option as $option ){
                $reservationOption = new ReservationOption();
                $reservationOption->reservation_id = $reservation->id;
                $reservationOption->espace_option_id = $option;
                $reservationOption->save();
            }
        }
            session()->flash('success', 'reservation mise à jour avec succès');
            return redirect(route('payement.success',['reservation' => $reservation]));
        } catch (\Exception $e) {
            // Message d'erreur en cas de problème
            session()->flash('error', 'Une erreur est survenue'.$e->getMessage());
            return redirect()->back();
        }
    }

    public function success(Reservation $reservation)
    {
        return view('reservationPages.success', compact('reservation'));
    }

    public function download($id)
    {
        // Récupérez la réservation en fonction de l'ID passé
    $reservation = Reservation::find($id);
    if (!$reservation) {
        session()->flash('error', 'La réservation est introuvable.');
        return redirect(route('reservationPages.index')); // Ou toute autre redirection
    }

    try {
        $pdf = new TcpdfFpdi();
        // Créer une nouvelle instance de TCPDF avec FPDI
        // Ajouter une page
        $pdf->AddPage();

        // ID Réservation
        $pdf->Cell(35, 10, 'ID Réservation :', 0, 0, 'L');  // Label "ID Réservation"
        $pdf->Cell(30, 10, $reservation->id, 0, 1, 'L');    // Valeur de l'ID de la réservation

        // ID Utilisateur   
        $pdf->Cell(30, 10, 'ID Utilisateur :', 0, 0, 'L');  // Label "ID Utilisateur"
        $pdf->Cell(30, 10, $reservation->user->name, 0, 1, 'L');  // Valeur du nom d'utilisateur

        $pdf->Ln(10);

        // Informations sur la réservation - Tableau
        $pdf->SetFont('Helvetica', '', 12);

        // Définir l'en-tête du tableau
        $pdf->SetFillColor(200, 220, 255);  // Couleur de fond pour l'en-tête
        $pdf->Cell(60, 10, 'ID Réservation', 1, 0, 'C', true);
        $pdf->Cell(60, 10, 'ID Utilisateur', 1, 0, 'C', true);
        $pdf->Cell(60, 10, 'ID Espace', 1, 1, 'C', true);  // Changement de ligne

        // Remplir les informations du tableau
        $pdf->SetFont('Helvetica', '', 12);
        $pdf->Cell(60, 10, $reservation->id, 1, 0, 'C');
        $pdf->Cell(60, 10, $reservation->user_id, 1, 0, 'C');
        $pdf->Cell(60, 10, $reservation->espace_id, 1, 1, 'C');

        // Date de début et date de fin
        $pdf->Cell(60, 10, 'Date Début', 1, 0, 'C', true);
        $pdf->Cell(60, 10, 'Date Fin', 1, 0, 'C', true);
        $pdf->Cell(60, 10, 'Prix', 1, 1, 'C', true);  // Changement de ligne

        $pdf->Cell(60, 10, $reservation->dateDebut, 1, 0, 'C');
        $pdf->Cell(60, 10, $reservation->dateFin, 1, 0, 'C');
        $pdf->Cell(60, 10, number_format($reservation->prix, 2) . ' €', 1, 1, 'C');

        // Statut et téléphone
        $pdf->Cell(60, 10, 'Statut', 1, 0, 'C', true);
        $pdf->Cell(60, 10, 'Téléphone', 1, 1, 'C', true);  // Changement de ligne

        $pdf->Cell(60, 10, $reservation->status, 1, 0, 'C');
        $pdf->Cell(60, 10, $reservation->phone, 1, 1, 'C');

        // Affichage de l'image de la réservation (facultatif)
        if ($reservation->image) {
            $pdf->Cell(0, 10, 'Image de la réservation:', 0, 1);
            // Ajout de l'image à la facture (si elle existe)
            $imagePath = storage_path('app/public/' . $reservation->image);
            $pdf->Image($imagePath, 10, $pdf->GetY(), 40);
            $pdf->Ln(45);  // Déplace le curseur en dessous de l'image
        }

        // Options supplémentaires (si disponibles)
        if ($reservation->options->isNotEmpty()) {
            $pdf->Cell(0, 10, 'Options supplémentaires:', 0, 1);
            foreach ($reservation->options as $option) {
                $pdf->Cell(0, 10, '- ' . $option->option->materiel, 0, 1);
            }
            $pdf->Ln(5);
        }

        // Lignes de séparation
        $pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY());
        $pdf->Ln(10);

        // Remarque
        $pdf->SetFont('Helvetica', 'I', 10);
        $pdf->MultiCell(0, 10, 'Remarque: Merci de votre réservation. Nous vous contacterons bientôt pour finaliser la procédure.', 0, 'L');

        // Télécharger le PDF
        $pdf->Output('facture_' . $reservation->id . '.pdf', 'D');

        
    } catch (\Exception $e) {
        session()->flash('error', 'Une erreur est survenue'.$e->getMessage());
        return redirect()->back();
    }
    }

}
