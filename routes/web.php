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
use App\Http\Controllers\ExcursionController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\LocalController;
use App\Http\Controllers\OptimizationController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\VoyageController;
use App\Http\Controllers\CircuitController;
use App\Http\Controllers\TerrainController;
use App\Http\Controllers\EquipeController;
use App\Http\Controllers\TemplateConsigneController;
use App\Http\Controllers\Admin\ExcursionRequestController;
use App\Http\Controllers\Admin\ReservationAdminController;
use App\Http\Controllers\Admin\CircuitAdminReservationController;
use App\Http\Controllers\ClientDashboardsController;

// ===================== SHUTTLE ROUTES =====================
// Route::prefix('shuttle')->group(function () {
//     Route::get('/', [ShuttleController::class, 'index'])->name('shuttle.index');
//     Route::post('/book', [ShuttleController::class, 'book'])->name('shuttle.book');
//     Route::get('/success', [ShuttleController::class, 'success'])->name('shuttle.success');
//     Route::get('/booking/{bookingReference}', [ShuttleController::class, 'bookingDetails'])->name('shuttle.booking-details');
// });

// ===================== PUBLIC FRONTEND ROUTES =====================
Route::get('/', [UserController::class, 'Index']);
Route::get('/apropos', [AboutController::class, 'Apropos'])->name('apropos');

Route::controller(BlogController::class)->group(function () {
    Route::get('blog/', 'BlogList')->name('blog.list');
    Route::get('blog/detail/{slug}', 'BlogDetail');
    Route::get('blog/cat/list/{id}', 'BlogCatList');
});

// Route véhicules conservée (sans destinations)
Route::get('vehicule/', [App\Http\Controllers\Admin\VehicleController::class, 'index'])->name('vehicule');

Route::controller(ExcursionController::class)->group(function () {
    Route::get('excursion/', 'Excursion')->name('excursion');
    Route::get('excursion/detail/{id}', 'ExcursionDetail');
    Route::get('/excursions', 'Excursion')->name('excursion.filtres');
});

// ===================== ROUTES VOYAGES FRONTEND (NOUVELLES) =====================
Route::controller(VoyageController::class)->group(function () {
    // Routes publiques voyages - CORRIGÉ: nom des routes cohérent
    Route::get('/nos-voyages', 'PublicVoyages')->name('voyages.index');
    Route::get('/voyages/{id}/detail', 'VoyageDetail')->name('voyages.detail');
    Route::get('/voyages/{id}/programme', 'VoyageProgramme')->name('voyages.programme');
    Route::get('/voyages/{id}/galerie', 'VoyageGalerie')->name('voyages.galerie');
    
    // Routes existantes (compatibilité)
    Route::get('voyage/detail/{id}', 'VoyageDetail')->name('voyage.detail.old'); // CORRIGÉ: nom unique
    Route::get('/formulaire/voyage/', 'FormulaireVoyage')->name('formulaire.voyage');
    
    // Routes protégées (nécessitent connexion)
    Route::middleware(['auth'])->group(function () {
        Route::get('/voyages/{id}/programme-complet', 'VoyageProgrammeComplet')->name('voyages.programme-complet');
        Route::get('/voyages/{id}/reservation', 'VoyageReservation')->name('voyages.reservation');
    });
    
    // Routes AJAX pour consultation progressive
    Route::get('/voyages/{id}/etape/{numero}', 'getEtapeDetail')->name('voyages.etape-detail');
    Route::post('/voyages/{id}/track-consultation', 'trackConsultation')->name('voyages.track-consultation');
    Route::get('/voyages/{id}/consultation-status', 'getConsultationStatus')->name('voyages.consultation-status');
});

