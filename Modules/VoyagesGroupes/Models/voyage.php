<?php
// modules/VoyagesGroupes/Models/Voyage.php
namespace Modules\VoyagesGroupes\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Voyage extends Model
{
    protected $fillable = ['destination', 'date_depart', 'date_retour', 'description'];

    public function interets() {
        return $this->belongsToMany(User::class, 'interets_voyage');
    }

    public function inscriptions() {
        return $this->belongsToMany(User::class, 'inscriptions_voyage');
    }
}
