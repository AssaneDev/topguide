<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationAdminController extends Controller
{

    public function index(Request $request)
{
    $query = Reservation::query();

    $filter = $request->get('filter');

    switch ($filter) {
        case 'today':
            $query->whereDate('created_at', today());
            break;
        case 'week':
            $query->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]);
            break;
        case 'unconfirmed':
            $query->where('confirmed', false);
            break;
        // default: all
    }

    $reservations = $query->latest()->paginate(10);
    $latestId = Reservation::latest()->value('id');

    return view('admin.guide_reservation.index', compact('reservations', 'latestId', 'filter'));
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
