<?php

namespace App\Http\Controllers;

use App\Models\TemplateConsigne;
use Illuminate\Http\Request;

class TemplateConsigneController extends Controller
{
    /**
     * Dashboard templates
     */
    public function index()
    {
        $templates = TemplateConsigne::ordonne()->get();
        
        $stats = [
            'total_templates' => TemplateConsigne::count(),
            'templates_actifs' => TemplateConsigne::actifs()->count(),
            'templates_photographe' => TemplateConsigne::parTypeEquipe('photographe')->count(),
            'templates_gestionnaire' => TemplateConsigne::parTypeEquipe('gestionnaire_posts')->count(),
        ];
        
        $categories = TemplateConsigne::distinct()->pluck('categorie')->filter()->sort();
        
        return view('admin.templates.index', compact('templates', 'stats', 'categories'));
    }

    /**
     * Formulaire création template
     */
    public function create()
    {
        $categories = ['defaut', 'nature', 'culture', 'aventure', 'gastronomie', 'transport'];
        return view('admin.templates.create', compact('categories'));
    }

    /**
     * Sauvegarder nouveau template
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
            'type_equipe' => 'required|in:photographe,gestionnaire_posts,both',
            'categorie' => 'required|string|max:50',
            'mots_cles' => 'required|array|min:1',
            'mots_cles.*' => 'required|string|max:100',
            'consignes_template' => 'required|string',
            'moments_cles_template' => 'nullable|array',
            'hashtags_template' => 'nullable|array',
            'hashtags_template.*' => 'string|max:50',
            'objectifs_template' => 'required|string',
            'priorite_defaut' => 'required|in:normale,importante,critique',
            'ordre' => 'nullable|integer|min:0'
        ]);

        TemplateConsigne::create($validated);

        $notification = [
            'message' => 'Template créé avec succès !',
            'alert-type' => 'success'
        ];

        return redirect()->route('templates.index')->with($notification);
    }

    /**
     * Éditer template
     */
    public function edit(TemplateConsigne $template)
    {
        $categories = ['defaut', 'nature', 'culture', 'aventure', 'gastronomie', 'transport'];
        return view('admin.templates.edit', compact('template', 'categories'));
    }

    /**
     * Mettre à jour template
     */
    public function update(Request $request, TemplateConsigne $template)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
            'type_equipe' => 'required|in:photographe,gestionnaire_posts,both',
            'categorie' => 'required|string|max:50',
            'mots_cles' => 'required|array|min:1',
            'mots_cles.*' => 'required|string|max:100',
            'consignes_template' => 'required|string',
            'moments_cles_template' => 'nullable|array',
            'hashtags_template' => 'nullable|array',
            'hashtags_template.*' => 'string|max:50',
            'objectifs_template' => 'required|string',
            'priorite_defaut' => 'required|in:normale,importante,critique',
            'ordre' => 'nullable|integer|min:0'
        ]);

        $template->update($validated);

        $notification = [
            'message' => 'Template mis à jour avec succès !',
            'alert-type' => 'success'
        ];

        return redirect()->route('templates.index')->with($notification);
    }

    /**
     * Dupliquer template
     */
    public function duplicate(TemplateConsigne $template)
    {
        $nouveau = $template->replicate();
        $nouveau->nom = $template->nom . ' (Copie)';
        $nouveau->ordre = TemplateConsigne::max('ordre') + 1;
        $nouveau->save();

        $notification = [
            'message' => 'Template dupliqué avec succès !',
            'alert-type' => 'success'
        ];

        return redirect()->route('templates.index')->with($notification);
    }

    /**
     * Activer/désactiver template
     */
    public function toggleActif(TemplateConsigne $template)
    {
        $template->update(['actif' => !$template->actif]);

        return response()->json([
            'success' => true,
            'actif' => $template->actif,
            'message' => $template->actif ? 'Template activé' : 'Template désactivé'
        ]);
    }

    /**
     * Supprimer template
     */
    public function destroy(TemplateConsigne $template)
    {
        $template->delete();

        $notification = [
            'message' => 'Template supprimé avec succès',
            'alert-type' => 'success'
        ];

        return redirect()->route('templates.index')->with($notification);
    }

    /**
     * Prévisualiser template
     */
    public function preview(TemplateConsigne $template, Request $request)
    {
        $lieu = $request->get('lieu', 'Lac Rose');
        $activites = $request->get('activites', 'Visite du lac + photos coucher soleil');
        
        $consignes = $template->genererConsignes($lieu, $activites);
        
        return response()->json([
            'success' => true,
            'consignes' => $consignes,
            'template' => $template->nom
        ]);
    }

    /**
     * Tester correspondance mots-clés
     */
    public function testerMotsCles(Request $request)
    {
        $texte = $request->get('texte', '');
        $typeEquipe = $request->get('type_equipe', 'photographe');
        
        $templates = TemplateConsigne::actifs()
                                   ->parTypeEquipe($typeEquipe)
                                   ->get();
        
        $correspondances = [];
        
        foreach ($templates as $template) {
            if ($template->correspondAuxMotsCles($texte)) {
                $correspondances[] = [
                    'id' => $template->id,
                    'nom' => $template->nom,
                    'mots_cles' => $template->mots_cles,
                    'categorie' => $template->categorie
                ];
            }
        }
        
        return response()->json([
            'success' => true,
            'correspondances' => $correspondances,
            'meilleur_template' => TemplateConsigne::trouverMeilleurTemplate($typeEquipe, '', $texte)
        ]);
    }

    /**
     * Réordonner templates
     */
    public function reorder(Request $request)
    {
        $ordres = $request->get('ordres', []);
        
        foreach ($ordres as $id => $ordre) {
            TemplateConsigne::where('id', $id)->update(['ordre' => $ordre]);
        }
        
        return response()->json(['success' => true]);
    }

    /**
     * Import/Export templates
     */
    public function export()
    {
        $templates = TemplateConsigne::all();
        
        $data = $templates->map(function($template) {
            return $template->only([
                'nom', 'description', 'type_equipe', 'categorie',
                'mots_cles', 'consignes_template', 'moments_cles_template',
                'hashtags_template', 'objectifs_template', 'priorite_defaut'
            ]);
        });
        
        return response()->json([
            'templates' => $data,
            'export_date' => now()->format('Y-m-d H:i:s'),
            'version' => '1.0'
        ])
        ->header('Content-Disposition', 'attachment; filename="templates_consignes_' . date('Y-m-d') . '.json"');
    }

    /**
     * Importer templates depuis JSON
     */
    public function import(Request $request)
    {
        $request->validate([
            'fichier' => 'required|file|mimes:json'
        ]);
        
        $contenu = file_get_contents($request->file('fichier')->path());
        $data = json_decode($contenu, true);
        
        if (!isset($data['templates'])) {
            return back()->withErrors(['fichier' => 'Format de fichier invalide']);
        }
        
        $imported = 0;
        
        foreach ($data['templates'] as $templateData) {
            // Vérifier si template existe déjà
            $existe = TemplateConsigne::where('nom', $templateData['nom'])
                                    ->where('type_equipe', $templateData['type_equipe'])
                                    ->exists();
            
            if (!$existe) {
                TemplateConsigne::create($templateData);
                $imported++;
            }
        }
        
        $notification = [
            'message' => "{$imported} templates importés avec succès !",
            'alert-type' => 'success'
        ];
        
        return redirect()->route('templates.index')->with($notification);
    }
}