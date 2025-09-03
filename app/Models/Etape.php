<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Etape extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'activites_jour' => 'array',
        'heure_debut' => 'datetime:H:i',
        'heure_fin' => 'datetime:H:i',
        'caracteristiques_hebergement' => 'array',
        'heure_reveil' => 'datetime:H:i',
        'heure_petit_dejeuner' => 'datetime:H:i',
        'heure_dejeuner' => 'datetime:H:i',
        'heure_diner' => 'datetime:H:i',
        'lieux_visites' => 'array',
        'distance_km' => 'decimal:2',
        'repas_details' => 'array',
        'specialites_locales' => 'array',
        'galerie_jour' => 'array',
        'contacts_utiles' => 'array',
        'jour_libre' => 'boolean',
    ];

    // Relation avec Voyage
    public function voyage()
    {
        return $this->belongsTo(Voyage::class);
    }

    // Accesseurs
    public function getActivitesFormateesAttribute()
    {
        if (!$this->activites_jour) return '';
        return implode(', ', $this->activites_jour);
    }

    public function getDureeEtapeAttribute()
    {
        if (!$this->heure_debut || !$this->heure_fin) return null;
        
        $debut = \Carbon\Carbon::parse($this->heure_debut);
        $fin = \Carbon\Carbon::parse($this->heure_fin);
        
        return $debut->diffInHours($fin);
    }

    public function getHeuresFormateesAttribute()
    {
        if (!$this->heure_debut) return '';
        
        $debut = \Carbon\Carbon::parse($this->heure_debut)->format('H:i');
        $fin = $this->heure_fin ? \Carbon\Carbon::parse($this->heure_fin)->format('H:i') : '';
        
        return $fin ? "$debut - $fin" : $debut;
    }
}