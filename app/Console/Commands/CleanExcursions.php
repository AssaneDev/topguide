<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\ExcursionModel;
use App\Helpers\HtmlCleaner;

class CleanExcursions extends Command
{
    protected $signature = 'clean:excursions';
    protected $description = 'Nettoie les balises inutiles dans les champs HTML des excursions';

    public function handle()
    {
        $excursions = ExcursionModel::all();

        foreach ($excursions as $excursion) {
            $excursion->short_descp = HtmlCleaner::sanitizeQuill($excursion->short_descp);
            $excursion->long_descp = HtmlCleaner::sanitizeQuill($excursion->long_descp);
            $excursion->information = HtmlCleaner::sanitizeQuill($excursion->information);
            $excursion->offre_guide = HtmlCleaner::sanitizeQuill($excursion->offre_guide);
            $excursion->save();
        }

        $this->info('✔ Toutes les excursions ont été nettoyées.');
    }
}
