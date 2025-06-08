<?php
// modules/VoyagesGroupes/Controllers/VoyageController.php
namespace Modules\VoyagesGroupes\Controllers;

use App\Http\Controllers\Controller;
use Modules\VoyagesGroupes\Models\Voyage;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class VoyageController extends Controller
{
    public function index() {
        $voyages = Voyage::all();
        return view('voyagesgroupes::index', compact('voyages'));
    }

    public function show($id) {
        $voyage = Voyage::with(['interets', 'inscriptions'])->findOrFail($id);
        return view('voyagesgroupes::show', compact('voyage'));
    }

    public function interesser($id) {
        auth()->user()->voyagesInteresses()->attach($id);
        return back()->with('success', 'Ajouté aux intéressés !');
    }

    public function inscrire($id) {
        auth()->user()->voyagesInscrits()->attach($id);
        return back()->with('success', 'Inscription confirmée !');
    }
}
