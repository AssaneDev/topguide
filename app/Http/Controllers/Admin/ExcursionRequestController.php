<?php

namespace App\Http\Controllers\Admin;



use App\Http\Controllers\Controller;
use App\Models\ExcursionRequest;

class ExcursionRequestController extends Controller
{
    public function index()
    {
        $requests = ExcursionRequest::latest()->get();
        return view('admin.excursion_request.resa_excursion', compact('requests'));
    }

    public function destroy($id)
    {
        ExcursionRequest::findOrFail($id)->delete();
        return redirect()->back()->with([
            'message' => 'Demande supprimée avec succès',
            'alert-type' => 'success'
        ]);
    }
}
