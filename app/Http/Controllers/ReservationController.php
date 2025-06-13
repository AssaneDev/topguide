<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Mail\ReservationConfirmationMail;
use Illuminate\Support\Facades\Mail;

class ReservationController extends Controller
{
    public function create()
    {
        return view('reservation.form');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'       => 'required|string|max:255',
            'email'      => 'required|email',
            'phone'      => 'required',
            'date'       => 'required|date',
            'ville'      => 'required|string|max:255',
            'duree'      => 'required|in:journee,circuit',
            'langue'     => 'required|in:fr,en,it,es',
            'nbJours'    => 'nullable|integer|min:2',
            'interets'   => 'nullable|string|max:1000',
            'details'    => 'nullable|string|max:2000',
            'prix'       => 'required|numeric',
            'itineraire' => 'nullable|file|mimes:pdf|max:2048',
        ]);

        if ($request->hasFile('itineraire')) {
            $validated['itineraire'] = $request->file('itineraire')->store('itineraire', 'public');
        }

        $reservation = Reservation::create($validated);

        // Envoi email de confirmation
        Mail::to($validated['email'])->send(new ReservationConfirmationMail($reservation));

        return redirect()->back()->with('success', 'Réservation envoyée avec succès.');
    }

    public function confirmation($id)
        {
            $reservation = Reservation::findOrFail($id);
            return view('confirmation-programme', compact('reservation'));
        }
}
