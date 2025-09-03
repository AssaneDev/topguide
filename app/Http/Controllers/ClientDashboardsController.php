<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Voyage;
use App\Models\User;
use App\Models\VoyageConsultation;
use App\Models\UserFavorite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class ClientDashboardsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    // ============= MÉTHODES UTILITAIRES =============
    
    private function hasColumn($table, $column)
    {
        try {
            return Schema::hasColumn($table, $column);
        } catch (\Exception $e) {
            try {
                $columns = DB::getSchemaBuilder()->getColumnListing($table);
                return in_array($column, $columns);
            } catch (\Exception $e2) {
                return false;
            }
        }
    }
    
    private function hasTable($table)
    {
        try {
            return Schema::hasTable($table);
        } catch (\Exception $e) {
            try {
                DB::table($table)->limit(1)->get();
                return true;
            } catch (\Exception $e2) {
                return false;
            }
        }
    }

    // Dashboard principal du client
    public function index()
    {
        $user = Auth::user();
        
        // Statistiques utilisateur
        $stats = [
            'voyages_consultes' => $this->getVoyagesConsultes(),
            'voyages_favoris' => $this->getVoyagesFavoris(),
            'reservations' => $this->getReservations(),
            'voyage_en_cours' => $this->getVoyageEnCours()
        ];
        
        // Derniers voyages consultés
        $derniersVoyages = $this->getDerniersVoyagesConsultes();
        
        // Recommandations personnalisées
        $recommendations = $this->getRecommandations();
        
        // Nouvelles offres
        $nouvellesOffres = Voyage::where('statut', 'publie')
                                ->where('created_at', '>=', now()->subDays(30))
                                ->latest()
                                ->take(4)
                                ->get();
        
        return view('frontend.client.dashboard', compact(
            'user', 'stats', 'derniersVoyages', 'recommendations', 'nouvellesOffres'
        ));
    }

    // Mes voyages consultés et favoris
    public function mesVoyages()
    {
        $user = Auth::user();
        
        // Voyages consultés (depuis la base + sessions)
        $voyagesConsultes = $this->getVoyagesConsultesDetailles();
        
        // Voyages favoris
        $voyagesFavoris = $this->getVoyagesFavorisDetailles();
        
        return view('frontend.client.mes-voyages', compact(
            'user', 'voyagesConsultes', 'voyagesFavoris'
        ));
    }

    // Mes réservations
    public function mesReservations()
    {
        $user = Auth::user();
        
        // TODO: Implémenter le système de réservations
        $reservations = collect([]);
        
        return view('frontend.client.mes-reservations', compact('user', 'reservations'));
    }

    // Profil utilisateur
    public function profil()
    {
        $user = Auth::user();
        
        return view('frontend.client.profil', compact('user'));
    }

    // Mettre à jour le profil avec vérification des colonnes
    public function updateProfil(Request $request)
    {
        $user = Auth::user();
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
            'date_naissance' => 'nullable|date',
            'preferences_voyage' => 'nullable|array',
        ]);
        
        // Vérifier les colonnes avant de les mettre à jour
        $updateData = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        // Ajouter seulement les colonnes qui existent
        if ($this->hasColumn('users', 'phone')) {
            $updateData['phone'] = $request->phone;
        }
        
        if ($this->hasColumn('users', 'address')) {
            $updateData['address'] = $request->address;
        }
        
        if ($this->hasColumn('users', 'date_naissance')) {
            $updateData['date_naissance'] = $request->date_naissance;
        }
        
        if ($this->hasColumn('users', 'preferences_voyage')) {
            $updateData['preferences_voyage'] = $request->preferences_voyage ? json_encode($request->preferences_voyage) : null;
        }
        
        $user->update($updateData);
        
        $notification = [
            'message' => 'Profil mis à jour avec succès',
            'alert-type' => 'success'
        ];
        
        return redirect()->back()->with($notification);
    }

    // Changer le mot de passe
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);
        
        if (!Hash::check($request->current_password, Auth::user()->password)) {
            return back()->withErrors(['current_password' => 'Le mot de passe actuel est incorrect']);
        }
        
        Auth::user()->update([
            'password' => Hash::make($request->password)
        ]);
        
        $notification = [
            'message' => 'Mot de passe changé avec succès',
            'alert-type' => 'success'
        ];
        
        return redirect()->back()->with($notification);
    }

    // ============= MÉTHODES PRIVÉES AVEC VÉRIFICATIONS =============

    private function getVoyagesConsultes()
    {
        // Vérifier si la table existe
        if (!$this->hasTable('voyage_consultations')) {
            return count(session('consultations', []));
        }

        try {
            $fromDB = VoyageConsultation::where('user_id', Auth::id())
                                       ->distinct('voyage_id')
                                       ->count();
            
            $fromSession = count(session('consultations', []));
            
            return max($fromDB, $fromSession);
        } catch (\Exception $e) {
            return count(session('consultations', []));
        }
    }

    private function getVoyagesFavoris()
    {
        // Vérifier si la table existe
        if (!$this->hasTable('user_favorites')) {
            return 0;
        }

        try {
            return UserFavorite::where('user_id', Auth::id())->count();
        } catch (\Exception $e) {
            return 0;
        }
    }

    private function getReservations()
    {
        // TODO: Implémenter quand le système de réservations sera prêt
        return 0;
    }

    private function getVoyageEnCours()
    {
        // TODO: Implémenter quand le système de réservations sera prêt
        return null;
    }

    private function getDerniersVoyagesConsultes()
    {
        $consultationsSession = session('consultations', []);
        
        // Si pas de table consultation, utiliser seulement les sessions
        if (!$this->hasTable('voyage_consultations')) {
            $voyageIdsFromSession = array_keys($consultationsSession);
            $allVoyageIds = $voyageIdsFromSession;
        } else {
            try {
                $voyageIdsFromDB = VoyageConsultation::where('user_id', Auth::id())
                                                    ->orderBy('updated_at', 'desc')
                                                    ->limit(5)
                                                    ->pluck('voyage_id')
                                                    ->toArray();
                
                $voyageIdsFromSession = array_keys($consultationsSession);
                $allVoyageIds = array_unique(array_merge($voyageIdsFromDB, $voyageIdsFromSession));
            } catch (\Exception $e) {
                $allVoyageIds = array_keys($consultationsSession);
            }
        }
        
        if (empty($allVoyageIds)) {
            return collect();
        }
        
        return Voyage::whereIn('id', array_slice($allVoyageIds, 0, 5))
                    ->where('statut', 'publie')
                    ->with(['etapes', 'activites'])
                    ->get();
    }

    private function getVoyagesConsultesDetailles()
    {
        $consultationsSession = session('consultations', []);
        
        // Si pas de table consultation, utiliser seulement les sessions
        if (!$this->hasTable('voyage_consultations')) {
            $allVoyageIds = array_keys($consultationsSession);
        } else {
            try {
                $voyageIdsFromDB = VoyageConsultation::where('user_id', Auth::id())
                                                    ->distinct('voyage_id')
                                                    ->pluck('voyage_id')
                                                    ->toArray();
                
                $voyageIdsFromSession = array_keys($consultationsSession);
                $allVoyageIds = array_unique(array_merge($voyageIdsFromDB, $voyageIdsFromSession));
            } catch (\Exception $e) {
                $allVoyageIds = array_keys($consultationsSession);
            }
        }
        
        if (empty($allVoyageIds)) {
            return collect();
        }
        
        $voyages = Voyage::whereIn('id', $allVoyageIds)
                        ->where('statut', 'publie')
                        ->with(['etapes', 'activites'])
                        ->get();
        
        // Ajouter les données de consultation
        return $voyages->map(function ($voyage) use ($consultationsSession) {
            if ($this->hasTable('voyage_consultations')) {
                try {
                    $consultationDB = VoyageConsultation::where('user_id', Auth::id())
                                                       ->where('voyage_id', $voyage->id)
                                                       ->latest()
                                                       ->first();
                } catch (\Exception $e) {
                    $consultationDB = null;
                }
            } else {
                $consultationDB = null;
            }
            
            $consultationSession = $consultationsSession[$voyage->id] ?? [];
            
            $voyage->consultation_data = [
                'db' => $consultationDB,
                'session' => $consultationSession
            ];
            
            $voyage->derniere_consultation = $consultationDB ? 
                $consultationDB->updated_at : 
                (collect($consultationSession)->isNotEmpty() ? 
                    collect($consultationSession)->sortByDesc('timestamp')->first() : 
                    null);
                    
            return $voyage;
        });
    }

    private function getVoyagesFavorisDetailles()
    {
        if (!$this->hasTable('user_favorites')) {
            return collect();
        }

        try {
            return UserFavorite::where('user_id', Auth::id())
                              ->with(['voyage' => function($query) {
                                  $query->where('statut', 'publie')
                                        ->with(['etapes', 'activites']);
                              }])
                              ->get()
                              ->filter(function($favorite) {
                                  return $favorite->voyage !== null;
                              })
                              ->map(function($favorite) {
                                  $voyage = $favorite->voyage;
                                  $voyage->favorite_data = $favorite;
                                  return $voyage;
                              });
        } catch (\Exception $e) {
            return collect();
        }
    }

    private function getRecommandations()
    {
        $consultationsSession = array_keys(session('consultations', []));
        
        // Récupérer depuis la base si la table existe
        if ($this->hasTable('voyage_consultations')) {
            try {
                $consultationsDB = VoyageConsultation::where('user_id', Auth::id())
                                                    ->distinct('voyage_id')
                                                    ->pluck('voyage_id')
                                                    ->toArray();
                $voyageIds = array_unique(array_merge($consultationsDB, $consultationsSession));
            } catch (\Exception $e) {
                $voyageIds = $consultationsSession;
            }
        } else {
            $voyageIds = $consultationsSession;
        }
        
        // Logique simple de recommandation
        if (empty($voyageIds)) {
            return Voyage::where('statut', 'publie')
                        ->withCount('etapes')
                        ->orderBy('etapes_count', 'desc')
                        ->take(3)
                        ->get();
        }
        
        // Récupérer les types de voyages consultés
        $typesConsultes = Voyage::whereIn('id', $voyageIds)
                               ->pluck('type_voyage')
                               ->unique();
        
        return Voyage::where('statut', 'publie')
                    ->whereIn('type_voyage', $typesConsultes)
                    ->whereNotIn('id', $voyageIds)
                    ->with(['etapes', 'activites'])
                    ->take(3)
                    ->get();
    }

    // ============= MÉTHODES AJAX CORRIGÉES =============

    public function toggleFavori(Request $request, $voyage_id)
    {
        // Vérifier si la table user_favorites existe
        if (!$this->hasTable('user_favorites')) {
            return response()->json([
                'success' => false,
                'message' => 'Système de favoris non disponible'
            ], 500);
        }

        try {
            $user = Auth::user();
            
            $voyage = Voyage::where('id', $voyage_id)
                           ->where('statut', 'publie')
                           ->firstOrFail();
            
            $favorite = UserFavorite::where('user_id', $user->id)
                                   ->where('voyage_id', $voyage_id)
                                   ->first();
            
            if ($favorite) {
                $favorite->delete();
                $message = 'Retiré des favoris';
                $is_favorite = false;
            } else {
                UserFavorite::create([
                    'user_id' => $user->id,
                    'voyage_id' => $voyage_id,
                    'priorite' => 3,
                ]);
                $message = 'Ajouté aux favoris';
                $is_favorite = true;
            }
            
            return response()->json([
                'success' => true,
                'message' => $message,
                'is_favorite' => $is_favorite
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la mise à jour des favoris'
            ], 500);
        }
    }

    public function supprimerConsultation($voyage_id)
    {
        try {
            $user = Auth::user();
            
            // Supprimer de la base si la table existe
            if ($this->hasTable('voyage_consultations')) {
                VoyageConsultation::where('user_id', $user->id)
                                 ->where('voyage_id', $voyage_id)
                                 ->delete();
            }
            
            // Supprimer de la session
            $consultations = session('consultations', []);
            unset($consultations[$voyage_id]);
            session(['consultations' => $consultations]);
            
            return response()->json([
                'success' => true,
                'message' => 'Supprimé de l\'historique'
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la suppression'
            ], 500);
        }
    }
}