<?php
// app/Http/Controllers/ShuttleController.php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\ShuttleBooking;
use Illuminate\Http\Request;

class ShuttleController extends Controller
{
    // Page d'accueil avec formulaire de réservation
    public function index()
    {
        $vehicles = Vehicle::where('is_available', true)->get();
        return view('shuttle.index', compact('vehicles'));
    }

    // Traiter la réservation
    public function book(Request $request)
    {
        // Validation des données
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email',
            'customer_phone' => 'required|string|max:20',
            'passenger_count' => 'required|integer|min:1|max:20',
            'vehicle_id' => 'required|exists:vehicles,id',
            'pickup_location' => 'required|string|max:255',
            'destination' => 'required|string|max:255',
            'pickup_datetime' => 'required|date|after:now',
            'special_requests' => 'nullable|string|max:500',
        ]);

        // Récupérer le véhicule sélectionné
        $vehicle = Vehicle::findOrFail($validated['vehicle_id']);
        
        // Vérifier la disponibilité
        if (!$vehicle->isAvailableAt($validated['pickup_datetime'])) {
            return back()->with('error', 'Ce véhicule n\'est pas disponible à cette heure.')
                        ->withInput();
        }

        // Calculer le prix (distance estimée de 25km pour l'instant)
        $estimatedDistance = 25; // km - On améliorera ça plus tard avec Google Maps
        $totalPrice = $vehicle->calculatePrice($estimatedDistance);

        // Créer la réservation
        $booking = ShuttleBooking::create([
            'customer_name' => $validated['customer_name'],
            'customer_email' => $validated['customer_email'],
            'customer_phone' => $validated['customer_phone'],
            'passenger_count' => $validated['passenger_count'],
            'vehicle_id' => $validated['vehicle_id'],
            'pickup_location' => $validated['pickup_location'],
            'destination' => $validated['destination'],
            'pickup_datetime' => $validated['pickup_datetime'],
            'special_requests' => $validated['special_requests'],
            'total_price' => $totalPrice,
        ]);

        // Rediriger vers la page de succès
        return redirect()->route('shuttle.success')
                        ->with('booking_reference', $booking->booking_reference);
    }

    // Page de succès après réservation
    public function success()
    {
        if (!session('booking_reference')) {
            return redirect()->route('shuttle.index');
        }

        return view('shuttle.success');
    }

    // Page de détails d'une réservation
    public function bookingDetails($bookingReference)
    {
        $booking = ShuttleBooking::with('vehicle')
                                ->where('booking_reference', $bookingReference)
                                ->firstOrFail();

        return view('shuttle.booking-details', compact('booking'));
    }
}