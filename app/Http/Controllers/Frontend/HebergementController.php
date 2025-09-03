<?php
// app/Http/Controllers/Frontend/HebergementController.php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Hebergement;
use App\Models\HebergementCommentaire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HebergementController extends Controller
{
    public function index(Request $request)
    {
        $query = Hebergement::actif()->with(['commentairesApprouves']);
        
        // Filtres
        if ($request->region) {
            $query->where('region', $request->region);
        }
        
        if ($request->departement) {
            $query->where('departement', $request->departement);
        }
        
        if ($request->tarif_min) {
            $query->where('tarif_min', '>=', $request->tarif_min);
        }
        
        if ($request->tarif_max) {
            $query->where('tarif_max', '<=', $request->tarif_max);
        }
        
        if ($request->amenities) {
            foreach ($request->amenities as $amenity) {
                $query->whereJsonContains('amenities', $amenity);
            }
        }
        
        if ($request->badges) {
            foreach ($request->badges as $badge) {
                $query->whereJsonContains('badges', $badge);
            }
        }
        
        // Recherche textuelle
        if ($request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nom', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('lieu_touristique', 'like', "%{$search}%")
                  ->orWhere('adresse', 'like', "%{$search}%");
            });
        }
        
        // Tri
        switch ($request->sort) {
            case 'nom':
                $query->orderBy('nom');
                break;
            case 'tarif_asc':
                $query->orderBy('tarif_min');
                break;
            case 'tarif_desc':
                $query->orderByDesc('tarif_min');
                break;
            case 'note':
                $query->withAvg('commentairesApprouves', 'note_client')
                      ->orderByDesc('commentaires_approuves_avg_note_client');
                break;
            case 'populaire':
                $query->orderByDesc('vues');
                break;
            default:
                $query->orderByDesc('featured')->orderBy('ordre_affichage');
        }
        
        $hebergements = $query->paginate(12);
        
        // Données pour les filtres
        $regions = Hebergement::getRegions();
        $departements = Hebergement::getDepartements();
        $amenities = Hebergement::getAmenitiesDisponibles();
        $badges = Hebergement::getBadgesDisponibles();
        
        // Statistiques
        $stats = [
            'total' => Hebergement::actif()->count(),
            'tarif_moyen' => Hebergement::actif()->avg('tarif_min'),
            'regions_count' => $regions->count(),
        ];
        
        return view('frontend.hebergements.index', compact(
            'hebergements', 'regions', 'departements', 'amenities', 'badges', 'stats'
        ));
    }

    public function show(Hebergement $hebergement)
    {
        // Vérifier que l'hébergement est actif
        if ($hebergement->statut !== 'actif') {
            abort(404);
        }
        
        // Incrémenter les vues
        $hebergement->incrementVues();
        
        // Charger les commentaires approuvés
        $hebergement->load(['commentairesApprouves' => function($query) {
            $query->orderBy('created_at', 'desc');
        }]);
        
        // Hébergements similaires (même région, différent hébergement)
        $hebergementsSimilaires = Hebergement::actif()
            ->where('region', $hebergement->region)
            ->where('id', '!=', $hebergement->id)
            ->featured()
            ->limit(4)
            ->get();
        
        // Statistiques des notes
        $statistiquesNotes = [
            5 => $hebergement->commentairesApprouves()->where('note_client', 5)->count(),
            4 => $hebergement->commentairesApprouves()->where('note_client', 4)->count(),
            3 => $hebergement->commentairesApprouves()->where('note_client', 3)->count(),
            2 => $hebergement->commentairesApprouves()->where('note_client', 2)->count(),
            1 => $hebergement->commentairesApprouves()->where('note_client', 1)->count(),
        ];
        
        $totalCommentaires = array_sum($statistiquesNotes);
        
        return view('frontend.hebergements.show', compact(
            'hebergement', 'hebergementsSimilaires', 'statistiquesNotes', 'totalCommentaires'
        ));
    }

    public function parRegion($region)
    {
        $hebergements = Hebergement::actif()
            ->where('region', $region)
            ->orderByDesc('featured')
            ->orderBy('ordre_affichage')
            ->paginate(12);
        
        return view('frontend.hebergements.region', compact('hebergements', 'region'));
    }

    public function search(Request $request)
    {
        $query = $request->get('q');
        
        if (!$query) {
            return redirect()->route('hebergements.index');
        }
        
        $hebergements = Hebergement::actif()
            ->where(function($q) use ($query) {
                $q->where('nom', 'like', "%{$query}%")
                  ->orWhere('description', 'like', "%{$query}%")
                  ->orWhere('lieu_touristique', 'like', "%{$query}%")
                  ->orWhere('region', 'like', "%{$query}%")
                  ->orWhere('departement', 'like', "%{$query}%");
            })
            ->orderByDesc('featured')
            ->paginate(12);
        
        return view('frontend.hebergements.search', compact('hebergements', 'query'));
    }

    public function ajouterCommentaire(Request $request, Hebergement $hebergement)
    {
        $request->validate([
            'nom_client' => 'required|string|max:255',
            'email_client' => 'required|email|max:255',
            'commentaire' => 'required|string|min:10|max:1000',
            'note_client' => 'required|integer|between:1,5',
        ], [
            'nom_client.required' => 'Le nom est obligatoire',
            'email_client.required' => 'L\'email est obligatoire',
            'email_client.email' => 'Format d\'email invalide',
            'commentaire.required' => 'Le commentaire est obligatoire',
            'commentaire.min' => 'Le commentaire doit faire au moins 10 caractères',
            'commentaire.max' => 'Le commentaire ne peut pas dépasser 1000 caractères',
            'note_client.required' => 'La note est obligatoire',
            'note_client.between' => 'La note doit être comprise entre 1 et 5',
        ]);

        // Vérifier si l'email n'a pas déjà commenté cet hébergement
        $existingComment = HebergementCommentaire::where('hebergement_id', $hebergement->id)
            ->where('email_client', $request->email_client)
            ->first();

        if ($existingComment) {
            return back()->with([
                'message' => 'Vous avez déjà laissé un commentaire pour cet hébergement.',
                'alert-type' => 'warning'
            ]);
        }

        HebergementCommentaire::create([
            'hebergement_id' => $hebergement->id,
            'nom_client' => $request->nom_client,
            'email_client' => $request->email_client,
            'commentaire' => $request->commentaire,
            'note_client' => $request->note_client,
            'ip_client' => $request->ip(),
            'statut' => 'en_attente', // Modération par défaut
        ]);

        return back()->with([
            'message' => 'Merci pour votre commentaire ! Il sera publié après modération.',
            'alert-type' => 'success'
        ]);
    }

    public function toggleFavori(Hebergement $hebergement)
    {
        // Cette fonctionnalité nécessitera une table user_favoris
        // Pour l'instant, on peut utiliser la session
        
        $favoris = session()->get('favoris_hebergements', []);
        
        if (in_array($hebergement->id, $favoris)) {
            $favoris = array_diff($favoris, [$hebergement->id]);
            $message = 'Retiré des favoris';
            $action = 'removed';
        } else {
            $favoris[] = $hebergement->id;
            $message = 'Ajouté aux favoris';
            $action = 'added';
        }
        
        session(['favoris_hebergements' => $favoris]);
        
        return response()->json([
            'success' => true,
            'message' => $message,
            'action' => $action,
            'count' => count($favoris)
        ]);
    }

    public function comparateur(Request $request)
    {
        $ids = $request->get('hebergements', []);
        
        if (empty($ids) || count($ids) < 2) {
            return redirect()->route('hebergements.index')->with([
                'message' => 'Sélectionnez au moins 2 hébergements à comparer.',
                'alert-type' => 'warning'
            ]);
        }
        
        if (count($ids) > 4) {
            return redirect()->route('hebergements.index')->with([
                'message' => 'Vous ne pouvez comparer que 4 hébergements maximum.',
                'alert-type' => 'warning'
            ]);
        }
        
        $hebergements = Hebergement::actif()
            ->whereIn('id', $ids)
            ->with('commentairesApprouves')
            ->get();
        
        return view('frontend.hebergements.comparateur', compact('hebergements'));
    }

    // API pour la carte interactive
    public function apiCarte()
    {
        $hebergements = Hebergement::actif()
            ->whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->select(['id', 'nom', 'slug', 'latitude', 'longitude', 'tarif_min', 'tarif_max', 'images', 'lieu_touristique', 'departement', 'region'])
            ->get();
        
        $markers = $hebergements->map(function($hebergement) {
            return [
                'id' => $hebergement->id,
                'nom' => $hebergement->nom,
                'lat' => (float) $hebergement->latitude,
                'lng' => (float) $hebergement->longitude,
                'tarif' => $hebergement->tarif_format,
                'image' => asset($hebergement->image_principale),
                'url' => route('hebergements.show', $hebergement),
                'location' => $hebergement->lieu_touristique ?? $hebergement->departement . ', ' . $hebergement->region,
                'featured' => $hebergement->featured,
            ];
        });
        
        return response()->json($markers);
    }

    // API pour filtres dynamiques
    public function apiFiltres(Request $request)
    {
        $query = Hebergement::actif();
        
        // Appliquer les filtres existants
        if ($request->region) {
            $query->where('region', $request->region);
        }
        
        // Retourner les options disponibles pour les autres filtres
        $departements = (clone $query)->distinct()->pluck('departement');
        $tarifsRange = (clone $query)->selectRaw('MIN(tarif_min) as min, MAX(tarif_max) as max')->first();
        
        return response()->json([
            'departements' => $departements,
            'tarifs' => [
                'min' => $tarifsRange->min ?? 0,
                'max' => $tarifsRange->max ?? 100000,
            ]
        ]);
    }
}