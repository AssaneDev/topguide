<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Galerie extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Relations existantes
    public function voyage()
    {
        return $this->belongsTo(Voyage::class);
    }

    public function activite()
    {
        return $this->belongsTo(Activite::class);
    }

    // ✅ NOUVELLE RELATION avec Etape (via numero_jour)
    public function etape()
    {
        return $this->voyage->etapes()->where('numero_jour', $this->numero_jour)->first();
    }

    // Scopes existants
    public function scopeGalerieGenerale($query)
    {
        return $query->where('type_image', 'galerie');
    }

    public function scopeEtapeSpecifique($query)
    {
        return $query->where('type_image', 'etape_specifique');
    }

    public function scopeActiviteSpecifique($query)
    {
        return $query->where('type_image', 'activite');
    }

    // ✅ NOUVEAUX SCOPES
    public function scopeOrdered($query)
    {
        return $query->orderBy('ordre_affichage');
    }

    public function scopeForEtape($query, $numeroJour)
    {
        return $query->where('type_image', 'etape_specifique')
                    ->where('numero_jour', $numeroJour);
    }

    public function scopeForActivite($query, $activiteId)
    {
        return $query->where('type_image', 'activite')
                    ->where('activite_id', $activiteId);
    }

    public function scopeVisible($query)
    {
        return $query->where(function($q) {
            // Supposer que toutes les images sont visibles par défaut
            // Vous pouvez ajouter une colonne 'visible' si nécessaire
        });
    }

    // Accesseur existant
    public function getUrlImageAttribute()
    {
        return asset($this->chemin_image);
    }

    // ✅ NOUVEAUX ACCESSEURS
    public function getAltTextAttribute()
    {
        return $this->alt_image ?? 'Photo du voyage ' . $this->voyage->nom_voyage;
    }

    public function getThumbnailUrlAttribute()
    {
        // Pour générer des miniatures, vous pourriez utiliser Intervention Image
        // Pour l'instant, on retourne l'image originale
        return $this->url_image;
    }

    public function getTypeImageLabelAttribute()
    {
        $labels = [
            'galerie' => 'Galerie générale',
            'etape_specifique' => 'Étape spécifique', 
            'activite' => 'Activité'
        ];
        
        return $labels[$this->type_image] ?? $this->type_image;
    }

    public function getContexteAttribute()
    {
        switch ($this->type_image) {
            case 'etape_specifique':
                return $this->numero_jour ? "Jour {$this->numero_jour}" : 'Étape non définie';
            case 'activite':
                return $this->activite ? $this->activite->nom_activite : 'Activité non définie';
            default:
                return 'Galerie générale';
        }
    }

    // ✅ NOUVELLES MÉTHODES UTILES
    public function imageExists()
    {
        return file_exists(public_path($this->chemin_image));
    }

    public function getImageSize()
    {
        if (!$this->imageExists()) {
            return null;
        }

        $imagePath = public_path($this->chemin_image);
        return filesize($imagePath);
    }

    public function getImageDimensions()
    {
        if (!$this->imageExists()) {
            return null;
        }

        $imagePath = public_path($this->chemin_image);
        $imageInfo = getimagesize($imagePath);
        
        return [
            'width' => $imageInfo[0] ?? null,
            'height' => $imageInfo[1] ?? null,
            'type' => $imageInfo['mime'] ?? null
        ];
    }

    public function getImageInfo()
    {
        $dimensions = $this->getImageDimensions();
        $size = $this->getImageSize();
        
        return [
            'url' => $this->url_image,
            'alt' => $this->alt_text,
            'dimensions' => $dimensions,
            'size' => $size ? round($size / 1024, 2) . ' KB' : null,
            'exists' => $this->imageExists()
        ];
    }

    // ✅ MÉTHODES DE VÉRIFICATION
    public function isGeneralGallery()
    {
        return $this->type_image === 'galerie';
    }

    public function isEtapeSpecific()
    {
        return $this->type_image === 'etape_specifique';
    }

    public function isActivitySpecific()
    {
        return $this->type_image === 'activite';
    }

    public function belongsToEtape($numeroJour)
    {
        return $this->isEtapeSpecific() && $this->numero_jour == $numeroJour;
    }

    public function belongsToActivity($activiteId)
    {
        return $this->isActivitySpecific() && $this->activite_id == $activiteId;
    }

    // ✅ MÉTHODES POUR L'AFFICHAGE
    public function getDisplayTitle()
    {
        switch ($this->type_image) {
            case 'etape_specifique':
                return "Jour {$this->numero_jour} - " . ($this->etape()?->titre_etape ?? 'Étape');
            case 'activite':
                return $this->activite?->nom_activite ?? 'Activité';
            default:
                return $this->voyage->nom_voyage;
        }
    }

    public function getDisplayDescription()
    {
        switch ($this->type_image) {
            case 'etape_specifique':
                return $this->etape()?->description_etape ?? '';
            case 'activite':
                return $this->activite?->description_activite ?? '';
            default:
                return $this->voyage->description_courte;
        }
    }

    // ✅ SCOPE POUR LES IMAGES EN VEDETTE (ordre d'affichage faible = priorité haute)
    public function scopeFeatured($query, $limit = 6)
    {
        return $query->where('ordre_affichage', '<=', 10)
                    ->orderBy('ordre_affichage')
                    ->limit($limit);
    }
}