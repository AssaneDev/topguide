<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class OptimizationController extends Controller
{
    //
    public function optimize()
    {
     


        if (is_writable(storage_path()) && is_writable(base_path('bootstrap/cache'))) {
            // Exécute la commande artisan optimize
            Artisan::call('optimize');

            // Retourne un message de succès
              // Optionnel : Retourne un message de succès ou redirige l'utilisateur
                $notification = array(
                'message' =>'Cache nettoyer avec succes',
                'alert-type' => 'success'
            );
            
            return  redirect()->back()->with($notification);
        } else {
            // Retourne un message d'erreur
            return response()->json(['message' => 'Permissions insuffisantes sur les dossiers nécessaires.'], 500);
        }

     
    }
}
