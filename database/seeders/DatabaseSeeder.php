<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{

    public function run()
{
    // Seeders existants uniquement si table vide
    if (User::count() == 0) {
        $this->call([
            UsersTableSeeder::class,
            VehicleSeeder::class,
        ]);
    }
    
    // Nouveaux seeders pour coordination
    $this->call([
        EquipeSeeder::class,
        CircuitAoutSeeder::class,
        TemplatesConsignesSeeder::class, // ✅ NOUVEAU
    ]);
}
}