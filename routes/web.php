<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\EspaceController;
use App\Http\Controllers\OptionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\TemporaryImageController;
use App\Http\Controllers\PayementController;

Route::get('/', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/index', function () {
    return view('index');
})->name('index');

// Route::get('/reservationPages/index', function () {
//     return view('reservationPages.index');
// })->name('reservationPages.index');

Route::get('reservationPages/index/{espace}',[PagesController::class , 'createReservation' ])->middleware(['auth', 'verified'])->name('reservationPages.index');

Route::get('/reservationPages/payement', function () {
    return view('reservationPages.payement');
})->middleware(['auth', 'verified'])->name('reservationPages.payement');

// admin dashboard

// user pages

Route::get('pages/apropos',[PagesController::class , 'apropos' ])->name('pages.apropos');
Route::get('pages/boutique',[PagesController::class , 'boutique' ])->name('pages.boutique');
Route::get('pages/services',[PagesController::class , 'services' ])->name('pages.services');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // payement.....
    Route::get('payement/create/{reservation}',[PayementController::class, 'create' ])->name('payement.create');
    Route::post('payement/save',[PayementController::class, 'save' ])->name('payement.save');
    Route::post('payement/validate/{reservation}',[PayementController::class, 'validate' ])->name('payement.validate');
    Route::get('payement/success/{reservation}',[PayementController::class, 'success' ])->name('payement.success');
    Route::get('payement/download/{id}',[PayementController::class, 'download' ])->name('payement.download');
});

Route::middleware(['auth', 'admin'])->group(function () {

    Route::get('admin/dashboard',[HomeController::class , 'index' ]);

    // option.....
    Route::get('admin/options',[OptionController::class , 'index' ])->name('admin.options');
    Route::get('admin/options/create',[OptionController::class , 'create' ])->name('admin.options.create');
    Route::post('admin/options/save',[OptionController::class , 'save' ])->name('admin.options.save');
    Route::delete('admin/options/{option}', [OptionController::class, 'destroy'])->name('admin.options.destroy');
    Route::get('admin/options/{option}/edit', [OptionController::class, 'edit'])->name('admin.options.edit');
    Route::put('admin/options/{option}', [OptionController::class, 'update'])->name('admin.options.update');
    Route::delete('/admin/options/image/{image}', [OptionController::class, 'deleteImage'])->name('admin.options.deleteImage');

    // espace.....
    Route::get('admin/espaces',[EspaceController::class , 'index' ])->name('admin.espaces');
    Route::get('admin/espaces/create',[EspaceController::class , 'create' ])->name('admin.espaces.create');
    Route::post('admin/espaces/save',[EspaceController::class , 'save' ])->name('admin.espaces.save');
    Route::delete('admin/espaces/{espace}', [EspaceController::class, 'destroy'])->name('admin.espaces.destroy');
    Route::get('admin/espaces/{espace}/edit', [EspaceController::class, 'edit'])->name('admin.espaces.edit');
    Route::put('admin/espaces/{espace}', [EspaceController::class, 'update'])->name('admin.espaces.update');
    Route::delete('/admin/espaces/image/{image}', [EspaceController::class, 'deleteImage'])->name('admin.espaces.deleteImage');
    
    // reservation.....
    Route::get('admin/reservations',[ReservationController::class, 'index' ])->name('admin.reservations');
    Route::get('admin/reservations/create/{espace}',[ReservationController::class , 'create' ])->name('admin.reservations.create');
    Route::post('admin/reservations/save',[ReservationController::class , 'save' ])->name('admin.reservations.save');
    Route::delete('admin/reservations/{reservation}', [ReservationController::class, 'destroy'])->name('admin.reservations.destroy');
    Route::get('admin/reservations/{reservation}/edit', [ReservationController::class, 'edit'])->name('admin.reservations.edit');
    Route::put('admin/reservations/{reservation}', [ReservationController::class, 'update'])->name('admin.reservations.update');
    Route::get('admin/reservationsOption/{espace_id}', [ReservationController::class, 'getOptionsByEspace'])->name('admin.reservationsOption');
    Route::get('admin/reservations/validate/{reservation}', [ReservationController::class, 'validate'])->name('admin.reservations.validate');
    // Route::put('admin/reservation/status/{reservation}',[ReservationController::class, 'status' ])->name('admin.reservations.status');

});

require __DIR__.'/auth.php';
