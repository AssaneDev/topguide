<?php
// modules/VoyagesGroupes/routes.php

use Illuminate\Support\Facades\Route;
use Modules\VoyagesGroupes\Controllers\VoyageController;

Route::prefix('voyages')->middleware('web')->group(function () {
    Route::get('/', [VoyageController::class, 'index'])->name('voyages.index');
    Route::get('/{id}', [VoyageController::class, 'show'])->name('voyages.show');
    Route::post('/{id}/interesser', [VoyageController::class, 'interesser'])->name('voyages.interesser');
    Route::post('/{id}/inscrire', [VoyageController::class, 'inscrire'])->name('voyages.inscrire');
});
