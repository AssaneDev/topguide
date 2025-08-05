<?php

namespace App\Console\Commands;

use App\Models\Circuit;
use Illuminate\Console\Command;

class StatutCircuit extends Command
{
    protected $signature = 'circuit:statut {circuit} {statut}';
    protected $description = 'Changer le statut d\'un circuit';

    public function handle()
    {
        $circuit = Circuit::findOrFail($this->argument('circuit'));
        $circuit->update(['statut' => $this->argument('statut')]);
        
        $this->info("Circuit {$circuit->nom} : statut changé vers {$circuit->statut}");
        
        return 0;
    }
}

?>