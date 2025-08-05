<?php
// database/seeders/VehicleSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Vehicle;

class VehicleSeeder extends Seeder
{
    public function run()
    {
        $vehicles = [
            [
                'name' => 'Mercedes Classe E',
                'type' => 'sedan',
                'capacity' => 4,
                'price_per_km' => 1.50,
                'base_price' => 25.00,
                'description' => 'Berline de luxe, climatisée, confortable pour 4 passagers',
                'is_available' => true,
            ],
            [
                'name' => 'BMW X5',
                'type' => 'suv',
                'capacity' => 6,
                'price_per_km' => 2.00,
                'base_price' => 35.00,
                'description' => 'SUV spacieux, idéal pour les familles et les bagages',
                'is_available' => true,
            ],
            [
                'name' => 'Mercedes Vito',
                'type' => 'van',
                'capacity' => 8,
                'price_per_km' => 2.50,
                'base_price' => 45.00,
                'description' => 'Van confortable pour groupes, espace bagages important',
                'is_available' => true,
            ],
            [
                'name' => 'Mercedes Sprinter',
                'type' => 'minibus',
                'capacity' => 16,
                'price_per_km' => 3.00,
                'base_price' => 65.00,
                'description' => 'Minibus pour grands groupes, climatisation, TV',
                'is_available' => true,
            ],
        ];

        foreach ($vehicles as $vehicle) {
            Vehicle::create($vehicle);
        }
    }
}