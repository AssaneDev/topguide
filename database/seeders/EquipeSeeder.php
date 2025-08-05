<?php
// database/seeders/EquipeSeeder.php
namespace Database\Seeders;

use App\Models\Equipe;
use Illuminate\Database\Seeder;

class EquipeSeeder extends Seeder
{
    public function run()
    {
        $equipes = [
            [
                'nom' => 'Mamadou Photographe',
                'email' => 'photo@vacancesenegal.com',
                'telephone' => '+221701234567',
                'role' => 'photographe'
            ],
            [
                'nom' => 'Fatou Community Manager',
                'email' => 'social@vacancesenegal.com', 
                'telephone' => '+221707654321',
                'role' => 'gestionnaire_posts'
            ],
            [
                'nom' => 'Ibrahima Guide',
                'email' => 'guide@vacancesenegal.com',
                'telephone' => '+221709876543',
                'role' => 'guide'
            ]
        ];

        foreach ($equipes as $equipe) {
            Equipe::create($equipe);
        }
    }
}