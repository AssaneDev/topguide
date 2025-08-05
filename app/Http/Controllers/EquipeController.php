<?php

namespace App\Http\Controllers;

use App\Models\Equipe;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EquipeController extends Controller
{
    /**
     * Dashboard gestion équipes
     */
    public function dashboard()
    {
        $equipes = Equipe::orderBy('created_at', 'desc')->get();
        
        $stats = [
            'total_equipes' => Equipe::count(),
            'equipes_actives' => Equipe::where('actif', true)->count(),
            'photographes' => Equipe::where('role', 'photographe')->count(),
            'gestionnaires' => Equipe::where('role', 'gestionnaire_posts')->count(),
        ];
        
        return view('admin.equipes.dashboard', compact('equipes', 'stats'));
    }

    /**
     * Créer nouvelle équipe
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|email|unique:equipes,email',
            'telephone' => 'nullable|string|max:20',
            'role' => 'required|in:photographe,gestionnaire_posts,guide,admin'
        ]);

        $equipe = Equipe::create($validated);

        $notification = [
            'message' => 'Équipe créée avec succès !',
            'alert-type' => 'success'
        ];

        return redirect()->route('equipe.dashboard')->with($notification);
    }

    /**
     * Régénérer token d'accès
     */
    public function regenererToken(Equipe $equipe)
    {
        $nouveauToken = $equipe->genererNouveauToken();
        
        $lien = route('terrain.acces', $nouveauToken);
        
        return response()->json([
            'success' => true,
            'nouveau_token' => $nouveauToken,
            'lien' => $lien,
            'message' => 'Token régénéré avec succès'
        ]);
    }

    /**
     * Activer/désactiver équipe
     */
    public function toggleActif(Equipe $equipe)
    {
        $equipe->update(['actif' => !$equipe->actif]);
        
        $message = $equipe->actif ? 'Équipe activée' : 'Équipe désactivée';
        
        return response()->json([
            'success' => true,
            'actif' => $equipe->actif,
            'message' => $message
        ]);
    }

    /**
     * Supprimer équipe
     */
    public function destroy(Equipe $equipe)
    {
        $equipe->delete();
        
        $notification = [
            'message' => 'Équipe supprimée avec succès',
            'alert-type' => 'success'
        ];
        
        return redirect()->route('equipe.dashboard')->with($notification);
    }

    /**
     * Envoyer lien par email
     */
    public function envoyerLien(Equipe $equipe)
    {
        $lien = route('terrain.acces', $equipe->token_acces);
        
        // TODO: Implémenter envoi email
        // Mail::to($equipe->email)->send(new LienAccesEquipe($lien));
        
        return response()->json([
            'success' => true,
            'message' => 'Lien envoyé par email à ' . $equipe->email
        ]);
    }

    /**
     * Voir historique accès équipe
     */
    public function historique(Equipe $equipe)
    {
        // TODO: Implémenter log des accès
        $historique = [
            ['action' => 'Connexion', 'date' => now()->subHours(2), 'ip' => '192.168.1.1'],
            ['action' => 'Consultation programme', 'date' => now()->subHours(1), 'ip' => '192.168.1.1'],
        ];
        
        return response()->json([
            'success' => true,
            'historique' => $historique
        ]);
    }

    /**
     * API - Statistiques équipes
     */
    public function apiStats()
    {
        $stats = [
            'connexions_aujourdhui' => Equipe::where('derniere_connexion', '>=', now()->startOfDay())->count(),
            'equipes_en_ligne' => Equipe::where('derniere_connexion', '>=', now()->subMinutes(10))->count(),
            'actions_effectuees' => 0, // À implémenter
        ];
        
        return response()->json($stats);
    }

    /**
     * Exporter liste équipes
     */
    public function export()
    {
        $equipes = Equipe::all();
        
        $csv = "Nom,Email,Téléphone,Rôle,Statut,Token,Lien d'accès\n";
        
        foreach ($equipes as $equipe) {
            $lien = route('terrain.acces', $equipe->token_acces);
            $csv .= sprintf(
                '"%s","%s","%s","%s","%s","%s","%s"' . "\n",
                $equipe->nom,
                $equipe->email,
                $equipe->telephone ?? '',
                $equipe->role,
                $equipe->actif ? 'Actif' : 'Inactif',
                $equipe->token_acces,
                $lien
            );
        }
        
        return response($csv)
            ->header('Content-Type', 'text/csv')
            ->header('Content-Disposition', 'attachment; filename="equipes_' . date('Y-m-d') . '.csv"');
    }
}