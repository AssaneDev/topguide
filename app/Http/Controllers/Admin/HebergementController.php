<?php
// app/Http/Controllers/Admin/HebergementController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hebergement;
use App\Models\HebergementCommentaire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log; 

class HebergementController extends Controller
{
    public function index()
    {
        $hebergements = Hebergement::with('commentaires')
            ->withCount('commentairesApprouves')
            ->orderBy('ordre_affichage')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        $stats = [
            'total' => Hebergement::count(),
            'actifs' => Hebergement::where('statut', 'actif')->count(),
            'featured' => Hebergement::where('featured', true)->count(),
            'commentaires_en_attente' => HebergementCommentaire::where('statut', 'en_attente')->count(),
        ];

        return view('admin.hebergements.index', compact('hebergements', 'stats'));
    }

    public function create()
    {
        $regions = $this->getRegionsSenegal();
        $amenities = Hebergement::getAmenitiesDisponibles();
        $badges = Hebergement::getBadgesDisponibles();

        return view('admin.hebergements.create', compact('regions', 'amenities', 'badges'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'nom' => 'required|string|max:255',
                'description' => 'required|string',
                'adresse' => 'required|string',
                'region' => 'required|string',
                'departement' => 'required|string',
                'tarif_min' => 'nullable|numeric|min:0',
                'tarif_max' => 'nullable|numeric|min:0|gte:tarif_min',
                'site_web' => 'nullable|url',
                'telephone' => 'nullable|string',
                'email' => 'nullable|email',
                'note_admin' => 'nullable|integer|between:1,5',
                'images.*' => 'image|mimes:jpeg,png,jpg,webp|max:2048',
            ]);

            $hebergement = new Hebergement($request->except(['images', 'amenities', 'badges']));
            
            // Gestion des amenities et badges
            $hebergement->amenities = $request->input('amenities', []);
            $hebergement->badges = $request->input('badges', []);
            
            // Le slug sera généré automatiquement par le model
            
            // Géolocalisation automatique si pas fournie
            if (!$request->latitude && !$request->longitude) {
                $coordinates = $this->geocodeAddress($request->adresse . ', ' . $request->region . ', Sénégal');
                $hebergement->latitude = $coordinates['lat'] ?? null;
                $hebergement->longitude = $coordinates['lng'] ?? null;
            }

            $hebergement->save();

            // Gestion des images
            if ($request->hasFile('images')) {
                $images = $this->uploadImages($request->file('images'));
                $hebergement->update(['images' => $images]);
            }

            $notification = [
                'message' => 'Hébergement créé avec succès!',
                'alert-type' => 'success'
            ];

            return redirect()->route('admin.hebergements.index')->with($notification);
            
        } catch (\Exception $e) {
            $notification = [
                'message' => 'Erreur lors de la création: ' . $e->getMessage(),
                'alert-type' => 'error'
            ];

            return back()->withInput()->with($notification);
        }
    }

    public function show(Hebergement $hebergement)
    {
        $hebergement->load(['commentaires' => function($query) {
            $query->orderBy('created_at', 'desc');
        }]);

        $statistiques = [
            'note_moyenne' => $hebergement->note_client_moyenne,
            'total_commentaires' => $hebergement->nombre_commentaires,
            'vues_total' => $hebergement->vues,
            'derniere_vue' => $hebergement->updated_at,
        ];

        return view('admin.hebergements.show', compact('hebergement', 'statistiques'));
    }

    public function edit(Hebergement $hebergement)
    {
        $regions = $this->getRegionsSenegal();
        $amenities = Hebergement::getAmenitiesDisponibles();
        $badges = Hebergement::getBadgesDisponibles();

        return view('admin.hebergements.edit', compact('hebergement', 'regions', 'amenities', 'badges'));
    }

    public function update(Request $request, Hebergement $hebergement)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'required|string',
            'adresse' => 'required|string',
            'region' => 'required|string',
            'departement' => 'required|string',
            'tarif_min' => 'nullable|numeric|min:0',
            'tarif_max' => 'nullable|numeric|min:0|gte:tarif_min',
            'site_web' => 'nullable|url',
            'telephone' => 'nullable|string',
            'email' => 'nullable|email',
            'note_admin' => 'nullable|integer|between:1,5',
            'images.*' => 'image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $hebergement->fill($request->except(['images', 'amenities', 'badges']));
        $hebergement->amenities = $request->input('amenities', []);
        $hebergement->badges = $request->input('badges', []);

        // Mise à jour géolocalisation si adresse changée
        if ($hebergement->isDirty('adresse') || $hebergement->isDirty('region')) {
            $coordinates = $this->geocodeAddress($request->adresse . ', ' . $request->region . ', Sénégal');
            $hebergement->latitude = $coordinates['lat'] ?? $hebergement->latitude;
            $hebergement->longitude = $coordinates['lng'] ?? $hebergement->longitude;
        }

        $hebergement->save();

        // Gestion nouvelles images
        if ($request->hasFile('images')) {
            $newImages = $this->uploadImages($request->file('images'));
            $existingImages = $hebergement->images ?? [];
            $hebergement->update(['images' => array_merge($existingImages, $newImages)]);
        }

        $notification = [
            'message' => 'Hébergement mis à jour avec succès!',
            'alert-type' => 'success'
        ];

        return redirect()->route('admin.hebergements.index')->with($notification);
    }

    public function destroy(Hebergement $hebergement)
    {
        // Supprimer les images du dossier public/upload/hebergement
        if ($hebergement->images) {
            foreach ($hebergement->images as $image) {
                $imagePath = public_path($image);
                if (File::exists($imagePath)) {
                    File::delete($imagePath);
                }
            }
        }

        $hebergement->delete();

        $notification = [
            'message' => 'Hébergement supprimé avec succès!',
            'alert-type' => 'success'
        ];

        return redirect()->route('admin.hebergements.index')->with($notification);
    }

    public function toggleFeatured(Hebergement $hebergement)
    {
        $hebergement->update(['featured' => !$hebergement->featured]);

        return response()->json([
            'success' => true,
            'featured' => $hebergement->featured,
            'message' => $hebergement->featured ? 'Hébergement mis en avant' : 'Hébergement retiré de la mise en avant'
        ]);
    }

    public function updateOrdre(Request $request)
    {
        foreach ($request->ordres as $id => $ordre) {
            Hebergement::where('id', $id)->update(['ordre_affichage' => $ordre]);
        }

        return response()->json(['success' => true]);
    }

    public function deleteImage(Request $request, Hebergement $hebergement)
    {
        $imageIndex = $request->image_index;
        $images = $hebergement->images ?? [];

        if (isset($images[$imageIndex])) {
            // Supprimer le fichier physique
            $imagePath = public_path($images[$imageIndex]);
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
            
            // Retirer l'image du tableau
            unset($images[$imageIndex]);
            $hebergement->update(['images' => array_values($images)]);
        }

        return response()->json(['success' => true]);
    }

    // Gestion des commentaires
    public function commentaires()
    {
        $commentaires = HebergementCommentaire::with('hebergement')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        $stats = [
            'en_attente' => HebergementCommentaire::where('statut', 'en_attente')->count(),
            'approuves' => HebergementCommentaire::where('statut', 'approuve')->count(),
            'rejetes' => HebergementCommentaire::where('statut', 'rejete')->count(),
        ];

        return view('admin.hebergements.commentaires', compact('commentaires', 'stats'));
    }

    public function approuverCommentaire(HebergementCommentaire $commentaire)
    {
        $commentaire->approuver();

        return response()->json([
            'success' => true,
            'message' => 'Commentaire approuvé'
        ]);
    }

    public function rejeterCommentaire(HebergementCommentaire $commentaire)
    {
        $commentaire->rejeter();

        return response()->json([
            'success' => true,
            'message' => 'Commentaire rejeté'
        ]);
    }

    // Méthodes utilitaires privées
    private function uploadImages($files)
    {
        $uploadedImages = [];
        
        foreach ($files as $file) {
            // Générer un nom unique pour le fichier
            $imageName = date('YmdHis') . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            
            // Chemin de destination dans votre dossier existant
            $destinationPath = public_path('upload/hebergement');
            
            // Créer le dossier s'il n'existe pas
            if (!File::exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0755, true);
            }
            
            // Déplacer le fichier vers le dossier public/upload/hebergement
            $file->move($destinationPath, $imageName);
            
            // Stocker le chemin relatif pour la base de données
            $uploadedImages[] = 'upload/hebergement/' . $imageName;
        }
        
        return $uploadedImages;
    }

 private function geocodeAddress($address)
    {
        // Vérifier la clé API
        $apiKey = env('GOOGLE_MAPS_API_KEY');
        
        if (empty($apiKey)) {
            Log::warning('GOOGLE_MAPS_API_KEY non configurée');
            // Fallback vers coordonnées par défaut pour Dakar
            return [
                'lat' => 14.6928,
                'lng' => -17.4467
            ];
        }
        
        $address = urlencode($address);
        $url = "https://maps.googleapis.com/maps/api/geocode/json?address={$address}&region=SN&key={$apiKey}";
        
        try {
            // Utiliser cURL pour de meilleures options
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_TIMEOUT, 10);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            
            $response = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);
            
            if ($httpCode !== 200) {
                Log::error("Erreur HTTP lors du géocodage: {$httpCode}");
                throw new \Exception("Erreur HTTP: {$httpCode}");
            }
            
            $data = json_decode($response, true);
            
            if ($data['status'] === 'OK' && !empty($data['results'])) {
                $location = $data['results'][0]['geometry']['location'];
                Log::info("Géocodage réussi pour: {$address}", $location);
                
                return [
                    'lat' => $location['lat'],
                    'lng' => $location['lng'],
                    'formatted_address' => $data['results'][0]['formatted_address'] ?? null
                ];
            } else {
                Log::warning("Géocodage échoué: {$data['status']} pour adresse: {$address}");
            }
        } catch (\Exception $e) {
            Log::error('Erreur géocodage Google Maps: ' . $e->getMessage());
        }
        
        // Fallback pour le Sénégal
        return [
            'lat' => 14.6928,
            'lng' => -17.4467
        ];
    }


    private function getRegionsSenegal()
    {
        return [
            'Dakar' => 'Dakar',
            'Thiès' => 'Thiès', 
            'Saint-Louis' => 'Saint-Louis',
            'Diourbel' => 'Diourbel',
            'Louga' => 'Louga',
            'Fatick' => 'Fatick',
            'Kaolack' => 'Kaolack',
            'Kaffrine' => 'Kaffrine',
            'Tambacounda' => 'Tambacounda',
            'Kédougou' => 'Kédougou',
            'Kolda' => 'Kolda',
            'Ziguinchor' => 'Ziguinchor',
            'Sédhiou' => 'Sédhiou',
            'Matam' => 'Matam'
        ];
    }

    public function export()
    {
        // Export Excel/CSV des hébergements
        // À implémenter avec Laravel Excel
    }

    public function statistiques()
    {
        $stats = [
            'hebergements_par_region' => Hebergement::selectRaw('region, COUNT(*) as count')
                ->groupBy('region')
                ->pluck('count', 'region'),
            'moyenne_tarifs' => Hebergement::avg('tarif_min'),
            'amenities_populaires' => $this->getAmenitiesStats(),
            'evolution_mensuelle' => $this->getEvolutionMensuelle(),
        ];

        return view('admin.hebergements.statistiques', compact('stats'));
    }

    private function getAmenitiesStats()
    {
        // Analyse des amenities les plus populaires
        $hebergements = Hebergement::whereNotNull('amenities')->get();
        $amenitiesCount = [];
        
        foreach ($hebergements as $hebergement) {
            foreach ($hebergement->amenities ?? [] as $amenity) {
                $amenitiesCount[$amenity] = ($amenitiesCount[$amenity] ?? 0) + 1;
            }
        }
        
        arsort($amenitiesCount);
        return $amenitiesCount;
    }

    private function getEvolutionMensuelle()
    {
        return Hebergement::selectRaw('MONTH(created_at) as month, YEAR(created_at) as year, COUNT(*) as count')
            ->whereYear('created_at', now()->year)
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get();
    }
}