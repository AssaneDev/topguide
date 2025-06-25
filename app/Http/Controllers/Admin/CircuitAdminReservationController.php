<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CircuitReservation;

class CircuitAdminReservationController extends Controller
{
    public function index(Request $request)
    {
        $query = CircuitReservation::query();

        $filter = $request->get('filter');

        switch ($filter) {
            case 'today':
                $query->whereDate('created_at', today());
                break;
            case 'week':
                $query->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]);
                break;
            case 'unconfirmed':
                $query->whereNull('confirmed_at');
                break;
        }

        $reservations = $query->latest()->paginate(10);
        $latestId = CircuitReservation::latest()->value('id');

        return view('admin.circuit_reservation.index', compact('reservations', 'latestId', 'filter'));
    }

    public function confirm($id)
    {
        $reservation = CircuitReservation::findOrFail($id);
        if (!$reservation->confirmed_at) {
            $reservation->confirmed_at = now();
            $reservation->save();
        }

        return redirect()->back()->with('message', 'Réservation de circuit confirmée.');
    }

    public function destroy($id)
    {
        CircuitReservation::findOrFail($id)->delete();
        return redirect()->back()->with('message', 'Réservation supprimée.');
    }
}
