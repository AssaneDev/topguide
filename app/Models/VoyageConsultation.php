<?php

/*
|--------------------------------------------------------------------------
| Model VoyageConsultation
|--------------------------------------------------------------------------
*/

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VoyageConsultation extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'etapes_consultees' => 'array',
    ];

    // Relations
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function voyage()
    {
        return $this->belongsTo(Voyage::class);
    }

    // Scopes
    public function scopeRecent($query, $days = 30)
    {
        return $query->where('created_at', '>=', now()->subDays($days));
    }

    public function scopeForType($query, $type)
    {
        return $query->where('type', $type);
    }

    public function scopeForVoyage($query, $voyageId)
    {
        return $query->where('voyage_id', $voyageId);
    }

    // Accesseurs
    public function getTypeLabelAttribute()
    {
        $labels = [
            'detail' => 'Page détail',
            'programme' => 'Programme', 
            'programme_complet' => 'Programme complet',
            'galerie' => 'Galerie',
            'reservation' => 'Réservation',
            'etape_specifique' => 'Étape spécifique'
        ];
        
        return $labels[$this->type] ?? $this->type;
    }

    public function getTempsConsultationFormateAttribute()
    {
        if (!$this->temps_consultation_secondes) return null;
        
        $minutes = floor($this->temps_consultation_secondes / 60);
        $secondes = $this->temps_consultation_secondes % 60;
        
        if ($minutes > 0) {
            return "{$minutes}min {$secondes}s";
        }
        return "{$secondes}s";
    }

    // Méthodes utiles
    public function hasViewedEtape($numeroJour)
    {
        return in_array($numeroJour, $this->etapes_consultees ?? []);
    }

    public function addEtapeViewed($numeroJour)
    {
        $etapes = $this->etapes_consultees ?? [];
        if (!in_array($numeroJour, $etapes)) {
            $etapes[] = $numeroJour;
            $this->update(['etapes_consultees' => $etapes]);
        }
    }
}

/*
|--------------------------------------------------------------------------
| Model UserFavorite  
|--------------------------------------------------------------------------
*/

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserFavorite extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'date_voyage_souhaitee' => 'date',
        'notification_prix' => 'boolean',
        'notification_disponibilite' => 'boolean',
    ];

    // Relations
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function voyage()
    {
        return $this->belongsTo(Voyage::class);
    }

    // Scopes
    public function scopeHighPriority($query)
    {
        return $query->where('priorite', '>=', 4);
    }

    public function scopeWithNotifications($query)
    {
        return $query->where(function($q) {
            $q->where('notification_prix', true)
              ->orWhere('notification_disponibilite', true);
        });
    }

    public function scopeForUpcomingTrips($query)
    {
        return $query->whereNotNull('date_voyage_souhaitee')
                    ->where('date_voyage_souhaitee', '>=', now());
    }

    // Accesseurs
    public function getPrioriteLabelAttribute()
    {
        $labels = [
            1 => 'Faible',
            2 => 'Basse', 
            3 => 'Moyenne',
            4 => 'Haute',
            5 => 'Très haute'
        ];
        
        return $labels[$this->priorite] ?? 'Non définie';
    }

    public function getPrioriteColorAttribute()
    {
        $colors = [
            1 => 'secondary',
            2 => 'info',
            3 => 'warning', 
            4 => 'primary',
            5 => 'danger'
        ];
        
        return $colors[$this->priorite] ?? 'secondary';
    }

    public function getDateSouhaiteeFormatteeAttribute()
    {
        if (!$this->date_voyage_souhaitee) return 'Non définie';
        
        return $this->date_voyage_souhaitee->format('d/m/Y');
    }

    public function getDateSouhaiteeRelativeAttribute()
    {
        if (!$this->date_voyage_souhaitee) return null;
        
        return $this->date_voyage_souhaitee->diffForHumans();
    }

    // Méthodes utiles
    public function isHighPriority()
    {
        return $this->priorite >= 4;
    }

    public function hasUpcomingDate()
    {
        return $this->date_voyage_souhaitee && $this->date_voyage_souhaitee >= now();
    }

    public function wantsNotifications()
    {
        return $this->notification_prix || $this->notification_disponibilite;
    }

    public function updatePriority($newPriority)
    {
        $this->update(['priorite' => max(1, min(5, $newPriority))]);
    }

    public function addNote($note)
    {
        $this->update(['note_personnelle' => $note]);
    }
}