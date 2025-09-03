<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Voyage;
use App\Models\Etape;
use App\Models\Activite;
use App\Models\Galerie;
use Carbon\Carbon;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\Log; // ✅ AJOUT DE L'IMPORT

class VoyageController extends Controller
{
    // ============= MÉTHODES CRUD DE BASE =============
    
    // Afficher tous les voyages
    public function AllVoyages(){
        $voyages = Voyage::with(['etapes', 'activites'])->latest()->get();
        return view('backend.voyage.all_voyages', compact('voyages'));
    }

    // Formulaire d'ajout de voyage
    public function AddVoyage(){
        return view('backend.voyage.add_voyage');
    }

    // Enregistrer un nouveau voyage
    public function StoreVoyage(Request $request){
        // Validation
        $request->validate([
            'nom_voyage' => 'required|string|max:255',
            'description_courte' => 'required|string',
            'description_longue' => 'required|string',
            'type_voyage' => 'required|string',
            'region' => 'required|string',
            'prix_base' => 'required|numeric',
            'duree_jours' => 'required|integer|min:1',
            'participants_max' => 'required|integer|min:1',
            'image_couverture' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'image_principale' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Créer les dossiers s'ils n'existent pas
        if (!file_exists(public_path('upload/voyage_couverture'))) {
            mkdir(public_path('upload/voyage_couverture'), 0777, true);
        }
        if (!file_exists(public_path('upload/voyage_principale'))) {
            mkdir(public_path('upload/voyage_principale'), 0777, true);
        }

        // Traitement de l'image de couverture
        $image_couverture = $request->file('image_couverture');
        $manager_couverture = new ImageManager(new Driver());
        $name_gen_couverture = hexdec(uniqid()).'.'.$image_couverture->getClientOriginalExtension();
        $img_couverture = $manager_couverture->read($image_couverture);
        $img_couverture = $img_couverture->resize(370,150);
        $img_couverture->toJpeg(80)->save(base_path('public/upload/voyage_couverture/'.$name_gen_couverture));
        $save_url_couverture = 'upload/voyage_couverture/'.$name_gen_couverture;

        // Traitement de l'image principale
        $image_principale = $request->file('image_principale');
        $manager_principale = new ImageManager(new Driver());
        $name_gen_principale = hexdec(uniqid()).'.'.$image_principale->getClientOriginalExtension();
        $img_principale = $manager_principale->read($image_principale);
        $img_principale = $img_principale->resize(1362,900);
        $img_principale->toJpeg(80)->save(base_path('public/upload/voyage_principale/'.$name_gen_principale));
        $save_url_principale = 'upload/voyage_principale/'.$name_gen_principale;

        // Création du voyage
        $voyage_id = Voyage::insertGetId([
            'nom_voyage' => $request->nom_voyage,
            'description_courte' => $request->description_courte,
            'description_longue' => $request->description_longue,
            'image_couverture' => $save_url_couverture,
            'image_principale' => $save_url_principale,
            'type_voyage' => $request->type_voyage,
            'region' => $request->region,
            'duree_jours' => $request->duree_jours,
            'duree_nuits' => $request->duree_nuits ?? ($request->duree_jours - 1),
            'prix_base' => $request->prix_base,
            'prix_avec_guide' => $request->prix_avec_guide,
            'prix_par_personne' => $request->prix_par_personne ?? $request->prix_base,
            'supplement_chambre_individuelle' => $request->supplement_chambre_individuelle,
            'participants_min' => $request->participants_min ?? 1,
            'participants_max' => $request->participants_max,
            'difficulte' => $request->difficulte ?? 'facile',
            'niveau_confort' => $request->niveau_confort ?? 'standard',
            'point_depart' => $request->point_depart,
            'point_arrivee' => $request->point_arrivee,
            'transports_inclus' => $request->transports_inclus ? json_encode($request->transports_inclus) : null,
            'hebergements_inclus' => $request->hebergements_inclus ? json_encode($request->hebergements_inclus) : null,
            'equipements_obligatoires' => $request->equipements_obligatoires ? json_encode($request->equipements_obligatoires) : null,
            'saisons_disponibles' => $request->saisons_disponibles ? json_encode($request->saisons_disponibles) : null,
            'delai_reservation_min' => $request->delai_reservation_min ?? 7,
            'repas_inclus' => $request->has('repas_inclus'),
            'guide_inclus' => $request->has('guide_inclus'),
            'sur_mesure' => $request->has('sur_mesure'),
            'recommande' => $request->has('recommande'),
            'nouveau' => $request->has('nouveau'),
            'equipements_recommandes' => $request->equipements_recommandes,
            'conditions_particulieres' => $request->conditions_particulieres,
            'informations_generales' => $request->informations_generales,
            'conseils_sante' => $request->conseils_sante,
            'infos_climat' => $request->infos_climat,
            'infos_culture_locale' => $request->infos_culture_locale,
            'offre_guide' => $request->offre_guide,
            'statut' => $request->statut ?? 'brouillon',
        ]);

        // Traitement des galeries d'images multiples
        if($voyage_id && $request->hasFile('galerie_images')){
            $this->handleGalerieImages($request->file('galerie_images'), $voyage_id);
        }

        $notification = array(
            'message' => 'Voyage ajouté avec succès',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    // Formulaire d'édition
    public function EditVoyage($id){
        $voyage = Voyage::with(['etapes', 'activites', 'galeries'])->findOrFail($id);
        return view('backend.voyage.edit_voyage', compact('voyage'));
    }

    // Mettre à jour un voyage
    public function UpdateVoyage(Request $request){
        $id = $request->id;
        $voyage = Voyage::findOrFail($id);

        // Mise à jour des champs texte
        $voyage->nom_voyage = $request->nom_voyage;
        $voyage->description_courte = $request->description_courte;
        $voyage->description_longue = $request->description_longue;
        $voyage->type_voyage = $request->type_voyage;
        $voyage->region = $request->region;
        $voyage->duree_jours = $request->duree_jours;
        $voyage->prix_base = $request->prix_base;
        $voyage->prix_avec_guide = $request->prix_avec_guide;
        $voyage->participants_min = $request->participants_min ?? 1;
        $voyage->participants_max = $request->participants_max;
        $voyage->difficulte = $request->difficulte ?? 'facile';
        $voyage->transports_inclus = $request->transports_inclus ? json_encode($request->transports_inclus) : null;
        $voyage->hebergements_inclus = $request->hebergements_inclus ? json_encode($request->hebergements_inclus) : null;
        $voyage->repas_inclus = $request->has('repas_inclus');
        $voyage->guide_inclus = $request->has('guide_inclus');
        $voyage->equipements_recommandes = $request->equipements_recommandes;
        $voyage->conditions_particulieres = $request->conditions_particulieres;
        $voyage->informations_generales = $request->informations_generales;
        $voyage->offre_guide = $request->offre_guide;
        $voyage->statut = $request->statut ?? 'brouillon';

        // Mise à jour des images si fournies
        if($request->file('image_couverture')) {
            if(file_exists(public_path($voyage->image_couverture))) {
                unlink(public_path($voyage->image_couverture));
            }
            $voyage->image_couverture = $this->uploadImage($request->file('image_couverture'), 'voyage_couverture', 370, 150);
        }

        if($request->file('image_principale')) {
            if(file_exists(public_path($voyage->image_principale))) {
                unlink(public_path($voyage->image_principale));
            }
            $voyage->image_principale = $this->uploadImage($request->file('image_principale'), 'voyage_principale', 1362, 900);
        }

        $voyage->save();

        // Traitement des nouvelles images de galerie
        if($request->hasFile('galerie_images')){
            $this->handleGalerieImages($request->file('galerie_images'), $voyage->id);
        }

        $notification = array(
            'message' => 'Voyage mis à jour avec succès',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    // Supprimer un voyage
    public function DeleteVoyage($id) {
        $voyage = Voyage::findOrFail($id);
        
        // Supprimer les images
        if(file_exists(public_path($voyage->image_couverture))) {
            unlink(public_path($voyage->image_couverture));
        }
        if(file_exists(public_path($voyage->image_principale))) {
            unlink(public_path($voyage->image_principale));
        }

        // Supprimer les images de galerie
        foreach($voyage->galeries as $galerie) {
            if(file_exists(public_path($galerie->chemin_image))) {
                unlink(public_path($galerie->chemin_image));
            }
        }
        
        $voyage->delete(); // Les relations seront supprimées en cascade
        
        $notification = array(
            'message' => 'Voyage supprimé avec succès',
            'alert-type' => 'success'
        );
        
        return redirect()->back()->with($notification);
    }

    // ============= MÉTHODES POUR LES ÉTAPES =============

    // Récupérer les étapes d'un voyage (AJAX)
    public function getVoyageEtapes($voyage_id){
        $etapes = Etape::where('voyage_id', $voyage_id)
                      ->orderBy('numero_jour')
                      ->get();
        return response()->json($etapes);
    }

    // Ajouter une étape à un voyage
    public function AddEtapeToVoyage(Request $request, $voyage_id){
        $request->validate([
            'titre_etape' => 'required|string|max:255',
            'description_etape' => 'required|string',
        ]);

        $dernierNumero = Etape::where('voyage_id', $voyage_id)->max('numero_jour') ?? 0;

        $etape = Etape::create([
            'voyage_id' => $voyage_id,
            'numero_jour' => $dernierNumero + 1,
            'titre_etape' => $request->titre_etape,
            'description_etape' => $request->description_etape,
            'lieu_depart' => $request->lieu_depart,
            'lieu_arrivee' => $request->lieu_arrivee,
            'heure_debut' => $request->heure_debut,
            'heure_fin' => $request->heure_fin,
            'activites_jour' => $request->activites_jour ? json_encode($request->activites_jour) : null,
            'hebergement_etape' => $request->hebergement_etape,
            'notes_speciales' => $request->notes_speciales,
        ]);

        return response()->json([
            'success' => true, 
            'message' => 'Étape ajoutée avec succès',
            'etape' => $etape
        ]);
    }

    // Mettre à jour une étape
    public function UpdateEtape(Request $request, $etape_id){
        $etape = Etape::findOrFail($etape_id);
        
        $etape->update([
            'titre_etape' => $request->titre_etape,
            'description_etape' => $request->description_etape,
            'lieu_depart' => $request->lieu_depart,
            'lieu_arrivee' => $request->lieu_arrivee,
            'heure_debut' => $request->heure_debut,
            'heure_fin' => $request->heure_fin,
            'activites_jour' => $request->activites_jour ? json_encode($request->activites_jour) : null,
            'hebergement_etape' => $request->hebergement_etape,
            'notes_speciales' => $request->notes_speciales,
        ]);

        return response()->json([
            'success' => true, 
            'message' => 'Étape mise à jour avec succès'
        ]);
    }

    // NOUVELLE : Récupérer une étape pour édition
    public function getEtapeForEdit($etape_id){
        $etape = Etape::findOrFail($etape_id);
        return response()->json($etape);
    }

    // Supprimer une étape
    public function DeleteEtape($etape_id){
        Etape::findOrFail($etape_id)->delete();
        
        return response()->json([
            'success' => true, 
            'message' => 'Étape supprimée avec succès'
        ]);
    }

    // ============= MÉTHODES POUR LES ACTIVITÉS =============

    // Récupérer les activités d'un voyage (AJAX)
    public function getVoyageActivites($voyage_id){
        $activites = Activite::where('voyage_id', $voyage_id)->get();
        return response()->json($activites);
    }

    // Ajouter une activité à un voyage
    public function AddActiviteToVoyage(Request $request, $voyage_id){
        $request->validate([
            'nom_activite' => 'required|string|max:255',
            'description_activite' => 'required|string',
            'type_activite' => 'required|in:incluse,optionnelle',
            'lieu_activite' => 'required|string',
        ]);

        $activite = Activite::create([
            'voyage_id' => $voyage_id,
            'nom_activite' => $request->nom_activite,
            'description_activite' => $request->description_activite,
            'prix_activite' => $request->prix_activite ?? 0,
            'type_activite' => $request->type_activite,
            'duree_heures' => $request->duree_heures,
            'lieu_activite' => $request->lieu_activite,
            'equipements_requis' => $request->equipements_requis ? json_encode($request->equipements_requis) : null,
            'jour_recommande' => $request->jour_recommande,
        ]);

        return response()->json([
            'success' => true, 
            'message' => 'Activité ajoutée avec succès',
            'activite' => $activite
        ]);
    }

    // Mettre à jour une activité
    public function UpdateActivite(Request $request, $activite_id){
        $activite = Activite::findOrFail($activite_id);
        
        $activite->update([
            'nom_activite' => $request->nom_activite,
            'description_activite' => $request->description_activite,
            'prix_activite' => $request->prix_activite ?? 0,
            'type_activite' => $request->type_activite,
            'duree_heures' => $request->duree_heures,
            'lieu_activite' => $request->lieu_activite,
            'equipements_requis' => $request->equipements_requis ? json_encode($request->equipements_requis) : null,
            'jour_recommande' => $request->jour_recommande,
        ]);

        return response()->json([
            'success' => true, 
            'message' => 'Activité mise à jour avec succès'
        ]);
    }

    // NOUVELLE : Récupérer une activité pour édition
    public function getActiviteForEdit($activite_id){
        $activite = Activite::findOrFail($activite_id);
        return response()->json($activite);
    }

    // Supprimer une activité
    public function DeleteActivite($activite_id){
        Activite::findOrFail($activite_id)->delete();
        
        return response()->json([
            'success' => true, 
            'message' => 'Activité supprimée avec succès'
        ]);
    }

    // ============= MÉTHODES POUR LES GALERIES =============

    // Ajouter des images à la galerie
    public function AddImageToGalerie(Request $request, $voyage_id){
        $request->validate([
            'images.*' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if($request->hasFile('images')){
            $this->handleGalerieImages($request->file('images'), $voyage_id);
        }

        return response()->json([
            'success' => true, 
            'message' => 'Images ajoutées à la galerie avec succès'
        ]);
    }

    // Supprimer une image de galerie
    public function DeleteImageGalerie($galerie_id){
        $galerie = Galerie::findOrFail($galerie_id);
        
        if(file_exists(public_path($galerie->chemin_image))) {
            unlink(public_path($galerie->chemin_image));
        }
        
        $galerie->delete();
        
        return response()->json([
            'success' => true, 
            'message' => 'Image supprimée avec succès'
        ]);
    }

    // ============= MÉTHODES UTILITAIRES =============

    private function uploadImage($image, $folder, $width, $height) {
        if (!file_exists(public_path("upload/$folder"))) {
            mkdir(public_path("upload/$folder"), 0777, true);
        }

        $manager = new ImageManager(new Driver());
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        $img = $manager->read($image);
        $img = $img->resize($width, $height);
        $img->toJpeg(80)->save(base_path("public/upload/$folder/$name_gen"));
        
        return "upload/$folder/$name_gen";
    }

    private function handleGalerieImages($images, $voyage_id) {
        if (!file_exists(public_path('upload/voyage_galerie'))) {
            mkdir(public_path('upload/voyage_galerie'), 0777, true);
        }

        foreach ($images as $image) {
            $imgName = date('YmdHi').$image->getClientOriginalName();
            $image->move(public_path('upload/voyage_galerie/'), $imgName);
            
            Galerie::create([
                'voyage_id' => $voyage_id,
                'chemin_image' => 'upload/voyage_galerie/' . $imgName,
                'type_image' => 'galerie',
                'ordre_affichage' => 0,
            ]);
        }
    }

    // Dupliquer un voyage
    public function DuplicateVoyage($id) {
        $original = Voyage::with(['etapes', 'activites', 'galeries'])->findOrFail($id);
        
        // Créer une copie du voyage
        $nouveauVoyage = $original->replicate();
        $nouveauVoyage->nom_voyage = $original->nom_voyage . ' (Copie)';
        $nouveauVoyage->statut = 'brouillon';
        $nouveauVoyage->save();
        
        // Dupliquer les étapes
        foreach($original->etapes as $etape) {
            $nouvelleEtape = $etape->replicate();
            $nouvelleEtape->voyage_id = $nouveauVoyage->id;
            $nouvelleEtape->save();
        }
        
        // Dupliquer les activités
        foreach($original->activites as $activite) {
            $nouvelleActivite = $activite->replicate();
            $nouvelleActivite->voyage_id = $nouveauVoyage->id;
            $nouvelleActivite->save();
        }
        
        // Dupliquer les images de galerie
        foreach($original->galeries as $galerie) {
            $nouvelleGalerie = $galerie->replicate();
            $nouvelleGalerie->voyage_id = $nouveauVoyage->id;
            $nouvelleGalerie->save();
        }
        
        return response()->json([
            'success' => true, 
            'message' => 'Voyage dupliqué avec succès',
            'nouveau_id' => $nouveauVoyage->id
        ]);
    }

    // ============= MÉTHODES FRONTEND CORRIGÉES =============

    // Affichage public des voyages avec filtres
    public function PublicVoyages(Request $request) {
        // Test ultra-simple d'abord - bypass database
        return response('<h1>TESTE SIMPLE - Contrôleur fonctionne!</h1>');
        
        $query = Voyage::where('statut', 'publie')
                      ->with(['etapes', 'activites', 'galerieGenerale']);

        // Suppression des whereHas pour éviter les erreurs si pas encore de données
        // ->whereHas('etapes') // S'assurer qu'il y a des étapes
        // ->whereHas('activites'); // S'assurer qu'il y a des activités

        // Filtres
        if ($request->type_voyage) {
            $query->where('type_voyage', $request->type_voyage);
        }
        
        if ($request->region) {
            $query->where('region', $request->region);
        }
        
        if ($request->duree) {
            if ($request->duree === 'court') {
                $query->where('duree_jours', '<=', 3);
            } elseif ($request->duree === 'moyen') {
                $query->whereBetween('duree_jours', [4, 7]);
            } elseif ($request->duree === 'long') {
                $query->where('duree_jours', '>', 7);
            }
        }
        
        if ($request->prix) {
            if ($request->prix === 'economique') {
                $query->where('prix_base', '<', 200000);
            } elseif ($request->prix === 'moyen') {
                $query->whereBetween('prix_base', [200000, 500000]);
            } elseif ($request->prix === 'premium') {
                $query->where('prix_base', '>', 500000);
            }
        }
        
        if ($request->niveau_confort) {
            $query->where('niveau_confort', $request->niveau_confort);
        }

        $voyages = $query->latest()->paginate(12);
        
        // Types de voyages pour les filtres
        $typesVoyage = Voyage::select('type_voyage')
                            ->where('statut', 'publie')
                            ->distinct()
                            ->get();
        $regions = Voyage::select('region')
                        ->where('statut', 'publie')
                        ->distinct()
                        ->get();
        
        // Test avec vue simplifiée pour debug
        if (request()->has('debug')) {
            return view('frontend.voyages.index-simple', compact('voyages', 'typesVoyage', 'regions'));
        }
        
        // Test avec vue ultra-simple
        if (request()->has('test')) {
            return view('frontend.voyages.index-test', compact('voyages', 'typesVoyage', 'regions'));
        }
        
        // Test direct sans vue pour vérifier si le contrôleur fonctionne
        if (request()->has('raw')) {
            return response('<h1>Test Raw - Controller fonctionne!</h1><p>Nombre voyages: ' . $voyages->count() . '</p>');
        }
        
        // Test avec page standalone (sans layout)
        if (request()->has('standalone')) {
            return view('frontend.voyages.standalone', compact('voyages', 'typesVoyage', 'regions'));
        }
        
        // Temporaire: utiliser la version backup pour tester
        return view('frontend.voyages.index-backup', compact('voyages', 'typesVoyage', 'regions'));
    }

    // Détail d'un voyage avec consultation progressive
    public function VoyageDetail($id) {
        $voyage = Voyage::with(['etapes', 'activites', 'galeries'])
                        ->where('id', $id)
                        ->where('statut', 'publie')
                        ->firstOrFail();
        
        // Suivre la consultation si utilisateur connecté
        if (auth()->check()) {
            $this->trackUserConsultation($id, 'detail');
        }
        
        return view('frontend.voyages.detail', compact('voyage'));
    }

    // ✅ Programme avec limitation pour non-connectés (CORRIGÉ)
    public function VoyageProgramme($id) {
        // D'abord récupérer le voyage pour compter toutes les étapes
        $voyage = Voyage::where('id', $id)
                       ->where('statut', 'publie')
                       ->firstOrFail();
        
        // Compter le nombre total d'étapes
        $totalEtapes = Etape::where('voyage_id', $id)->count();
        
        // Déterminer si l'authentification est nécessaire
        $needsAuth = !auth()->check() && $totalEtapes > 3;
        
        // Charger le voyage avec les étapes (limitées si non connecté)
        $voyage = Voyage::with(['etapes' => function($query) {
                    if (!auth()->check()) {
                        $query->orderBy('numero_jour')->limit(3);
                    } else {
                        $query->orderBy('numero_jour');
                    }
                }])
                ->where('id', $id)
                ->where('statut', 'publie')
                ->firstOrFail();
        
        // Ajouter le nombre total d'étapes au voyage
        $voyage->total_etapes = $totalEtapes;
        
        return view('frontend.voyages.programme', compact('voyage', 'needsAuth'));
    }

    // Programme complet (nécessite connexion)
    public function VoyageProgrammeComplet($id) {
        $voyage = Voyage::with(['etapes' => function($query) {
                    $query->orderBy('numero_jour');
                }])
                ->where('id', $id)
                ->where('statut', 'publie')
                ->firstOrFail();
        
        $this->trackUserConsultation($id, 'programme_complet');
        
        return view('frontend.voyages.programme-complet', compact('voyage'));
    }

    // Galerie du voyage
    public function VoyageGalerie($id) {
        $voyage = Voyage::with(['galeries' => function($query) {
                    $query->orderBy('ordre_affichage');
                }])
                ->where('id', $id)
                ->where('statut', 'publie')
                ->firstOrFail();
        
        return view('frontend.voyages.galerie', compact('voyage'));
    }

    // Page de réservation
    public function VoyageReservation($id) {
        $voyage = Voyage::with(['etapes' => function($query) {
                    $query->orderBy('numero_jour');
                }, 'activites'])
                ->where('id', $id)
                ->where('statut', 'publie')
                ->firstOrFail();
        
        return view('frontend.voyages.reservation', compact('voyage'));
    }

    // AJAX - Détail d'une étape avec vérification
    public function getEtapeDetail($voyage_id, $numero) {
        try {
            $voyage = Voyage::findOrFail($voyage_id);
            
            // Si étape > 3 et utilisateur non connecté, demander connexion
            if ($numero > 3 && !auth()->check()) {
                return response()->json([
                    'success' => false,
                    'needsAuth' => true,
                    'message' => 'Connectez-vous pour voir le programme complet'
                ]);
            }
            
            $etape = Etape::where('voyage_id', $voyage_id)
                         ->where('numero_jour', $numero)
                         ->first();
                         
            if (!$etape) {
                return response()->json([
                    'success' => false,
                    'message' => 'Étape non trouvée'
                ], 404);
            }
            
            return response()->json([
                'success' => true,
                'etape' => $etape
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la récupération de l\'étape'
            ], 500);
        }
    }

    // Tracker la consultation utilisateur
    public function trackConsultation(Request $request, $id) {
        if (auth()->check()) {
            $this->trackUserConsultation($id, $request->type ?? 'general');
        }
        
        return response()->json(['success' => true]);
    }

    // ✅ Méthode privée pour tracker les consultations (CORRIGÉE)
    private function trackUserConsultation($voyage_id, $type) {
        if (!auth()->check()) {
            return;
        }

        $user_id = auth()->id();
        
        // Stockage en session (temporaire)
        $consultations = session("consultations.{$voyage_id}", []);
        $consultations[] = [
            'type' => $type,
            'timestamp' => now()->toISOString(),
            'user_id' => $user_id
        ];
        session(["consultations.{$voyage_id}" => $consultations]);
        
        // TODO: Implémenter le stockage en base de données
        // \DB::table('voyage_consultations')->updateOrInsert(
        //     ['user_id' => $user_id, 'voyage_id' => $voyage_id, 'type' => $type],
        //     ['updated_at' => now(), 'created_at' => now()]
        // );
        
        // ✅ Logger corrigé avec la façade Log
        Log::info("Consultation voyage", [
            'user_id' => $user_id,
            'voyage_id' => $voyage_id,
            'type' => $type,
            'timestamp' => now()
        ]);
    }

    // ✅ NOUVELLE MÉTHODE : Obtenir le statut de consultation
    public function getConsultationStatus($voyage_id) {
        if (!auth()->check()) {
            return response()->json([
                'authenticated' => false,
                'etapes_accessibles' => 3
            ]);
        }
        
        $totalEtapes = Etape::where('voyage_id', $voyage_id)->count();
        
        return response()->json([
            'authenticated' => true,
            'etapes_accessibles' => $totalEtapes,
            'total_etapes' => $totalEtapes
        ]);
    }

    // ✅ NOUVELLE MÉTHODE : Vérification d'accès aux étapes
    private function canAccessEtape($voyage_id, $numero_etape) {
        // Si connecté, accès à tout
        if (auth()->check()) {
            return true;
        }
        
        // Si non connecté, accès limité aux 3 premières étapes
        return $numero_etape <= 3;
    }

    // ✅ NOUVELLE MÉTHODE : FormulaireVoyage (pour compatibilité avec vos routes existantes)
    public function FormulaireVoyage() {
        // Rediriger vers la nouvelle page d'index des voyages
        return redirect()->route('voyages.index');
    }
}