// ===================== DASHBOARD CLIENT =====================
Route::middleware(['auth'])->group(function () {
    // Dashboard principal - MODIFICATION: éviter conflit avec le dashboard existant
    Route::get('/mon-espace', [ClientDashboardsController::class, 'index'])->name('client.dashboard');
    
    // Gestion des voyages client
    Route::get('/mes-voyages', [ClientDashboardsController::class, 'mesVoyages'])->name('client.voyages');
    Route::get('/mes-reservations', [ClientDashboardsController::class, 'mesReservations'])->name('client.reservations');
    
    // Profil utilisateur
    Route::get('/profil', [ClientDashboardsController::class, 'profil'])->name('client.profil');
    Route::put('/profil', [ClientDashboardsController::class, 'updateProfil'])->name('client.profil.update');
    Route::put('/profil/password', [ClientDashboardsController::class, 'updatePassword'])->name('client.profil.password');
    
    // Actions AJAX
    Route::post('/voyages/{id}/toggle-favori', [ClientDashboardsController::class, 'toggleFavori'])->name('client.toggle-favori');
    Route::delete('/consultations/{voyage_id}', [ClientDashboardsController::class, 'supprimerConsultation'])->name('client.supprimer-consultation');
});

// ===================== AUTRES ROUTES EXISTANTES =====================
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
Route::get('/reservation/remerciement/{id}', [ReservationController::class, 'remerciement'])->name('reservation.remerciement');
Route::get('/confirmation-programme/{id}', [ReservationController::class, 'confirmation'])->name('confirmation.programme')->middleware('signed');

// Email liens
Route::get('/confirm-excursion/{id}', [FormController::class, 'confirmReservation'])->name('excursion.confirm');
Route::post('/circuit/reservation', [CircuitReservationController::class, 'store'])->name('envoie.circuit.resa');
Route::get('/circuit/confirm/{id}', [CircuitReservationController::class, 'confirm'])->name('circuit.confirma');
Route::get('/reservation-circuit/success', fn() => view('frontend.destination.reservation_success'))->name('circuit.success');

// ===================== FRONTEND HÉBERGEMENTS ROUTES (PUBLIC) =====================
Route::controller(App\Http\Controllers\Frontend\HebergementController::class)->group(function () {
    Route::get('/hebergements', 'index')->name('hebergements.index');
    Route::get('/hebergements/{hebergement:slug}', 'show')->name('hebergements.show');
    Route::get('/hebergements/region/{region}', 'parRegion')->name('hebergements.region');
    Route::get('/hebergements/search', 'search')->name('hebergements.search');
    Route::get('/api/hebergements/carte', 'apiCarte')->name('hebergements.api.carte');
    Route::get('/api/hebergements/filtres', 'apiFiltres')->name('hebergements.api.filtres');
    Route::post('/hebergements/{hebergement}/commentaire', 'ajouterCommentaire')->name('hebergements.commentaire');
    Route::post('/hebergements/{hebergement}/favori', 'toggleFavori')->name('hebergements.favori')->middleware('auth');
    Route::get('/hebergements/comparateur', 'comparateur')->name('hebergements.comparateur');
    Route::post('/hebergements/comparer', 'comparer')->name('hebergements.comparer');
});

