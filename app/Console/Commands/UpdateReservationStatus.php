<?php

namespace App\Console\Commands;

use App\Models\Reservation;
use Illuminate\Support\Carbon;
use Illuminate\Console\Command;

class UpdateReservationStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-reservation-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Mettre à jour le statut des réservations terminées';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // logger()->info('Mise à jour des statuts des réservations terminées');
        $reservations = Reservation::where('status', '=', 'Payé')->get();
        foreach ($reservations as $reservation) {
            if (Carbon::parse($reservation->dateFin)->isBeforeOrEqualTo(Carbon::today()) && $reservation->status !== 'Terminée') {
                $reservation->status = 'Terminée';
                $reservation->save();
                $this->info("Réservation ID {$reservation->id} mise à jour.");
            }
        }
    }
}
