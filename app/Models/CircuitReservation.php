<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CircuitReservation extends Model
{
    use HasFactory;
    protected $fillable = [
    'nom', 'email', 'tel', 'destination', 'nbr_Pax', 'message', 'offre', 'confirmed_at'
    ];

}
