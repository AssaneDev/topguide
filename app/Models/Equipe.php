<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Equipe extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom', 'email', 'telephone', 'role', 'token_acces', 
        'actif', 'derniere_connexion' // ✅ AJOUTER ce champ
    ];

    protected $casts = [
        'actif' => 'boolean',
        'derniere_connexion' => 'datetime' // ✅ AJOUTER ce cast
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($equipe) {
            $equipe->token_acces = Str::random(32);
        });
    }

    public function genererNouveauToken()
    {
        $this->token_acces = Str::random(32);
        $this->save();
        return $this->token_acces;
    }

    // ✅ AJOUTER cette méthode pour mettre à jour la dernière connexion
    public function mettreAJourConnexion()
    {
        $this->update(['derniere_connexion' => now()]);
    }
}