<?php
// app/Models/Hebergement.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Hebergement extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'slug',
        'description',
        'adresse',
        'latitude',
        'longitude',
        'region',
        'departement',
        'lieu_touristique',
        'tarif_min',
        'tarif_max',
        'devise',
        'site_web',
        'telephone',
        'email',
        'note_admin',
        'commentaire_admin',
        'statut',
        'images',
        'amenities',
        'badges',
        'ordre_affichage',
        'featured',
        'vues'
    ];

    protected $casts = [
        'images'      => 'array',
        'amenities'   => 'array',
        'badges'      => 'array',
        'featured'    => 'boolean',
        'latitude'    => 'decimal:8',
        'longitude'   => 'decimal:8',
        'tarif_min'   => 'decimal:2',
        'tarif_max'   => 'decimal:2',
    ];

    // Relations
    public function commentaires()
    {
        return $this->hasMany(HebergementCommentaire::class);
    }

    public function commentairesApprouves()
    {
        return $this->hasMany(HebergementCommentaire::class)->where('statut', 'approuve');
    }

    // Accessors
    public function getImagePrincipaleAttribute()
    {
        if ($this->images && count($this->images) > 0) {
            return $this->images[0];
        }
        return 'assets/img/hebergement-default.jpg';
    }

    public function getNoteClientMoyenneAttribute()
    {
        return $this->commentairesApprouves()->avg('note_client') ?? 0;
    }

    public function getNombreCommentairesAttribute()
    {
        return $this->commentairesApprouves()->count();
    }

    public function getTarifFormatAttribute()
    {
        if ($this->tarif_min && $this->tarif_max) {
            return number_format($this->tarif_min, 0, ',', ' ') . ' - ' .
                   number_format($this->tarif_max, 0, ',', ' ') . ' ' . $this->devise;
        } elseif ($this->tarif_min) {
            return 'À partir de ' . number_format($this->tarif_min, 0, ',', ' ') . ' ' . $this->devise;
        }
        return 'Tarif sur demande';
    }

    // Scopes
    public function scopeActif($query)
    {
        return $query->where('statut', 'actif');
    }

    public function scopeFeatured($query)
    {
        return $query->where('featured', true);
    }

    public function scopeParRegion($query, $region)
    {
        return $query->where('region', $region);
    }

    public function scopeParDepartement($query, $departement)
    {
        return $query->where('departement', $departement);
    }

    public function scopeAvecTarif($query, $min = null, $max = null)
    {
        if ($min !== null) {
            $query->where('tarif_min', '>=', $min);
        }
        if ($max !== null) {
            $query->where('tarif_max', '<=', $max);
        }
        return $query;
    }

    public function scopeAvecAmenity($query, $amenity)
    {
        return $query->whereJsonContains('amenities', $amenity);
    }

    // Méthodes utilitaires
    public function incrementVues()
    {
        $this->increment('vues');
    }

    public function hasAmenity($amenity)
    {
        return in_array($amenity, $this->amenities ?? []);
    }

    public function hasBadge($badge)
    {
        return in_array($badge, $this->badges ?? []);
    }

    public static function getRegions()
    {
        return self::distinct()->pluck('region')->filter()->sort()->values();
    }

    public static function getDepartements()
    {
        return self::distinct()->pluck('departement')->filter()->sort()->values();
    }

    public static function getAmenitiesDisponibles()
    {
        return [
            'wifi'           => 'WiFi Gratuit',
            'piscine'        => 'Piscine',
            'restaurant'     => 'Restaurant',
            'bar'            => 'Bar',
            'spa'            => 'Spa/Wellness',
            'gym'            => 'Salle de Sport',
            'parking'        => 'Parking Gratuit',
            'climatisation'  => 'Climatisation',
            'room_service'   => 'Service en Chambre',
            'animaux'        => 'Animaux Autorisés',
            'transfert'      => 'Transfert Aéroport',
            'excursions'     => 'Organisation Excursions',
        ];
    }

    // Utiliser le slug pour les routes
    public function getRouteKeyName()
    {
        return 'slug';
    }

    // Générer le slug automatiquement
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($hebergement) {
            if (empty($hebergement->slug)) {
                $hebergement->slug = Str::slug($hebergement->nom);

                // Vérifier l'unicité du slug
                $count = static::where('slug', 'like', $hebergement->slug . '%')->count();
                if ($count > 0) {
                    $hebergement->slug = $hebergement->slug . '-' . ($count + 1);
                }
            }
        });

        static::updating(function ($hebergement) {
            // On ne régénère le slug que si le nom a changé ET qu'aucun slug personnalisé n'a été défini
            if ($hebergement->isDirty('nom') && empty($hebergement->slug)) {
                $hebergement->slug = Str::slug($hebergement->nom);

                // Vérifier l'unicité du slug
                $count = static::where('slug', 'like', $hebergement->slug . '%')
                    ->where('id', '!=', $hebergement->id)
                    ->count();
                if ($count > 0) {
                    $hebergement->slug = $hebergement->slug . '-' . ($count + 1);
                }
            }
        });
    }

    public static function getBadgesDisponibles()
    {
        return [
            'eco_responsable'            => 'Éco-responsable',
            'vue_mer'                    => 'Vue sur Mer',
            'vue_lac'                    => 'Vue sur Lac',
            'centre_ville'               => 'Centre Ville',
            'plage_privee'               => 'Plage Privée',
            'petit_dejeuner'             => 'Petit-déjeuner Inclus',
            'tout_inclus'                => 'Tout Inclus',
            'nouveaute'                  => 'Nouveauté',
            'coup_de_coeur'              => 'Coup de Cœur',
            'bon_rapport_qualite_prix'   => 'Bon Rapport Qualité/Prix',
        ];
    }
}
