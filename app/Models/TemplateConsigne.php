<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemplateConsigne extends Model
{
    use HasFactory;

    protected $table = 'templates_consignes';

    protected $fillable = [
        'nom',
        'description',
        'type_equipe',
        'categorie',
        'mots_cles',
        'consignes_template',
        'moments_cles_template',
        'hashtags_template',
        'objectifs_template',
        'priorite_defaut',
        'actif',
        'ordre'
    ];

    protected $casts = [
        'mots_cles' => 'array',
        'moments_cles_template' => 'array',
        'hashtags_template' => 'array',
        'actif' => 'boolean'
    ];

    /**
     * Scope : Templates actifs
     */
    public function scopeActifs($query)
    {
        return $query->where('actif', true);
    }

    /**
     * Scope : Templates par type d'équipe
     */
    public function scopeParTypeEquipe($query, $type)
    {
        return $query->where(function($q) use ($type) {
            $q->where('type_equipe', $type)
              ->orWhere('type_equipe', 'both');
        });
    }

    /**
     * Scope : Templates par catégorie
     */
    public function scopeParCategorie($query, $categorie)
    {
        return $query->where('categorie', $categorie);
    }

    /**
     * Scope : Ordonné
     */
    public function scopeOrdonne($query)
    {
        return $query->orderBy('ordre')->orderBy('nom');
    }

    /**
     * Méthode : Vérifier si le template correspond aux mots-clés
     */
    public function correspondAuxMotsCles($texte)
    {
        if (empty($this->mots_cles)) return false;
        
        $texte = strtolower($texte);
        
        foreach ($this->mots_cles as $motCle) {
            if (str_contains($texte, strtolower($motCle))) {
                return true;
            }
        }
        
        return false;
    }

    /**
     * Méthode : Générer consignes depuis template
     */
    public function genererConsignes($lieu, $activites, $variables = [])
    {
        // Variables par défaut
        $defaultVariables = [
            '{LIEU}' => ucfirst($lieu),
            '{ACTIVITES}' => $activites,
            '{DATE}' => now()->format('d/m/Y'),
            '{HEURE_MATIN}' => '08:00',
            '{HEURE_ACTION}' => '14:00',
            '{HEURE_SOIR}' => '18:00'
        ];
        
        $allVariables = array_merge($defaultVariables, $variables);
        
        return [
            'consignes_specifiques' => $this->remplacerVariables($this->consignes_template, $allVariables),
            'moments_cles' => $this->remplacerVariablesDansArray($this->moments_cles_template, $allVariables),
            'hashtags_jour' => $this->ajouterHashtagsContextuels($this->hashtags_template, $lieu, $activites),
            'objectifs_contenu' => $this->remplacerVariables($this->objectifs_template, $allVariables),
            'priorite' => $this->priorite_defaut
        ];
    }

    /**
     * Remplacer variables dans texte
     */
    private function remplacerVariables($texte, $variables)
    {
        return str_replace(array_keys($variables), array_values($variables), $texte);
    }

    /**
     * Remplacer variables dans array
     */
    private function remplacerVariablesDansArray($array, $variables)
    {
        if (!is_array($array)) return $array;
        
        $result = [];
        foreach ($array as $key => $value) {
            $newKey = $this->remplacerVariables($key, $variables);
            $newValue = $this->remplacerVariables($value, $variables);
            $result[$newKey] = $newValue;
        }
        
        return $result;
    }

    /**
     * Ajouter hashtags contextuels
     */
    private function ajouterHashtagsContextuels($hashtags, $lieu, $activites)
    {
        $result = $hashtags;
        
        // Hashtags selon lieu
        $lieuLower = strtolower($lieu);
        $hashtagsLieu = [
            'gorée' => '#PatrimoineUNESCO',
            'saint-louis' => '#PatrimoineUNESCO',
            'lac rose' => '#LacRose',
            'sine saloum' => '#SineSaloum',
            'lompoul' => '#DésertLompoul',
            'casamance' => '#Casamance'
        ];
        
        foreach ($hashtagsLieu as $mot => $hashtag) {
            if (str_contains($lieuLower, $mot) && !in_array($hashtag, $result)) {
                $result[] = $hashtag;
            }
        }
        
        // Hashtags selon activités
        $activitesLower = strtolower($activites);
        $hashtagsActivites = [
            'plongée' => '#PlongéeSénégal',
            'pirogue' => '#PirogueTraditionelle',
            'dromadaire' => '#Dromadaires',
            'safari' => '#SafariAfrique',
            'marché' => '#MarchéSénégal',
            'pêche' => '#PêcheTraditionelle'
        ];
        
        foreach ($hashtagsActivites as $mot => $hashtag) {
            if (str_contains($activitesLower, $mot) && !in_array($hashtag, $result)) {
                $result[] = $hashtag;
            }
        }
        
        return $result;
    }

    /**
     * Méthode statique : Trouver le meilleur template
     */
    public static function trouverMeilleurTemplate($typeEquipe, $lieu, $activites)
    {
        $templates = self::actifs()
                        ->parTypeEquipe($typeEquipe)
                        ->ordonne()
                        ->get();
        
        $texteRecherche = $lieu . ' ' . $activites;
        
        // Chercher template avec correspondance exacte
        foreach ($templates as $template) {
            if ($template->correspondAuxMotsCles($texteRecherche)) {
                return $template;
            }
        }
        
        // Sinon, prendre le template par défaut pour ce type d'équipe
        return $templates->where('categorie', 'defaut')->first() 
               ?? $templates->first();
    }

    /**
     * Accesseur : Icône selon type équipe
     */
    public function getIconeAttribute()
    {
        return match($this->type_equipe) {
            'photographe' => '📸',
            'gestionnaire_posts' => '✍️',
            'both' => '👥',
            default => '📝'
        };
    }

    /**
     * Accesseur : Couleur selon catégorie
     */
    public function getCouleurAttribute()
    {
        return match($this->categorie) {
            'nature' => 'success',
            'culture' => 'primary',
            'aventure' => 'warning',
            'defaut' => 'secondary',
            default => 'info'
        };
    }
}