<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
// ➕ Import du trait Spatie
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'phone',
        'address',
        'date_naissance',
        'preferences_voyage',
        'derniere_connexion',
        'score_engagement',
        'notifications_email',
        'notifications_sms',
        'langue_preferee',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'date_naissance' => 'date',
            'preferences_voyage' => 'array',
            'derniere_connexion' => 'datetime',
            'notifications_email' => 'boolean',
            'notifications_sms' => 'boolean',
        ];
    }

    // ============= MÉTHODES UTILITAIRES POUR VÉRIFIER LES COLONNES =============
    
    private function hasColumn($table, $column)
    {
        try {
            return Schema::hasColumn($table, $column);
        } catch (\Exception $e) {
            // Fallback: vérifier dans la base directement
            try {
                $columns = DB::getSchemaBuilder()->getColumnListing($table);
                return in_array($column, $columns);
            } catch (\Exception $e2) {
                return false;
            }
        }
    }
    
    private function hasTable($table)
    {
        try {
            return Schema::hasTable($table);
        } catch (\Exception $e) {
            // Fallback
            try {
                DB::table($table)->limit(1)->get();
                return true;
            } catch (\Exception $e2) {
                return false;
            }
        }
    }

    // ============= MÉTHODES POUR LES RÔLES =============
    
    public function hasRole($role)
    {
        // Vérifier d'abord si la colonne existe
        if (!$this->hasColumn('users', 'role')) {
            return $role === 'user'; // Par défaut, considérer comme user
        }
        return $this->role === $role;
    }

    public function isAdmin()
    {
        return $this->hasRole('admin');
    }

    public function isGuide()
    {
        return $this->hasRole('guide');
    }

    public function isUser()
    {
        return $this->hasRole('user') || !$this->role;
    }

    // ============= RELATIONS CONDITIONNELLES =============
    
    public function voyageConsultations()
    {
        // Vérifier si la table existe avant de créer la relation
        if ($this->hasTable('voyage_consultations')) {
            return $this->hasMany(\App\Models\VoyageConsultation::class);
        }
        // Retourner une relation vide
        return $this->hasMany(\App\Models\User::class, 'non_existent_id', 'non_existent_id');
    }

    public function favorites()
    {
        if ($this->hasTable('user_favorites')) {
            return $this->hasMany(\App\Models\UserFavorite::class);
        }
        return $this->hasMany(\App\Models\User::class, 'non_existent_id', 'non_existent_id');
    }

    public function voyagesFavoris()
    {
        if ($this->hasTable('user_favorites')) {
            return $this->belongsToMany(\App\Models\Voyage::class, 'user_favorites')
                       ->withPivot(['priorite', 'note_personnelle', 'date_voyage_souhaitee'])
                       ->withTimestamps();
        }
        return $this->belongsToMany(\App\Models\Voyage::class, 'non_existent_table');
    }

    // ============= ACCESSEURS =============
    
    public function getRoleLabelAttribute()
    {
        if (!$this->hasColumn('users', 'role') || !$this->role) {
            return 'Utilisateur';
        }

        $labels = [
            'user' => 'Utilisateur',
            'admin' => 'Administrateur', 
            'guide' => 'Guide'
        ];
        
        return $labels[$this->role] ?? $this->role;
    }

    public function getPreferencesFormateesAttribute()
    {
        if (!$this->hasColumn('users', 'preferences_voyage') || !$this->preferences_voyage) {
            return 'Aucune préférence définie';
        }
        return implode(', ', $this->preferences_voyage);
    }

    public function getAgeAttribute()
    {
        if (!$this->hasColumn('users', 'date_naissance') || !$this->date_naissance) {
            return null;
        }
        return $this->date_naissance->age;
    }

    public function getDateNaissanceFormatteeAttribute()
    {
        if (!$this->hasColumn('users', 'date_naissance') || !$this->date_naissance) {
            return null;
        }
        return $this->date_naissance->format('d/m/Y');
    }

    public function getLastLoginFormatteeAttribute()
    {
        if (!$this->hasColumn('users', 'derniere_connexion') || !$this->derniere_connexion) {
            return 'Jamais connecté';
        }
        return $this->derniere_connexion->diffForHumans();
    }

    // ============= MÉTHODES UTILES =============
    
    public function updateLastLogin()
    {
        if ($this->hasColumn('users', 'derniere_connexion')) {
            $this->update([
                'derniere_connexion' => now(),
            ]);
        }
    }

    public function hasConsultedVoyage($voyageId)
    {
        if (!$this->hasTable('voyage_consultations')) {
            return false;
        }
        
        try {
            return $this->voyageConsultations()
                       ->where('voyage_id', $voyageId)
                       ->exists();
        } catch (\Exception $e) {
            return false;
        }
    }

    public function hasFavoriteVoyage($voyageId)
    {
        if (!$this->hasTable('user_favorites')) {
            return false;
        }
        
        try {
            return $this->favorites()
                       ->where('voyage_id', $voyageId)
                       ->exists();
        } catch (\Exception $e) {
            return false;
        }
    }

    public function getVoyagesConsultesCount()
    {
        if (!$this->hasTable('voyage_consultations')) {
            return 0;
        }
        
        try {
            return $this->voyageConsultations()
                       ->distinct('voyage_id')
                       ->count();
        } catch (\Exception $e) {
            return 0;
        }
    }

    public function getFavoriteVoyagesCount()
    {
        if (!$this->hasTable('user_favorites')) {
            return 0;
        }
        
        try {
            return $this->favorites()->count();
        } catch (\Exception $e) {
            return 0;
        }
    }

    // ============= MÉTHODES SPÉCIFIQUES POUR LA MIGRATION =============
    
    public function hasCompleteProfile()
    {
        $requiredColumns = ['phone', 'address', 'date_naissance'];
        
        foreach ($requiredColumns as $column) {
            if ($this->hasColumn('users', $column) && !$this->$column) {
                return false;
            }
        }
        
        return true;
    }

    public function getMissingProfileFields()
    {
        $fields = [];
        
        if ($this->hasColumn('users', 'phone') && !$this->phone) {
            $fields[] = 'phone';
        }
        
        if ($this->hasColumn('users', 'address') && !$this->address) {
            $fields[] = 'address';
        }
        
        if ($this->hasColumn('users', 'date_naissance') && !$this->date_naissance) {
            $fields[] = 'date_naissance';
        }
        
        return $fields;
    }
}