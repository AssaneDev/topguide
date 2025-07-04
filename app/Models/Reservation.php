<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
    'name',
    'email',
    'phone',
    'date',
    'ville',
    'duree',
    'langue',
    'nbJours',
    'interets',
    'details',
    'prix_final', // ✅ Ajouté ici
    'itineraire',
    'nb_personnes',
];

}
