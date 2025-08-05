<?php

use Illuminate\Support\Facades\Route;
use Stevebauman\Location\Facades\Location;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GuideController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Backend\BlogController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\CircuitReservationController;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\ExcursionController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\LocalController;
use App\Http\Controllers\OptimizationController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\VoyageController;
use App\Http\Controllers\ShuttleController;
use App\Http\Controllers\CircuitController;
use App\Http\Controllers\TerrainController;
use App\Http\Controllers\EquipeController;
use App\Http\Controllers\TemplateConsigneController;
use App\Http\Controllers\Admin\ExcursionRequestController;
use App\Http\Controllers\Admin\ReservationAdminController;
use App\Http\Controllers\Admin\CircuitAdminReservationController;

// ===================== SHUTTLE ROUTES =====================
Route::prefix('shuttle')->group(function () {
    Route::get('/', [ShuttleController::class, 'index'])->name('shuttle.index');
    Route::post('/book', [ShuttleController::class, 'book'])->name('shuttle.book');
    Route::get('/success', [ShuttleController::class, 'success'])->name('shuttle.success');
    Route::get('/booking/{bookingReference}', [ShuttleController::class, 'bookingDetails'])->name('shuttle.booking-details');
});

// ===================== PUBLIC FRONTEND ROUTES =====================
Route::get('/', [UserController::class, 'Index']);
Route::get('/apropos', [AboutController::class, 'Apropos'])->name('apropos');

Route::controller(BlogController::class)->group(function () {
    Route::get('blog/', 'BlogList')->name('blog.list');
    Route::get('blog/detail/{slug}', 'BlogDetail');
    Route::get('blog/cat/list/{id}', 'BlogCatList');
});

Route::controller(DestinationController::class)->group(function () {
    Route::get('destination/', 'Destination')->name('destination');
    Route::get('destination/detail/{id}', 'DestinationDetail');
    Route::get('vehicule/', 'Vehicule')->name('vehicule');
});

Route::controller(ExcursionController::class)->group(function () {
    Route::get('excursion/', 'Excursion')->name('excursion');
    Route::get('excursion/detail/{id}', 'ExcursionDetail');
});

Route::controller(VoyageController::class)->group(function () {
    Route::get('voyage/detail/{id}', 'VoyageDetail');
    Route::get('formulaire/voyage/', 'FormulaireVoyage')->name('formulaire.voyage');
});

Route::controller(FormController::class)->group(function () {
    Route::post('/envoie/form', 'Envoie')->name('envoie.form');
    Route::get('/Contact', 'Contact')->name('contact');
    Route::post('/sendmail', 'SendMail')->name('send.mail');
});

Route::controller(LocalController::class)->group(function () {
    Route::get('/en', 'Ang')->name('ang');
    Route::get('/fr', 'Fr')->name('fr');
    Route::get('/es', 'Es')->name('es');
});

// Reservation guide
Route::get('/reservation-guide', [ReservationController::class, 'create'])->name('reservation.form');
Route::post('/reservation-guide', [ReservationController::class, 'store'])->name('reservation.store');
Route::get('/guide-senegal', fn() => view('frontend.formulaire.guidejourne'))->name('test.form');
Route::get('/reservation/remerciement/{id}', [ReservationController::class, 'remerciement'])->name('reservation.remerciement');
Route::get('/confirmation-programme/{id}', [ReservationController::class, 'confirmation'])->name('confirmation.programme')->middleware('signed');

// Email liens
Route::get('/confirm-excursion/{id}', [FormController::class, 'confirmReservation'])->name('excursion.confirm');
Route::post('/circuit/reservation', [CircuitReservationController::class, 'store'])->name('envoie.circuit.resa');
Route::get('/circuit/confirm/{id}', [CircuitReservationController::class, 'confirm'])->name('circuit.confirma');
Route::get('/reservation-circuit/success', fn() => view('frontend.destination.reservation_success'))->name('circuit.success');
Route::get('/excursions', [ExcursionController::class, 'Excursion'])->name('excursion.filtres');

