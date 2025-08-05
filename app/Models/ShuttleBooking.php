<?php
// app/Models/ShuttleBooking.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ShuttleBooking extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_reference',
        'customer_name',
        'customer_email',
        'customer_phone',
        'passenger_count',
        'vehicle_id',
        'pickup_location',
        'destination',
        'pickup_datetime',
        'total_price',
        'status',
        'payment_status',
        'payment_intent_id',
        'special_requests',
        'confirmed_at',
        'paid_at'
    ];

    protected $casts = [
        'pickup_datetime' => 'datetime',
        'confirmed_at' => 'datetime',
        'paid_at' => 'datetime',
        'total_price' => 'decimal:2',
    ];

    // Générer automatiquement une référence unique
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($booking) {
            if (empty($booking->booking_reference)) {
                $booking->booking_reference = 'SHT-' . strtoupper(\Illuminate\Support\Str::random(8));
            }
        });
    }

    // Relation avec le véhicule
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    // Générer un QR code pour la réservation
    public function generateQrCode()
    {
        $data = [
            'booking_ref' => $this->booking_reference,
            'customer' => $this->customer_name,
            'pickup' => $this->pickup_datetime->format('Y-m-d H:i'),
            'vehicle' => $this->vehicle->name ?? 'N/A'
        ];

        return base64_encode(json_encode($data));
    }

    // Obtenir le badge de statut avec couleur
    public function getStatusBadgeAttribute()
    {
        $badges = [
            'pending' => ['text' => 'En attente', 'color' => 'yellow'],
            'confirmed' => ['text' => 'Confirmé', 'color' => 'blue'],
            'paid' => ['text' => 'Payé', 'color' => 'green'],
            'completed' => ['text' => 'Terminé', 'color' => 'purple'],
            'cancelled' => ['text' => 'Annulé', 'color' => 'red'],
        ];

        return $badges[$this->status] ?? ['text' => 'Inconnu', 'color' => 'gray'];
    }

    // Vérifier si la réservation peut être annulée
    public function canBeCancelled()
    {
        return in_array($this->status, ['pending', 'confirmed']) 
               && $this->pickup_datetime->gt(now()->addHours(2));
    }

    // Vérifier si la réservation peut être payée
    public function canBePaid()
    {
        return $this->status === 'confirmed' && $this->payment_status === 'pending';
    }
}