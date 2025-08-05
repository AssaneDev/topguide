<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgrammeJournalier extends Model
{
    protected $fillable = [
        'circuit_id', 'jour_numero', 'date', 'lieu_principal',
        'activites', 'hebergement', 'horaires', 'notes_speciales'
    ];

    protected $casts = [
        'date' => 'date',
        'horaires' => 'array'
    ];

    public function circuit()
    {
        return $this->belongsTo(Circuit::class);
    }

    public function consignesCommunication()
    {
        return $this->hasMany(ConsigneCommunication::class);
    }

    public function getConsignesPhotographe()
    {
        return $this->consignesCommunication()
                   ->where('type_equipe', 'photographe')
                   ->first();
    }

    public function getConsignesGestionnaire()
    {
        return $this->consignesCommunication()
                   ->where('type_equipe', 'gestionnaire_posts')
                   ->first();
    }
}
