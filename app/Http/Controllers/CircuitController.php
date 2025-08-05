<?php

namespace App\Http\Controllers;

use App\Models\Circuit;
use App\Models\Equipe;
use App\Models\ProgrammeJournalier;
use App\Models\ConsigneCommunication;
use App\Models\TemplateConsigne;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class CircuitController extends Controller
{
       // Dashboard
    public function dashboard()
    {
        $circuits = Circuit::with('programmeJournaliers')
                          ->orderBy('date_debut', 'desc')
                          ->get();
        
        $stats = [
            'circuits_actifs' => Circuit::where('statut', 'en_cours')->count(),
            'equipes_actives' => Equipe::where('actif', true)->count(),
            'posts_aujourdhui' => 12,
            'engagement_moyen' => '8.5%'
        ];
        
        $activites = collect([]);
        $equipes = Equipe::where('actif', true)->get();
        
        return view('admin.circuits.dashboard', compact('circuits', 'stats', 'activites', 'equipes'));
    }

    // Créer nouveau circuit
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'nom' => 'required|string|max:255',
                'date_debut' => 'required|date',
                'nb_jours' => 'required|integer|min:1',
                'description' => 'nullable|string',
                'guide_principal' => 'nullable|string'
            ]);

            $validated['date_fin'] = Carbon::parse($validated['date_debut'])
                                          ->addDays($validated['nb_jours'] - 1);
            $validated['statut'] = 'planifié';

            $circuit = Circuit::create($validated);
            $this->genererProgrammeJours($circuit);

            return redirect()->route('circuits.edit', $circuit)
                            ->with('success', 'Circuit créé avec succès !');

        } catch (\Exception $e) {
            Log::error('Erreur création circuit: ' . $e->getMessage());
            return redirect()->back()
                            ->withErrors(['error' => 'Erreur lors de la création'])
                            ->withInput();
        }
    }

    // ✅ MÉTHODE UPDATE CORRIGÉE
    public function update(Request $request, Circuit $circuit)
    {
        try {
            $validated = $request->validate([
                'nom' => 'required|string|max:255',
                'date_debut' => 'required|date',
                'nb_jours' => 'required|integer|min:1',
                'description' => 'nullable|string',
                'guide_principal' => 'nullable|string',
                'statut' => 'nullable|string|in:planifié,en_cours,terminé,annulé'
            ]);

            if ($request->has('date_debut') || $request->has('nb_jours')) {
                $validated['date_fin'] = Carbon::parse($validated['date_debut'])
                                              ->addDays($validated['nb_jours'] - 1);
            }

            $circuit->update($validated);

            // ✅ TOUJOURS RETOURNER JSON POUR AJAX
            return response()->json([
                'success' => true,
                'message' => 'Circuit mis à jour avec succès !',
                'data' => $circuit
            ]);

        } catch (\Exception $e) {
            Log::error('Erreur mise à jour circuit: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la mise à jour: ' . $e->getMessage()
            ], 500);
        }
    }

    // Éditer circuit
    public function edit(Circuit $circuit)
    {
        $circuit->load('programmeJournaliers.consignesCommunication');
        return view('admin.circuits.edit', compact('circuit'));
    }

    // ✅ MÉTHODE UPDATE JOUR CORRIGÉE
    public function updateJour(Request $request, ProgrammeJournalier $programme)
    {
        try {
            $validated = $request->validate([
                'lieu_principal' => 'required|string',
                'activites' => 'required|string',
                'hebergement' => 'nullable|string',
                'horaires' => 'nullable|array',
                'notes_speciales' => 'nullable|string'
            ]);

            $programme->update($validated);

            return response()->json([
                'success' => true,
                'message' => 'Programme mis à jour avec succès !',
                'data' => $programme
            ]);

        } catch (\Exception $e) {
            Log::error('Erreur mise à jour programme: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la mise à jour: ' . $e->getMessage()
            ], 500);
        }
    }

    // ✅ MÉTHODE GÉNÉRER CONSIGNES CORRIGÉE
    public function genererConsignes(ProgrammeJournalier $programme)
    {
        try {
            $activites = strtolower($programme->activites);
            $lieu = strtolower($programme->lieu_principal);

            // Générer consignes pour photographe
            $consignesPhoto = [
                'consignes_specifiques' => "📸 FOCUS JOUR : " . ucfirst($lieu) . "\n\n🎬 STORIES :\n- Matin : Ambiance réveil + paysage\n- Action : " . $activites . " en cours\n- Soir : Bilan + teaser demain\n\n🎥 VIDÉO COURTE :\n- 30-45s action principale\n- Réactions clients\n- Musique locale",
                'moments_cles' => ['matin' => '08:00', 'action' => '14:00', 'soir' => '18:00'],
                'hashtags_jour' => ['#VacancesSénégal', '#' . ucfirst($lieu)],
                'objectifs_contenu' => 'Capturer l\'authenticité du moment',
                'priorite' => 'normale'
            ];

            // Générer consignes pour gestionnaire
            $consignesGest = [
                'consignes_specifiques' => "🌍 POST DÉCOUVERTE\n\n📝 STRUCTURE :\n- Description émotionnelle lieu\n- Information culturelle\n- Expérience groupe\n- Photo : Paysage/monument\n\n⏰ PUBLICATION : 9h\n💬 ENGAGEMENT : Répondre <2h",
                'moments_cles' => ['publication' => '09:00', 'interaction' => '11:00-20:00'],
                'hashtags_jour' => ['#VacancesSénégal', '#Découverte'],
                'objectifs_contenu' => 'Post découverte + engagement communauté',
                'priorite' => 'normale'
            ];

            // Sauvegarder dans la base
            ConsigneCommunication::updateOrCreate(
                [
                    'programme_journalier_id' => $programme->id,
                    'type_equipe' => 'photographe'
                ],
                $consignesPhoto
            );

            ConsigneCommunication::updateOrCreate(
                [
                    'programme_journalier_id' => $programme->id,
                    'type_equipe' => 'gestionnaire_posts'
                ],
                $consignesGest
            );

            return response()->json([
                'success' => true,
                'message' => 'Consignes générées avec succès !',
                'data' => [
                    'photographe' => $consignesPhoto,
                    'gestionnaire' => $consignesGest
                ]
            ]);

        } catch (\Exception $e) {
            Log::error('Erreur génération consignes: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la génération: ' . $e->getMessage()
            ], 500);
        }
    }

    // ✅ MÉTHODE ACTIVER CIRCUIT CORRIGÉE
    public function activerCircuit(Circuit $circuit)
    {
        try {
            $circuit->update(['statut' => 'en_cours']);
            
            return response()->json([
                'success' => true,
                'message' => 'Circuit activé avec succès !',
                'nouveau_statut' => 'en_cours',
                'data' => $circuit
            ]);

        } catch (\Exception $e) {
            Log::error('Erreur activation circuit: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de l\'activation: ' . $e->getMessage()
            ], 500);
        }
    }

    public function envoyerLiensCircuit(Circuit $circuit)
    {
        try {
            $programmeAujourdhui = $circuit->getProgrammeAujourdhui();
            
            if (!$programmeAujourdhui) {
                return response()->json([
                    'success' => false,
                    'message' => 'Aucun programme pour aujourd\'hui'
                ]);
            }
            
            $equipes = Equipe::where('actif', true)->get();
            $equipesNotifiees = $equipes->count();
            
            foreach ($equipes as $equipe) {
                $lien = route('terrain.acces', $equipe->token_acces);
                Log::info("Lien envoyé à {$equipe->nom}: {$lien}");
            }
            
            return response()->json([
                'success' => true,
                'message' => "Liens envoyés à {$equipesNotifiees} équipes",
                'equipes_notifiees' => $equipesNotifiees
            ]);

        } catch (\Exception $e) {
            Log::error('Erreur envoi liens circuit: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de l\'envoi: ' . $e->getMessage()
            ], 500);
        }
    }

    public function envoyerLiensAujourdhui()
    {
        try {
            $circuits = Circuit::where('statut', 'en_cours')->get();
            $totalEquipes = 0;
            
            foreach ($circuits as $circuit) {
                $result = $this->envoyerLiensCircuit($circuit);
                $data = $result->getData(true);
                if ($data['success']) {
                    $totalEquipes += $data['equipes_notifiees'];
                }
            }
            
            return response()->json([
                'success' => true,
                'message' => "Liens envoyés à {$totalEquipes} équipes au total",
                'equipes_notifiees' => $totalEquipes
            ]);

        } catch (\Exception $e) {
            Log::error('Erreur envoi liens aujourd\'hui: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de l\'envoi: ' . $e->getMessage()
            ], 500);
        }
    }

    public function voirLiensEquipe(Circuit $circuit)
    {
        try {
            $equipes = Equipe::where('actif', true)->get();
            
            $liens = [];
            foreach ($equipes as $equipe) {
                $liens[] = [
                    'nom' => $equipe->nom,
                    'role' => $equipe->role,
                    'lien' => route('terrain.acces', $equipe->token_acces)
                ];
            }
            
            $html = view('admin.circuits.partials.liens-equipe', compact('liens', 'circuit'))->render();
            return response($html);

        } catch (\Exception $e) {
            Log::error('Erreur liens équipe: ' . $e->getMessage());
            return response('<div class="alert alert-danger">Erreur lors du chargement</div>', 500);
        }
    }

    public function destroy(Circuit $circuit)
    {
        try {
            $circuit->delete();
            
            return response()->json([
                'success' => true,
                'message' => 'Circuit supprimé avec succès !'
            ]);

        } catch (\Exception $e) {
            Log::error('Erreur suppression circuit: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la suppression: ' . $e->getMessage()
            ], 500);
        }
    }

    // ===== MÉTHODES PRIVÉES =====

    private function genererProgrammeJours(Circuit $circuit)
    {
        $dateDebut = Carbon::parse($circuit->date_debut);
        
        for ($i = 1; $i <= $circuit->nb_jours; $i++) {
            ProgrammeJournalier::create([
                'circuit_id' => $circuit->id,
                'jour_numero' => $i,
                'date' => $dateDebut->copy()->addDays($i - 1),
                'lieu_principal' => 'À définir',
                'activites' => 'Programme à compléter',
                'horaires' => [
                    'matin' => '09:00',
                    'dejeuner' => '13:00',
                    'apres_midi' => '15:00',
                    'diner' => '19:00'
                ]
            ]);
        }
        }

    private function genererConsignesAvecTemplate($typeEquipe, $activites, $lieu)
    {
        // Essayer de trouver un template
        $template = TemplateConsigne::trouverMeilleurTemplate($typeEquipe, $lieu, $activites);
        
        if ($template) {
            $variables = [
                '{LIEU}' => ucfirst($lieu),
                '{ACTIVITES}' => $activites,
                '{DATE}' => now()->format('d/m/Y')
            ];
            
            return $template->genererConsignes($lieu, $activites, $variables);
        }
        
        // Fallback vers méthodes par défaut
        if ($typeEquipe === 'photographe') {
            return $this->genererConsignesPhotographeDefaut($activites, $lieu);
        } else {
            return $this->genererConsignesGestionnaireDefaut($activites, $lieu);
        }
    }

    private function genererConsignesPhotographeDefaut($activites, $lieu)
    {
        $hashtags = ['#VacancesSénégal'];
        $moments = ['matin' => '08:00', 'action' => '14:00', 'soir' => '18:00'];
        $objectifs = 'Capturer l\'authenticité du moment';

        if (str_contains($activites, 'plongée')) {
            $hashtags[] = '#PlongéeSénégal';
            $moments['plongee'] = '10:00';
            $objectifs = 'GoPro sous-marine + réactions clients';
        }

        return [
            'consignes_specifiques' => "📸 FOCUS JOUR : " . ucfirst($lieu) . "\n\n🎬 STORIES :\n- Matin : Ambiance réveil + paysage\n- Action : " . $activites . " en cours\n- Soir : Bilan + teaser demain",
            'moments_cles' => $moments,
            'hashtags_jour' => $hashtags,
            'objectifs_contenu' => $objectifs,
            'priorite' => 'normale'
        ];
    }

    private function genererConsignesGestionnaireDefaut($activites, $lieu)
    {
        $hashtags = ['#VacancesSénégal'];
        
        return [
            'consignes_specifiques' => "🌍 POST DÉCOUVERTE\n\n📝 STRUCTURE :\n- Description émotionnelle lieu\n- Information culturelle\n- Expérience groupe",
            'moments_cles' => ['publication' => '09:00', 'interaction' => '11:00-20:00'],
            'hashtags_jour' => $hashtags,
            'objectifs_contenu' => 'Post découverte + engagement communauté',
            'priorite' => 'normale'
        ];
    }
}