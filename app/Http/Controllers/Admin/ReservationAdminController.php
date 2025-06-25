<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationAdminController extends Controller
{
    public function index()
    {
        $reservations = Reservation::latest()->get();
        return view('admin.guide_reservation.index', compact('reservations'));
    }

    public function confirm($id)
{
    $reservation = Reservation::findOrFail($id);

    if (!$reservation->confirmed) {
        $reservation->confirmed = true;
        $reservation->confirmed_at = now();
        $reservation->save();

        // Optionnel : notifier l'admin ou le client par mail
        // Mail::to($reservation->email)->send(new ReservationConfirmationMail($reservation));
    }

    return redirect()->back()->with('message', 'Réservation confirmée avec succès.');
}


    public function destroy($id)
    {
        Reservation::findOrFail($id)->delete();

        return redirect()->back()->with([
            'message' => 'Réservation supprimée avec succès',
            'alert-type' => 'success'
        ]);
    }
}
