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

    // Relation avec les réservations
    public function bookings()
    {
        return $this->hasMany(ShuttleBooking::class);
    }

    // Vérifier si le véhicule est disponible à une date donnée
    public function isAvailableAt($datetime)
    {
        if (!$this->is_available) {
            return false;
        }

        // Vérifier s'il n'y a pas de réservation confirmée à cette heure
        return !$this->bookings()
            ->where('pickup_datetime', '<=', $datetime)
            ->where('pickup_datetime', '>=', now()->subHours(4)) // Marge de 4h
            ->whereIn('status', ['confirmed', 'paid'])
            ->exists();
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