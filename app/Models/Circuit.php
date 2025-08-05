<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Circuit extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom', 'date_debut', 'date_fin', 'nb_jours', 
        'description', 'statut', 'participants', 'guide_principal'
    ];

    protected $casts = [
        'date_debut' => 'date',
        'date_fin' => 'date',
        'participants' => 'array'
    ];

    public function programmeJournaliers()
    {
        return $this->hasMany(ProgrammeJournalier::class);
    }

    public function getProgrammeAujourdhui()
    {
        return $this->programmeJournaliers()
                   ->where('date', Carbon::today())
                   ->first();
    }

    public function getJourActuel()
    {
        $debut = Carbon::parse($this->date_debut);
        $aujourd_hui = Carbon::today();
        
        if ($aujourd_hui->lt($debut)) return 0;
        
        return $debut->diffInDays($aujourd_hui) + 1;
    }
}