<?php

// Routes API pour les voyages (dans routes/api.php)

use App\Http\Controllers\VoyageController;
use Illuminate\Support\Facades\Route;

// Routes API v1 pour les applications mobiles ou intégrations externes
Route::prefix('v1')->group(function () {
    
    // Routes publiques (sans authentification)
    Route::get('/voyages', [VoyageController::class, 'getVoyagesAPI'])->name('api.voyages');
    Route::get('/voyage/{id}', [VoyageController::class, 'getVoyageDetailAPI'])->name('api.voyage.detail');
    Route::get('/voyage/{id}/etapes', [VoyageController::class, 'getVoyageEtapesAPI'])->name('api.voyage.etapes');
    Route::get('/voyage/{id}/activites', [VoyageController::class, 'getVoyageActivitesAPI'])->name('api.voyage.activites');
    Route::get('/voyage/{id}/galerie', [VoyageController::class, 'getVoyageGalerieAPI'])->name('api.voyage.galerie');
    
    // Routes avec authentification API (optionnel)
    Route::middleware('auth:sanctum')->group(function () {
        // Réservations ou actions nécessitant une authentification
        Route::post('/voyage/{id}/reservation', [VoyageController::class, 'createReservationAPI'])->name('api.voyage.reservation');
        Route::get('/mes-reservations', [VoyageController::class, 'getUserReservationsAPI'])->name('api.user.reservations');
    });

       
});