<?php

namespace App\Console\Commands;

use App\Models\Equipe;
use Illuminate\Console\Command;

class ConfigurerEquipe extends Command
{
    protected $signature = 'equipe:configurer {nom} {email} {role}';
    protected $description = 'Ajouter un membre d\'équipe';

    public function handle()
    {
        $equipe = Equipe::create([
            'nom' => $this->argument('nom'),
            'email' => $this->argument('email'),
            'role' => $this->argument('role'),
            'actif' => true
        ]);

        $lien = route('terrain.acces', $equipe->token_acces);
        
        $this->info("Équipe créée : {$equipe->nom}");
        $this->info("Token : {$equipe->token_acces}");
        $this->info("Lien : {$lien}");
        
        return 0;
    }
}