// ===================== AUTHENTICATION ROUTES =====================
require __DIR__.'/auth.php';

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', fn() => view('dashboard'))->middleware(['verified'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ===================== ADMIN ROUTES PRINCIPAL =====================
// TEMPORAIRE: Utilisation du middleware AdminRole custom
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


    Route::controller(ExcursionController::class)->group(function () {
        Route::get('/all/excursion/', 'AllExcursion')->name('all.excursion');
        Route::get('/add/excursion/', 'AddExcursion')->name('add.excursion');
        Route::post('/store/excursion/', 'StoreExcursion')->name('store.excursion');
        Route::get('/edit/excursion/{id}', 'EditExcursion')->name('edit.excursion');
        Route::post('/update/excursion', 'UpdateExcursion')->name('update.excursion');
        Route::get('/delete/excursion/{id}', 'DeleteExcursion')->name('delete.excursion');
    });

    // Optimisation
    Route::get('/optimize', [OptimizationController::class, 'optimize']);

    // Coordination Circuits
    Route::controller(CircuitController::class)->group(function () {
        Route::get('/admin/coordination/circuits', 'dashboard')->name('circuits.dashboard');
        Route::post('/admin/coordination/circuits', 'store')->name('circuits.store');
        Route::get('/admin/coordination/circuits/{circuit}/edit', 'edit')->name('circuits.edit');
        Route::put('/admin/coordination/circuits/{circuit}', 'update')->name('circuits.update');
        Route::patch('/admin/coordination/circuits/{circuit}', 'update');
        Route::put('/admin/coordination/programme/{programme}', 'updateJour')->name('programme.update');
        Route::patch('/admin/coordination/programme/{programme}', 'updateJour');
        Route::post('/admin/coordination/programme/{programme}/consignes', 'genererConsignes')->name('programme.consignes');
        Route::post('/admin/coordination/circuits/{circuit}/activer', 'activerCircuit')->name('circuits.activer');
        Route::post('/admin/coordination/circuits/{circuit}/envoyer-liens', 'envoyerLiensCircuit')->name('circuits.envoyer-liens');
        Route::post('/admin/coordination/circuits/envoyer-liens-aujourdhui', 'envoyerLiensAujourdhui')->name('circuits.envoyer-liens-aujourdhui');
        Route::get('/admin/coordination/circuits/{circuit}/liens-equipe', 'voirLiensEquipe')->name('circuits.liens-equipe');
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

    // ===================== HÉBERGEMENTS ROUTES =====================
    Route::controller(App\Http\Controllers\Admin\HebergementController::class)->group(function () {
        Route::get('/admin/hebergements', 'index')->name('admin.hebergements.index');
        Route::get('/admin/hebergements/create', 'create')->name('admin.hebergements.create');
        Route::post('/admin/hebergements', 'store')->name('admin.hebergements.store');
        Route::get('/admin/hebergements/{hebergement}', 'show')->name('admin.hebergements.show');
        Route::get('/admin/hebergements/{hebergement}/edit', 'edit')->name('admin.hebergements.edit');
        Route::put('/admin/hebergements/{hebergement}', 'update')->name('admin.hebergements.update');
        Route::delete('/admin/hebergements/{hebergement}', 'destroy')->name('admin.hebergements.destroy');
        Route::post('/admin/hebergements/{hebergement}/toggle-featured', 'toggleFeatured')->name('admin.hebergements.toggle-featured');
        Route::post('/admin/hebergements/update-ordre', 'updateOrdre')->name('admin.hebergements.update-ordre');
        Route::delete('/admin/hebergements/{hebergement}/image', 'deleteImage')->name('admin.hebergements.delete-image');
        Route::get('/admin/hebergements-commentaires', 'commentaires')->name('admin.hebergements.commentaires');
        Route::post('/admin/commentaires/{commentaire}/approuver', 'approuverCommentaire')->name('admin.commentaires.approuver');
        Route::post('/admin/commentaires/{commentaire}/rejeter', 'rejeterCommentaire')->name('admin.commentaires.rejeter');
        Route::get('/admin/hebergements-statistiques', 'statistiques')->name('admin.hebergements.statistiques');
        Route::get('/admin/hebergements-export', 'export')->name('admin.hebergements.export');
    });
});

