<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class OptimizationController extends Controller
{
    //
    public function optimize()
    {
        // Exécute la commande artisan optimize
        Artisan::call('optimize');

        // Optionnel : Retourne un message de succès ou redirige l'utilisateur
        $notification = array(
            'message' =>'Cache nettoyer avec succes',
            'alert-type' => 'success'
        );
        
        return  redirect()->back()->with($notification);
    }
}
