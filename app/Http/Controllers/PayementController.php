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
        $pdf->SetTextColor(252, 146, 80);
        $pdf->SetFont('Helvetica', 'B', 15);
        $pdf->Cell(100, 15, 'Facture N°'.$reservation->id, 0, 0, 'L');  // Label "ID Réservation"
        $pdf->Cell(90, 15, 'Doonya Spaces', 0, 1, 'R');    // Valeur de l'ID de la réservation

        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetFont('Helvetica', 'I', 10);
        $pdf->Cell(50, 7, 'Nom : '.$reservation->user->name, 0, 1, 'L');  // Valeur du nom d'utilisateur
        $pdf->Cell(50, 7, 'Email : '.$reservation->user->email, 0, 1, 'L');  // Valeur du nom d'utilisateur 
        $pdf->Cell(50, 7, 'Téléphone : '.$reservation->phone, 0, 1, 'L');  // Valeur du nom d'utilisateur
        $pdf->Cell(50, 7, "Date : " . date('d/m/Y'), 0, 1, 'L');  // Date du jour
        $pdf->Cell(50, 7, 'Lieu : Bd Tensoba Zoobdo, rue 17.69 porte 333, Secteur 06', 0, 1, 'L');  // Valeur du nom d'utilisateur
        $pdf->Ln(5);

        $date = new DateTime($reservation->dateDebut);
        $dateFormattedDebut = $date->format('d/m/Y');
        $date = new DateTime($reservation->dateFin);
        $dateFormattedFin = $date->format('d/m/Y');

        $pdf->Cell(30, 5,'Réservation du : '.$dateFormattedDebut.' au : '.$dateFormattedFin, 0, 1, 'L');  // Valeur du nom d'utilisateur
        $pdf->Cell(50, 5, 'Status de la réservation : '.$reservation->status,0, 1, 'L');
        $pdf->Ln(20);

        // Définir l'en-tête du tableau
        $pdf->SetFont('Helvetica', '', 12);
        $pdf->Cell(80, 10,'Designation', 1, 0, 'C');
        $pdf->Cell(35, 10,'Nbre de jours', 1, 0, 'C');
        $pdf->Cell(35, 10,'Prix par jour', 1, 0, 'C');
        $pdf->Cell(35, 10,'Prix total', 1, 1, 'C');

        $pdf->SetFont('Helvetica', 'I', 10);
        $pdf->Cell(80, 10,'Réservation de :','LR',0, 'L');
        $pdf->Cell(35, 10,'','LR',0, 'L');
        $pdf->Cell(35, 10,'','LR',0, 'L');
        $pdf->Cell(35, 10,'','LR',1, 'L');

        $pdf->Cell(80, 5, $reservation->espace->nom,'LR', 0, 'L');
        $pdf->Cell(35, 5, '2', 'LR', 0, 'C');
        $pdf->Cell(35, 5, number_format($reservation->prix, 2) . ' FCFA', 'LR', 0, 'C');
        $pdf->Cell(35, 5, number_format($reservation->prix, 2) . ' FCFA', 'LR', 1, 'C');

        if ($reservation->options->isNotEmpty()) {
            $pdf->Cell(80, 10, 'Options supplémentaires','LR', 0, 'L');
            $pdf->Cell(35, 10,'','LR',0, 'L');
            $pdf->Cell(35, 10,'','LR',0, 'L');
            $pdf->Cell(35, 10,'','LR',1, 'L');
            foreach ($reservation->options as $option) {
                $pdf->Cell(80, 5, '- ' . $option->option->materiel, 'LR', 0,'L');
                $pdf->Cell(35, 5,'','LR',0, 'L');
                $pdf->Cell(35, 5,'','LR',0, 'L');
                $pdf->Cell(35, 5,'','LR',1, 'L');
            }
        }
        $pdf->Cell(80, 5,'','LR',0, 'L');
        $pdf->Cell(35, 5,'','LR',0, 'L');
        $pdf->Cell(35, 5,'','LR',0, 'L');
        $pdf->Cell(35, 5,'','LR',1, 'L');

        $pdf->Cell(150, 10, 'Total', 1, 0, 'C');
        $pdf->Cell(35, 10, number_format($reservation->prix, 2) . ' FCFA', 1, 1, 'C');
        $pdf->Ln(10);

        // $pdf->SetFont('Helvetica', 'I', 12);
        // // Affichage de l'image de la réservation (facultatif)
        // if ($reservation->image) {
        //     $pdf->Cell(0, 10, 'Image de la Capture d\'ecran:', 0, 1);
        //     // Ajout de l'image à la facture (si elle existe)
        //     $imagePath = storage_path('app/public/' . $reservation->image);
        //     $pdf->Image($imagePath, 10, $pdf->GetY(), 40);
        //     $pdf->Ln(45);  // Déplace le curseur en dessous de l'image
        // }
        
        $pdf->Ln(100);

        // Lignes de séparation
        $pdf->Line(5, $pdf->GetY(), 200, $pdf->GetY());
        $pdf->Ln(5);

        // Remarque
        $pdf->SetFont('Helvetica', 'I', 5);
        $pdf->MultiCell(0, 5, 'Remarque: Merci de votre réservation. Nous vous contacterons bientôt pour finaliser la procédure.', 0, 'L');

        // Télécharger le PDF
        $pdf->Output('facture_' . $reservation->id . '.pdf', 'D');

        
    } catch (\Exception $e) {
        session()->flash('error', 'Une erreur est survenue'.$e->getMessage());
        return redirect()->back();
    }
    }

}