// ===================== AUTHENTICATION ROUTES =====================
require __DIR__.'/auth.php';

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', fn() => view('dashboard'))->middleware(['verified'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ===================== ADMIN ROUTES =====================
Route::middleware(['auth', 'roles:admin'])->group(function () {

    // Admin Profile
    Route::get('/admin/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');
    Route::get('/admin/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout');
    Route::get('/admin/profile', [AdminController::class, 'AdminProfile'])->name('admin.profile');
    Route::post('/admin/profile/store', [AdminController::class, 'AdminProfileStore'])->name('admin.profile.store');
    Route::get('/admin/change/password', [AdminController::class, 'AdminChangePassword'])->name('admin.change.password');
    Route::post('/admin/password/update', [AdminController::class, 'AdminPasswordUpdate'])->name('admin.password.update');

    // Blog
    Route::controller(BlogController::class)->group(function () {
        Route::get('/blog/category', 'BlogCategory')->name('blog.category');
        Route::post('/store/blog/category', 'StoreBlogCategory')->name('store.blog.category');
        Route::get('/edit/blog/category/{id}', 'EditBlogCategory');
        Route::post('/update/blog/category', 'UpdateBlogCategory')->name('update.blog.category');
        Route::get('/delete/blog/category/{id}', 'DeteleBlogCategory')->name('delete.blog.category');

        Route::get('/all/blog/post', 'AllBlogPost')->name('all.blog.post');
        Route::get('/add/blog/post', 'AddBlogPost')->name('add.blog.post');
        Route::post('/store/blog/post', 'StoreBlogPost')->name('store.blog.post');
        Route::get('/edit/blog/post/{id}', 'EditBlogPost')->name('edit.blog.post');
        Route::post('/update/blog/post', 'UpdateBlogPost')->name('update.blog.post');
        Route::get('/delete/blog/post/{id}', 'DeleteBlogPost')->name('delete.blog.post');
    });

    // Destinations / Excursions / Voyages
    Route::controller(DestinationController::class)->group(function () {
        Route::get('/all/destination/', 'AllDestination')->name('all.destinations');
        Route::get('/add/destination/', 'AddDestination')->name('add.destination');
        Route::post('/store/destination/', 'StoreDestination')->name('store.destination');
        Route::get('/edit/destination/{id}', 'EditDestination')->name('edit.destination');
        Route::post('/update/destination', 'UpdateDestination')->name('update.destination');
        Route::get('/delete/destination/{id}', 'DeleteDestination')->name('delete.destination');
        Route::get('/delete/multiimage/{id}', 'DeleteMultiImage')->name('multi.image.delete');
    });

    Route::controller(ExcursionController::class)->group(function () {
        Route::get('/all/excursion/', 'AllExcursion')->name('all.excursion');
        Route::get('/add/excursion/', 'AddExcursion')->name('add.excursion');
        Route::post('/store/excursion/', 'StoreExcursion')->name('store.excursion');
        Route::get('/edit/excursion/{id}', 'EditExcursion')->name('edit.excursion');
        Route::post('/update/excursion', 'UpdateExcursion')->name('update.excursion');
        Route::get('/delete/excursion/{id}', 'DeleteExcursion')->name('delete.excursion');
    });

    Route::controller(VoyageController::class)->group(function () {
        Route::get('/all/voyagegroupe/', 'AllVoyages')->name('all.voyage');
        Route::get('/add/voyagegroupe/', 'AddVoyage')->name('add.voyage');
        Route::post('/store/voyage/', 'StoreVoyage')->name('store.voyage');
        Route::get('/edit/voyage/{id}', 'EditVoyage')->name('edit.voyage');
        Route::post('/update/voyage', 'UpdateVoyage')->name('update.voyage');
        Route::get('/delete/voyage/{id}', 'DeleteVoyage')->name('delete.voyage');
    });

    // Optimisation
    Route::get('/optimize', [OptimizationController::class, 'optimize']);

  // Coordination Circuits - ROUTES COMPLÈTES
    Route::controller(CircuitController::class)->group(function () {
        // Dashboard principal
        Route::get('/admin/coordination/circuits', 'dashboard')->name('circuits.dashboard');
        
        // CRUD Circuit
        Route::post('/admin/coordination/circuits', 'store')->name('circuits.store');
        Route::get('/admin/coordination/circuits/{circuit}/edit', 'edit')->name('circuits.edit');
        
        // ✅ ROUTES IMPORTANTES QUI MANQUENT
        Route::put('/admin/coordination/circuits/{circuit}', 'update')->name('circuits.update');
        Route::patch('/admin/coordination/circuits/{circuit}', 'update');
        
        // ✅ CORRIGER LES URLS DES PROGRAMMES
        Route::put('/admin/coordination/programme/{programme}', 'updateJour')->name('programme.update');
        Route::patch('/admin/coordination/programme/{programme}', 'updateJour');
        Route::post('/admin/coordination/programme/{programme}/consignes', 'genererConsignes')->name('programme.consignes');
        
        // Actions sur les circuits
        Route::post('/admin/coordination/circuits/{circuit}/activer', 'activerCircuit')->name('circuits.activer');
        Route::post('/admin/coordination/circuits/{circuit}/envoyer-liens', 'envoyerLiensCircuit')->name('circuits.envoyer-liens');
        Route::post('/admin/coordination/circuits/envoyer-liens-aujourdhui', 'envoyerLiensAujourdhui')->name('circuits.envoyer-liens-aujourdhui');
        Route::get('/admin/coordination/circuits/{circuit}/liens-equipe', 'voirLiensEquipe')->name('circuits.liens-equipe');
        
        // Suppression
        Route::delete('/admin/coordination/circuits/{circuit}', 'destroy')->name('circuits.destroy');
    });

    // Coordination Équipe
    Route::controller(EquipeController::class)->group(function () {
        Route::get('/coordination/equipes', 'dashboard')->name('equipe.dashboard');
        Route::post('/coordination/equipes', 'store')->name('equipe.store');
        Route::post('/coordination/equipes/{equipe}/regenerer-token', 'regenererToken')->name('equipe.regenerer-token');
        Route::post('/coordination/equipes/{equipe}/toggle-actif', 'toggleActif')->name('equipe.toggle-actif');
        Route::post('/coordination/equipes/{equipe}/envoyer-lien', 'envoyerLien')->name('equipe.envoyer-lien');
        Route::get('/coordination/equipes/{equipe}/historique', 'historique')->name('equipe.historique');
        Route::delete('/coordination/equipes/{equipe}', 'destroy')->name('equipe.destroy');
        Route::get('/coordination/equipes/export', 'export')->name('equipe.export');
    });

    // Templates Consignes
    Route::controller(TemplateConsigneController::class)->group(function () {
        Route::get('/coordination/templates', 'index')->name('templates.index');
        Route::get('/coordination/templates/create', 'create')->name('templates.create');
        Route::post('/coordination/templates', 'store')->name('templates.store');
        Route::get('/coordination/templates/{template}/edit', 'edit')->name('templates.edit');
        Route::put('/coordination/templates/{template}', 'update')->name('templates.update');
        Route::post('/coordination/templates/{template}/duplicate', 'duplicate')->name('templates.duplicate');
        Route::post('/coordination/templates/{template}/toggle-actif', 'toggleActif')->name('templates.toggle-actif');
        Route::delete('/coordination/templates/{template}', 'destroy')->name('templates.destroy');
        Route::get('/coordination/templates/{template}/preview', 'preview')->name('templates.preview');
        Route::post('/coordination/templates/tester-mots-cles', 'testerMotsCles')->name('templates.tester-mots-cles');
        Route::post('/coordination/templates/reorder', 'reorder')->name('templates.reorder');
        Route::get('/coordination/templates/export', 'export')->name('templates.export');
        Route::post('/coordination/templates/import', 'import')->name('templates.import');
    });
});

