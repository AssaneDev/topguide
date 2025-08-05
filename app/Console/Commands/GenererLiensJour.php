<?php

namespace App\Console\Commands;

use App\Models\Circuit;
use App\Models\Equipe;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class GenererLiensJour extends Command
{
    protected $signature = 'circuit:envoyer-liens';
    protected $description = 'Envoie les liens quotidiens à l\'équipe terrain';

    public function handle()
    {
        $circuits = Circuit::where('statut', 'en_cours')->get();

        foreach ($circuits as $circuit) {
            $programme = $circuit->getProgrammeAujourdhui();
            
            if (!$programme) continue;

            // Équipes actives
            $equipes = Equipe::where('actif', true)
                            ->whereIn('role', ['photographe', 'gestionnaire_posts'])
                            ->get();

            foreach ($equipes as $equipe) {
                $lien = route('terrain.acces', $equipe->token_acces);
                
                // Envoyer email/SMS
                $this->envoyerNotification($equipe, $lien, $programme);
                
                $this->info("Lien envoyé à {$equipe->nom} ({$equipe->role})");
            }
        }

        return 0;
    }

    private function envoyerNotification($equipe, $lien, $programme)
    {
        // Email simple
        Mail::raw(
            "🎬 Programme Jour {$programme->jour_numero}\n\n" .
            "📍 Lieu: {$programme->lieu_principal}\n" .
            "🎯 Activités: {$programme->activites}\n\n" .
            "👇 Votre programme détaillé:\n{$lien}\n\n" .
            "Bon travail ! 🚀\n\n" .
            "Équipe Vacances Sénégal",
            function ($message) use ($equipe) {
                $message->to($equipe->email)
                        ->subject("📱 Votre programme du jour - {$equipe->role}");
            }
        );
    }
}
