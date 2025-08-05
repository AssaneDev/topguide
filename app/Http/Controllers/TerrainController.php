<?php

namespace App\Http\Controllers;

use App\Models\Circuit;
use App\Models\Equipe;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class TerrainController extends Controller
{
    /**
     * Page d'accès avec token équipe
     */
    public function accesToken($token)
    {
        try {
            // Vérifier l'équipe
            $equipe = Equipe::where('token_acces', $token)
                           ->where('actif', true)
                           ->first();

            if (!$equipe) {
                abort(404, 'Lien invalide ou équipe désactivée');
            }

            // Mettre à jour la dernière connexion
            $equipe->update(['derniere_connexion' => now()]);
            
            Log::info("Accès terrain équipe: {$equipe->nom} ({$equipe->role})");

            // Trouver circuit en cours
            $circuit = Circuit::where('statut', 'en_cours')
                             ->orWhere(function($query) {
                                 $query->whereDate('date_debut', '<=', Carbon::today())
                                       ->whereDate('date_fin', '>=', Carbon::today());
                             })
                             ->first();

            // Aucun circuit actif
            if (!$circuit) {
                Log::info("Aucun circuit actif pour équipe: {$equipe->nom}");
                return view('terrain.aucun_circuit', compact('equipe'));
            }

            // Programme d'aujourd'hui
            $programmeAujourdhui = $circuit->getProgrammeAujourdhui();

            // Pas de programme aujourd'hui
            if (!$programmeAujourdhui) {
                Log::info("Pas de programme aujourd'hui pour circuit: {$circuit->nom}");
                return view('terrain.pas_programme', compact('equipe', 'circuit'));
            }

            // Récupérer les consignes selon le rôle
            $consignes = null;
            if ($equipe->role === 'photographe') {
                $consignes = $programmeAujourdhui->getConsignesPhotographe();
            } elseif ($equipe->role === 'gestionnaire_posts') {
                $consignes = $programmeAujourdhui->getConsignesGestionnaire();
            }

            Log::info("Programme affiché pour équipe: {$equipe->nom}, Circuit: {$circuit->nom}, Jour: {$programmeAujourdhui->jour_numero}");

            // Afficher le programme complet
            return view('terrain.programme_jour', compact(
                'equipe', 'circuit', 'programmeAujourdhui', 'consignes'
            ));

        } catch (\Exception $e) {
            Log::error('Erreur accès terrain: ' . $e->getMessage());
            Log::error('Token: ' . $token);
            Log::error('Stack trace: ' . $e->getTraceAsString());
            
            return view('terrain.erreur', [
                'message' => 'Erreur lors du chargement du programme',
                'details' => 'Le programme terrain est temporairement indisponible.',
                'exception' => config('app.debug') ? $e->getMessage() : null
            ]);
        }
    }

    /**
     * API JSON pour mobile
     */
    public function apiProgrammeJour($token)
    {
        try {
            $equipe = Equipe::where('token_acces', $token)
                           ->where('actif', true)
                           ->first();

            if (!$equipe) {
                return response()->json(['error' => 'Token invalide'], 404);
            }

            // Mettre à jour la dernière connexion
            $equipe->update(['derniere_connexion' => now()]);

            $circuit = Circuit::where('statut', 'en_cours')->first();

            if (!$circuit) {
                return response()->json(['error' => 'Aucun circuit actif'], 404);
            }

            $programme = $circuit->getProgrammeAujourdhui();

            if (!$programme) {
                return response()->json(['error' => 'Pas de programme aujourd\'hui'], 404);
            }

            $consignes = null;
            if ($equipe->role === 'photographe') {
                $consignes = $programme->getConsignesPhotographe();
            } elseif ($equipe->role === 'gestionnaire_posts') {
                $consignes = $programme->getConsignesGestionnaire();
            }

            return response()->json([
                'success' => true,
                'equipe' => [
                    'nom' => $equipe->nom,
                    'role' => $equipe->role,
                    'derniere_connexion' => $equipe->derniere_connexion
                ],
                'circuit' => [
                    'nom' => $circuit->nom,
                    'jour_actuel' => $circuit->getJourActuel(),
                    'total_jours' => $circuit->nb_jours
                ],
                'programme' => [
                    'jour_numero' => $programme->jour_numero,
                    'date' => $programme->date->format('Y-m-d'),
                    'date_formatted' => $programme->date->format('d/m/Y'),
                    'lieu' => $programme->lieu_principal,
                    'activites' => $programme->activites,
                    'hebergement' => $programme->hebergement,
                    'horaires' => $programme->horaires,
                    'notes_speciales' => $programme->notes_speciales
                ],
                'consignes' => $consignes ? [
                    'consignes_specifiques' => $consignes->consignes_specifiques,
                    'moments_cles' => $consignes->moments_cles,
                    'hashtags_jour' => $consignes->hashtags_jour,
                    'objectifs_contenu' => $consignes->objectifs_contenu,
                    'priorite' => $consignes->priorite
                ] : null,
                'derniere_mise_a_jour' => now()->format('H:i:s')
            ]);

        } catch (\Exception $e) {
            Log::error('Erreur API terrain: ' . $e->getMessage());
            
            return response()->json([
                'error' => 'Erreur serveur',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}