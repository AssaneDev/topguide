<?php
// app/Models/HebergementCommentaire.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class HebergementCommentaire extends Model
{
    use HasFactory;

    protected $fillable = [
        'hebergement_id',
        'nom_client',
        'email_client',
        'commentaire',
        'note_client',
        'statut',
        'ip_client'
    ];

    protected $casts = [
        'note_client' => 'integer',
    ];

    // Relations
    public function hebergement()
    {
        return $this->belongsTo(Hebergement::class);
    }

    // Accessors
    public function getDateFormateeAttribute()
    {
        return $this->created_at->format('d/m/Y');
    }

    public function getTempsEcouleAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    public function getNoteEtoilesAttribute()
    {
        $etoiles = '';
        for ($i = 1; $i <= 5; $i++) {
            $etoiles .= $i <= $this->note_client ? '★' : '☆';
        }
        return $etoiles;
    }

    // Scopes
    public function scopeApprouves($query)
    {
        return $query->where('statut', 'approuve');
    }

    public function scopeEnAttente($query)
    {
        return $query->where('statut', 'en_attente');
    }

    public function scopeRejetes($query)
    {
        return $query->where('statut', 'rejete');
    }

    public function scopeRecents($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    // Méthodes
    public function approuver()
    {
        $this->update(['statut' => 'approuve']);
    }

    public function rejeter()
    {
        $this->update(['statut' => 'rejete']);
    }

    public function estApprouve()
    {
        return $this->statut === 'approuve';
    }

    public function estEnAttente()
    {
        return $this->statut === 'en_attente';
    }

    public function estRejete()
    {
        return $this->statut === 'rejete';
    }
}