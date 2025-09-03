<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activite extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'equipements_requis' => 'array',
        'prix_activite' => 'decimal:2',
        'prix_enfant' => 'decimal:2',
        'prix_groupe' => 'decimal:2',
        'tarifs_speciaux' => 'array',
        'langues_disponibles' => 'array',
        'meilleures_periodes' => 'array',
        'annulation_gratuite' => 'boolean',
        'accessible_handicap' => 'boolean',
        'populaire' => 'boolean',
        'eco_responsable' => 'boolean',
        'experience_unique' => 'boolean',
        'note_activite' => 'decimal:2',
        'heure_debut_activite' => 'datetime:H:i',
        'heure_fin_activite' => 'datetime:H:i',
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
    ];

    // Relations existantes
    public function voyage()
    {
        return $this->belongsTo(Voyage::class);
    }

    public function galeries()
    {
        return $this->hasMany(Galerie::class);
    }

    // Scopes existants
    public function scopeIncluses($query)
    {
        return $query->where('type_activite', 'incluse');
    }

    public function scopeOptionnelles($query)
    {
        return $query->where('type_activite', 'optionnelle');
    }

    // ✅ NOUVEAUX SCOPES
    public function scopeForDay($query, $jour)
    {
        return $query->where('jour_recommande', $jour);
    }

    public function scopeWithImages($query)
    {
        return $query->whereNotNull('image_activite');
    }

    public function scopeActive($query)
    {
        return $query->where('prix_activite', '>=', 0); // Considérer comme actif si prix >= 0
    }

    // Accesseurs existants
    public function getEquipementsFormatesAttribute()
    {
        if (!$this->equipements_requis) return '';
        return implode(', ', $this->equipements_requis);
    }

    public function getTypeActiviteLabelAttribute()
    {
        return $this->type_activite === 'incluse' ? 'Incluse' : 'Optionnelle';
    }

    public function getDureeFormatteeAttribute()
    {
        if (!$this->duree_heures) return '';
        return $this->duree_heures . 'h';
    }

    public function getPrixFormateAttribute()
    {
        return number_format($this->prix_activite, 0, ',', ' ') . ' FCFA';
    }

    // Accesseurs EUR existants
    public function getPrixEurAttribute()
    {
        return \App\Helpers\CurrencyHelper::fcfaToEur($this->prix_activite);
    }

    public function getPrixEurFormateAttribute()
    {
        return \App\Helpers\CurrencyHelper::formatEur($this->prix_activite);
    }

    public function getPrixCompletFormateAttribute()
    {
        return \App\Helpers\CurrencyHelper::formatBothCurrencies($this->prix_activite);
    }

    // ✅ NOUVEAUX ACCESSEURS POUR L'IMAGE
    public function getImageUrlAttribute()
    {
        if (!$this->image_activite) {
            return asset('assets/img/default-activity.jpg'); // Image par défaut
        }
        return asset($this->image_activite);
    }

    public function getImageAltAttribute()
    {
        return "Image de l'activité : " . $this->nom_activite;
    }

    // ✅ NOUVEAUX ACCESSEURS POUR LA PLANIFICATION
    public function getJourFormateAttribute()
    {
        if (!$this->jour_recommande) return 'À déterminer';
        return 'Jour ' . $this->jour_recommande;
    }

    public function getEstGratuiteAttribute()
    {
        return $this->prix_activite == 0;
    }

    public function getEstPayanteAttribute()
    {
        return $this->prix_activite > 0;
    }

    // ✅ NOUVELLES MÉTHODES UTILES
    public function hasImage()
    {
        return !empty($this->image_activite) && file_exists(public_path($this->image_activite));
    }

    public function isForDay($jour)
    {
        return $this->jour_recommande == $jour;
    }

    public function isIncluded()
    {
        return $this->type_activite === 'incluse';
    }

    public function isOptional()
    {
        return $this->type_activite === 'optionnelle';
    }

    public function hasEquipments()
    {
        return !empty($this->equipements_requis) && count($this->equipements_requis) > 0;
    }

    // ✅ MÉTHODE POUR OBTENIR LES ÉQUIPEMENTS SOUS FORME DE BADGES
    public function getEquipementsBadges()
    {
        if (!$this->hasEquipments()) return '';
        
        $badges = '';
        foreach ($this->equipements_requis as $equipement) {
            $badges .= '<span class="badge bg-light text-dark me-1">' . ucfirst($equipement) . '</span>';
        }
        return $badges;
    }

    // ✅ MÉTHODE POUR OBTENIR LA COULEUR DU TYPE
    public function getTypeColorAttribute()
    {
        return $this->type_activite === 'incluse' ? 'success' : 'warning';
    }

    // ✅ MÉTHODE POUR OBTENIR L'ICÔNE DU TYPE
    public function getTypeIconAttribute()
    {
        return $this->type_activite === 'incluse' ? 'fas fa-check-circle' : 'fas fa-plus-circle';
    }
}