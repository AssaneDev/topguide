<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Mail\ReservationConfirmationMail;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReservationConfirmed;

class ReservationController extends Controller
{
    public function create()
    {
        return view('reservation.form');
    }

 public function store(Request $request)
{
    $validated = $request->validate([
        'name'        => 'required|string|max:255',
        'email'       => 'required|email',
        'phone'       => 'required',
        'date'        => 'required|date',
        'ville'       => 'required|string|max:255',
        'duree'       => 'required|in:journee,circuit',
        'langue'      => 'required|in:fr,en,it,es',
        'nbJours'     => 'nullable|integer|min:2',
        'interets'    => 'nullable|string|max:1000',
        'details'     => 'nullable|string|max:2000',
        'nb_personnes'=> 'required|integer|min:1',
        'itineraire'  => 'nullable|file|mimes:pdf|max:2048',
    ]);

    // Gestion du fichier PDF
    if ($request->hasFile('itineraire')) {
        $validated['itineraire'] = $request->file('itineraire')->store('itineraire', 'public');
    }

    // 🔐 Calcul sécurisé du prix
    $nbPersonnes = (int) $request->input('nb_personnes', 1);
    $duree = $request->input('duree');
    $nbJours = (int) $request->input('nbJours', 1);

    $prix = 0;
    if ($duree === 'circuit') {
        if ($nbPersonnes > 10) {
            $prix = $nbPersonnes * 8 * $nbJours;
        } else {
            $prix = 50 * $nbJours;
        }
    } elseif ($duree === 'journee') {
        if ($nbPersonnes > 10) {
            $prix = $nbPersonnes * 8;
        } else {
            $prix = 38;
        }
    }

    $validated['prix_final'] = $prix;
    $validated['nb_personnes'] = $nbPersonnes;

    // Création en base
    $reservation = Reservation::create($validated);

    // Envoi de l’e-mail de confirmation client
    Mail::to($validated['email'])->send(new ReservationConfirmationMail($reservation));

    return redirect()->route('reservation.remerciement', ['id' => $reservation->id]);

}


   public function confirmation(Request $request, $id)
{
    $reservation = Reservation::findOrFail($id);

    // Vérifie si déjà confirmé
    if (!$reservation->confirmed) {
        $reservation->confirmed = true;
        $reservation->confirmed_at = now(); // Ajoute la date/heure de confirmation
        $reservation->save();

        // Envoi de l’email à l’admin
        Mail::to('adiop6225@gmail.com')->send(new ReservationConfirmed($reservation));
    }

    return view('confirmation-programme', compact('reservation'));
}
public function remerciement($id)
{
    $reservation = Reservation::findOrFail($id);
    return view('reservation.remerciement', compact('reservation'));
}


}