// ===================== GUIDE ROUTES =====================
Route::middleware(['auth', 'guide:guide'])->group(function () {
    Route::get('/guide/dashboard', [GuideController::class, 'GuideDashboard'])->name('guide.dashboard');
});

Route::get('/admin/login', [AdminController::class, 'AdminLogin'])->name('admin.login');

// ===================== ADMIN RESERVATIONS BACKEND =====================
Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('excursion-requests', [ExcursionRequestController::class, 'index'])->name('admin.excursion_requests.index');
    Route::get('excursion-requests/delete/{id}', [ExcursionRequestController::class, 'destroy'])->name('admin.excursion_requests.destroy');
});

Route::get('guide-reservations', [ReservationAdminController::class, 'index'])->name('admin.guide_reservations.index');
Route::get('guide-reservations/delete/{id}', [ReservationAdminController::class, 'destroy'])->name('admin.guide_reservations.destroy');
Route::get('guide-reservations/confirm/{id}', [ReservationAdminController::class, 'confirm'])->name('admin.guide_reservations.confirm');

Route::get('circuit-reservations', [CircuitAdminReservationController::class, 'index'])->name('admin.circuit_reservations.index');
Route::get('circuit-reservations/confirm/{id}', [CircuitAdminReservationController::class, 'confirm'])->name('admin.circuit_reservations.confirm');
Route::get('circuit-reservations/delete/{id}', [CircuitAdminReservationController::class, 'destroy'])->name('admin.circuit_reservations.destroy');

// ===================== TERRAIN (ACCÈS PAR TOKEN) =====================
Route::get('/terrain/{token}', [TerrainController::class, 'accesToken'])->name('terrain.acces');
Route::get('/api/terrain/{token}', [TerrainController::class, 'apiProgrammeJour'])->name('terrain.api');

// ===================== IP TEST =====================
Route::get('/test-ip', function () {
    try {
        $position = Location::get('8.8.8.8');
        dd($position);
    } catch (\Throwable $e) {
        dd($e->getMessage(), $e->getTraceAsString());
    }
});
