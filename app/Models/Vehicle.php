<?php
// app/Models/Vehicle.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'capacity',
        'price_per_km',
        'base_price',
        'image',
        'is_available',
        'description'
    ];

    protected $casts = [
        'is_available' => 'boolean',
        'price_per_km' => 'decimal:2',
        'base_price' => 'decimal:2',
    ];

    // Vérifier si le véhicule est disponible
    public function isAvailable()
    {
        return $this->is_available;
    }

    // Calculer le prix pour une distance donnée
    public function calculatePrice($distance)
    {
        return $this->base_price + ($distance * $this->price_per_km);
    }

    // Obtenir l'emoji du type de véhicule
    public function getTypeEmojiAttribute()
    {
        $emojis = [
            'sedan' => '🚗',
            'suv' => '🚙',
            'van' => '🚐',
            'minibus' => '🚌'
        ];

        return $emojis[$this->type] ?? '🚗';
    }
}