<?php
// app/Http/Controllers/Admin/ShuttleBookingController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ShuttleBooking;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class ShuttleBookingController extends Controller
{
    // Liste des réservations
    public function index(Request $request)
    {
        $query = ShuttleBooking::with(['vehicle'])
                              ->latest();

        // Filtres
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('date')) {
            $query->whereDate('pickup_datetime', $request->date);
        }

        if ($request->filled('vehicle_id')) {
            $query->where('vehicle_id', $request->vehicle_id);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('booking_reference', 'like', "%{$search}%")
                  ->orWhere('customer_name', 'like', "%{$search}%")
                  ->orWhere('customer_email', 'like', "%{$search}%")
                  ->orWhere('customer_phone', 'like', "%{$search}%");
            });
        }

        $bookings = $query->paginate(20);
        $vehicles = Vehicle::all();

        // Stats pour le dashboard
        $stats = [
            'total' => ShuttleBooking::count(),
            'pending' => ShuttleBooking::where('status', 'pending')->count(),
            'confirmed' => ShuttleBooking::where('status', 'confirmed')->count(),
            'paid' => ShuttleBooking::where('status', 'paid')->count(),
            'today_revenue' => ShuttleBooking::whereDate('created_at', today())
                                           ->where('payment_status', 'paid')
                                           ->sum('total_price'),
        ];

        return view('admin.shuttle.bookings.index', compact('bookings', 'vehicles', 'stats'));
    }

    // Voir une réservation
    public function show(ShuttleBooking $shuttleBooking)
    {
        $shuttleBooking->load('vehicle');
        return view('admin.shuttle.bookings.show', compact('shuttleBooking'));
    }

    // Confirmer une réservation
    public function confirm(ShuttleBooking $shuttleBooking)
    {
        if ($shuttleBooking->status !== 'pending') {
            return back()->with('error', 'Cette réservation ne peut pas être confirmée.');
        }

        // Vérifier la disponibilité du véhicule
        if (!$shuttleBooking->vehicle->isAvailableAt($shuttleBooking->pickup_datetime)) {
            return back()->with('error', 'Le véhicule n\'est plus disponible à cette heure.');
        }

        $shuttleBooking->update([
            'status' => 'confirmed',
            'confirmed_at' => now(),
        ]);

        // TODO: Envoyer email de confirmation
        
        return back()->with('success', 'Réservation confirmée avec succès !');
    }

    // Annuler une réservation
    public function cancel(ShuttleBooking $shuttleBooking)
    {
        if (in_array($shuttleBooking->status, ['completed', 'cancelled'])) {
            return back()->with('error', 'Cette réservation ne peut pas être annulée.');
        }

        $shuttleBooking->update([
            'status' => 'cancelled'
        ]);

        return back()->with('success', 'Réservation annulée avec succès.');
    }

    // Marquer comme payé
    public function markPaid(ShuttleBooking $shuttleBooking)
    {
        if ($shuttleBooking->payment_status === 'paid') {
            return back()->with('error', 'Cette réservation est déjà payée.');
        }

        $shuttleBooking->update([
            'payment_status' => 'paid',
            'status' => 'paid',
            'paid_at' => now(),
        ]);

        return back()->with('success', 'Paiement marqué comme reçu.');
    }

    // Marquer comme terminé
    public function complete(ShuttleBooking $shuttleBooking)
    {
        if ($shuttleBooking->status !== 'paid') {
            return back()->with('error', 'La réservation doit être payée avant d\'être marquée comme terminée.');
        }

        $shuttleBooking->update([
            'status' => 'completed'
        ]);

        return back()->with('success', 'Réservation marquée comme terminée.');
    }
}