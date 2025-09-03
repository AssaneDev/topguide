<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voyage extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'transports_inclus' => 'array',
        'hebergements_inclus' => 'array',
        'services_inclus' => 'array',
        'repas_inclus' => 'boolean',
        'guide_inclus' => 'boolean',
        'prix_base' => 'decimal:2',
        'prix_avec_guide' => 'decimal:2',
        'prix_par_personne' => 'decimal:2',
        'supplement_chambre_individuelle' => 'decimal:2',
        'transport_details' => 'array',
        'equipements_obligatoires' => 'array',
        'supplements' => 'array',
        'reductions' => 'array',
        'saisons_disponibles' => 'array',
        'sur_mesure' => 'boolean',
        'recommande' => 'boolean',
        'nouveau' => 'boolean',
        'note_moyenne' => 'decimal:2',
    ];

    // Relations
    public function etapes()
    {
        return $this->hasMany(Etape::class)->orderBy('numero_jour');
    }

    public function etapesAvecDetails()
    {
        return $this->hasMany(Etape::class)
                   ->with(['activitesJour'])
                   ->orderBy('numero_jour');
    }

    public function activites()
    {
        return $this->hasMany(Activite::class);
    }

    public function activitesIncluses()
    {
        return $this->hasMany(Activite::class)->where('type_activite', 'incluse');
    }

    public function activitesOptionnelles()
    {
        return $this->hasMany(Activite::class)->where('type_activite', 'optionnelle');
    }

    public function galeries()
    {
        return $this->hasMany(Galerie::class)->orderBy('ordre_affichage');
    }

    public function galerieGenerale()
    {
        return $this->hasMany(Galerie::class)->where('type_image', 'galerie')->orderBy('ordre_affichage');
    }

    // Accesseurs
    public function getPrixTotalOptionnellesAttribute()
    {
        return $this->activitesOptionnelles()->sum('prix_activite');
    }

    public function getDureeFormatteeAttribute()
    {
        $jours = $this->duree_jours . ' jour' . ($this->duree_jours > 1 ? 's' : '');
        if ($this->duree_nuits) {
            $nuits = $this->duree_nuits . ' nuit' . ($this->duree_nuits > 1 ? 's' : '');
            return "$jours / $nuits";
        }
        return $jours;
    }

    public function getTypeVoyageLabelAttribute()
    {
        $labels = [
            'culturel' => 'Voyage Culturel',
            'aventure' => 'Voyage Aventure',
            'detente' => 'Voyage Détente',
            'famille' => 'Voyage Famille',
            'eco-tourisme' => 'Éco-tourisme',
            'decouverte' => 'Découverte'
        ];
        
        return $labels[$this->type_voyage] ?? $this->type_voyage;
    }

    public function getDifficulteLabelAttribute()
    {
        $labels = [
            'facile' => 'Facile',
            'modere' => 'Modéré', 
            'difficile' => 'Difficile'
        ];
        
        return $labels[$this->difficulte] ?? $this->difficulte;
    }

    public function getTransportsFormatesAttribute()
    {
        if (!$this->transports_inclus) return '';
        return implode(', ', $this->transports_inclus);
    }

    public function getHebergementsFormatesAttribute()
    {
        if (!$this->hebergements_inclus) return '';
        return implode(', ', $this->hebergements_inclus);
    }

    public function getPrixBaseFormateAttribute()
    {
        return number_format($this->prix_base, 0, ',', ' ') . ' FCFA';
    }

    public function getPrixAvecGuideFormateAttribute()
    {
        if (!$this->prix_avec_guide) return null;
        return number_format($this->prix_avec_guide, 0, ',', ' ') . ' FCFA';
    }

    // NOUVEAUX ACCESSEURS POUR EUROS
    public function getPrixBaseEurAttribute()
    {
        return \App\Helpers\CurrencyHelper::fcfaToEur($this->prix_base);
    }

    public function getPrixAvecGuideEurAttribute()
    {
        if (!$this->prix_avec_guide) return null;
        return \App\Helpers\CurrencyHelper::fcfaToEur($this->prix_avec_guide);
    }

    public function getPrixBaseEurFormateAttribute()
    {
        return \App\Helpers\CurrencyHelper::formatEur($this->prix_base);
    }

    public function getPrixAvecGuideEurFormateAttribute()
    {
        if (!$this->prix_avec_guide) return null;
        return \App\Helpers\CurrencyHelper::formatEur($this->prix_avec_guide);
    }

    public function getPrixCompletFormateAttribute()
    {
        return \App\Helpers\CurrencyHelper::formatBothCurrencies($this->prix_base);
    }

    // Méthodes utiles
    public function getNombreEtapesAttribute()
    {
        return $this->etapes()->count();
    }

    public function getNombreActivitesAttribute()
    {
        return $this->activites()->count();
    }

    public function getPrixTotalAvecOptionnellesAttribute()
    {
        return $this->prix_base + $this->prixTotalOptionnelles;
    }

    // ========== NOUVEAUX ACCESSEURS POUR CIRCUITS ==========
    
    public function getNiveauConfortLabelAttribute()
    {
        $labels = [
            'economique' => 'Économique',
            'standard' => 'Standard',
            'superieur' => 'Supérieur',
            'luxe' => 'Luxe'
        ];
        return $labels[$this->niveau_confort] ?? 'Standard';
    }

    public function getPointDepartArriveeAttribute()
    {
        if ($this->point_depart === $this->point_arrivee) {
            return $this->point_depart;
        }
        return ($this->point_depart ?? 'À définir') . ' → ' . ($this->point_arrivee ?? 'À définir');
    }

    public function getServicesFormatesAttribute()
    {
        if (!$this->services_inclus) return '';
        return implode(', ', $this->services_inclus);
    }

    public function getEquipementsObligatoiresFormatesAttribute()
    {
        if (!$this->equipements_obligatoires) return '';
        return implode(', ', $this->equipements_obligatoires);
    }

    public function getSaisonsDisponiblesFormateesAttribute()
    {
        if (!$this->saisons_disponibles) return 'Toute l\'année';
        
        $mois = [
            1 => 'Jan', 2 => 'Fév', 3 => 'Mar', 4 => 'Avr', 5 => 'Mai', 6 => 'Juin',
            7 => 'Juil', 8 => 'Août', 9 => 'Sep', 10 => 'Oct', 11 => 'Nov', 12 => 'Déc'
        ];
        
        $disponibles = [];
        foreach ($this->saisons_disponibles as $moisNum) {
            $disponibles[] = $mois[$moisNum] ?? $moisNum;
        }
        
        return implode(', ', $disponibles);
    }

    public function getPrixPersonneFormateAttribute()
    {
        if (!$this->prix_par_personne) return $this->getPrixBaseFormateAttribute();
        return number_format($this->prix_par_personne, 0, ',', ' ') . ' FCFA';
    }

    public function getSupplementChambreFormateAttribute()
    {
        if (!$this->supplement_chambre_individuelle) return null;
        return number_format($this->supplement_chambre_individuelle, 0, ',', ' ') . ' FCFA';
    }

    public function getDelaiReservationFormateAttribute()
    {
        if ($this->delai_reservation_min <= 1) {
            return 'Réservation possible jusqu\'à la veille';
        }
        return 'Réservation ' . $this->delai_reservation_min . ' jours à l\'avance minimum';
    }

    public function getNoteMoyenneFormatteeAttribute()
    {
        if ($this->note_moyenne <= 0) return 'Nouveau circuit';
        return number_format($this->note_moyenne, 1) . '/5 (' . $this->nombre_avis . ' avis)';
    }

    // ========== MÉTHODES UTILES POUR CIRCUITS ==========
    
    public function estDisponibleMois($mois)
    {
        if (!$this->saisons_disponibles) return true;
        return in_array($mois, $this->saisons_disponibles);
    }

    public function estDisponibleMaintenant()
    {
        return $this->estDisponibleMois(now()->month);
    }

    public function hasSupplements()
    {
        return !empty($this->supplements) && count($this->supplements) > 0;
    }

    public function hasReductions()
    {
        return !empty($this->reductions) && count($this->reductions) > 0;
    }

    public function calculerPrixAvecSupplement($supplementKey)
    {
        if (!$this->hasSupplements() || !isset($this->supplements[$supplementKey])) {
            return $this->prix_par_personne ?? $this->prix_base;
        }
        return ($this->prix_par_personne ?? $this->prix_base) + $this->supplements[$supplementKey];
    }

    public function calculerPrixAvecReduction($reductionKey)
    {
        if (!$this->hasReductions() || !isset($this->reductions[$reductionKey])) {
            return $this->prix_par_personne ?? $this->prix_base;
        }
        
        $prixBase = $this->prix_par_personne ?? $this->prix_base;
        $reduction = $this->reductions[$reductionKey];
        
        // Si c'est un pourcentage
        if ($reduction < 100) {
            return $prixBase * (1 - $reduction / 100);
        }
        
        // Si c'est un montant fixe
        return max(0, $prixBase - $reduction);
    }

    public function estNouveau()
    {
        return $this->nouveau || $this->created_at > now()->subMonths(3);
    }

    public function estRecommande()
    {
        return $this->recommande || $this->note_moyenne >= 4.5;
    }

    public function getBadgesAttribute()
    {
        $badges = [];
        
        if ($this->estNouveau()) $badges[] = 'nouveau';
        if ($this->estRecommande()) $badges[] = 'recommande';
        if ($this->sur_mesure) $badges[] = 'sur-mesure';
        if ($this->note_moyenne >= 4.5) $badges[] = 'excellent';
        
        return $badges;
    }
}