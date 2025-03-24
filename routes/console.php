<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Schedule::command('reservations:update-status')->daily();
// Schedule::call(function () {
//     logger()->info('Mise à jour des statuts des réservations terminées');
// })->everySecond();
