<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CircuitReservation;
use App\Mail\CircuitConfirmationMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use App\Notifications\NouvelleReservationNotification;


class CircuitReservationController extends Controller
{
    
    
public function store(Request $request)
{
   $data = $request->validate([
    'nom' => 'required',
    'email' => 'required|email',
    'tel' => 'required',
    'destination' => 'required',
    'nbr_Pax' => 'required|integer',
    'message' => 'required',
    'offre' => 'required|in:Tout Compris,Juste un Guide',
]);


    $reservation = CircuitReservation::create($data);

    // Envoi email au client avec lien de confirmation
    Mail::to($reservation->email)->send(new CircuitConfirmationMail($reservation));

  
   return redirect()->route('circuit.success')->with('client_email', $reservation->email);

}



public function confirm($id)
{
    $reservation = CircuitReservation::findOrFail($id);
    $reservation->confirmed_at = now();
    $reservation->save();

    // Notifier admin (par exemple via email)
    Mail::to('admin@email.com')->send(new \App\Mail\AdminNotificationMail($reservation));

    return view('frontend.confirmation_success');
}



}