// ===================== VOYAGES BACKEND (ADMIN SEULEMENT) =====================
// TEMPORAIRE: Utilisation du middleware AdminRole custom
Route::prefix('admin')->middleware(['auth', 'roles:admin'])->group(function () {
    
    // Routes CRUD de base pour les voyages - CORRIGÉ: Noms de routes préfixés admin
    Route::get('/voyages', [VoyageController::class, 'AllVoyages'])->name('admin.voyages.index');
    Route::get('/voyages/create', [VoyageController::class, 'AddVoyage'])->name('admin.voyages.create');
    Route::post('/voyages/store', [VoyageController::class, 'StoreVoyage'])->name('admin.voyages.store');
    Route::get('/voyages/{id}/edit', [VoyageController::class, 'EditVoyage'])->name('admin.voyages.edit');
    Route::post('/voyages/update', [VoyageController::class, 'UpdateVoyage'])->name('admin.voyages.update');
    Route::get('/voyages/{id}/delete', [VoyageController::class, 'DeleteVoyage'])->name('admin.voyages.delete');
    
    // Routes AJAX pour la gestion des étapes - CORRIGÉ: Noms de routes préfixés admin
    Route::get('/voyages/{id}/etapes', [VoyageController::class, 'getVoyageEtapes'])->name('admin.voyages.etapes');
    Route::post('/voyages/{voyage_id}/etapes', [VoyageController::class, 'AddEtapeToVoyage'])->name('admin.voyages.etapes.store');
    Route::get('/etapes/{etape_id}/edit', [VoyageController::class, 'getEtapeForEdit'])->name('admin.etapes.edit');
    Route::put('/etapes/{etape_id}', [VoyageController::class, 'UpdateEtape'])->name('admin.etapes.update');
    Route::delete('/etapes/{etape_id}', [VoyageController::class, 'DeleteEtape'])->name('admin.etapes.delete');
    
    // Routes AJAX pour la gestion des activités - CORRIGÉ: Noms de routes préfixés admin
    Route::get('/voyages/{id}/activites', [VoyageController::class, 'getVoyageActivites'])->name('admin.voyages.activites');
    Route::post('/voyages/{voyage_id}/activites', [VoyageController::class, 'AddActiviteToVoyage'])->name('admin.voyages.activites.store');
    Route::get('/activites/{activite_id}/edit', [VoyageController::class, 'getActiviteForEdit'])->name('admin.activites.edit');
    Route::put('/activites/{activite_id}', [VoyageController::class, 'UpdateActivite'])->name('admin.activites.update');
    Route::delete('/activites/{activite_id}', [VoyageController::class, 'DeleteActivite'])->name('admin.activites.delete');
    
    // Routes pour la gestion des galeries - CORRIGÉ: Noms de routes préfixés admin
    Route::post('/voyages/{voyage_id}/galeries', [VoyageController::class, 'AddImageToGalerie'])->name('admin.voyages.galeries.store');
    Route::delete('/galeries/{galerie_id}', [VoyageController::class, 'DeleteImageGalerie'])->name('admin.galeries.delete');
    
    // Route pour dupliquer un voyage - CORRIGÉ: Nom de route préfixé admin
    Route::post('/voyages/{id}/duplicate', [VoyageController::class, 'DuplicateVoyage'])->name('admin.voyages.duplicate');
});

// ===================== GUIDE ROUTES =====================
// CORRIGÉ: Utilisation du middleware AdminRole pour le rôle guide
Route::middleware(['auth', 'role:guide'])->group(function () {
    Route::get('/guide/dashboard', [GuideController::class, 'GuideDashboard'])->name('guide.dashboard');
});

Route::get('/admin/login', [AdminController::class, 'AdminLogin'])->name('admin.login');

// ===================== ADMIN RESERVATIONS BACKEND =====================
// TEMPORAIRE: Utilisation du middleware AdminRole custom
Route::prefix('admin')->middleware(['auth', 'roles:admin'])->group(function () {
    Route::get('excursion-requests', [ExcursionRequestController::class, 'index'])->name('admin.excursion_requests.index');
    Route::get('excursion-requests/delete/{id}', [ExcursionRequestController::class, 'destroy'])->name('admin.excursion_requests.destroy');
    Route::get('guide-reservations', [ReservationAdminController::class, 'index'])->name('admin.guide_reservations.index');
    Route::get('guide-reservations/delete/{id}', [ReservationAdminController::class, 'destroy'])->name('admin.guide_reservations.destroy');
    Route::get('guide-reservations/confirm/{id}', [ReservationAdminController::class, 'confirm'])->name('admin.guide_reservations.confirm');
    Route::get('circuit-reservations', [CircuitAdminReservationController::class, 'index'])->name('admin.circuit_reservations.index');
    Route::get('circuit-reservations/confirm/{id}', [CircuitAdminReservationController::class, 'confirm'])->name('admin.circuit_reservations.confirm');
    Route::get('circuit-reservations/delete/{id}', [CircuitAdminReservationController::class, 'destroy'])->name('admin.circuit_reservations.destroy');
});

// ===================== TERRAIN (ACCÈS PAR TOKEN) =====================
Route::get('/terrain/{token}', [TerrainController::class, 'accesToken'])->name('terrain.acces');
Route::get('/api/terrain/{token}', [TerrainController::class, 'apiProgrammeJour'])->name('terrain.api');

