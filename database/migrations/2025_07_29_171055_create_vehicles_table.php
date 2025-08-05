<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nom du véhicule (ex: Mercedes Classe E)
            $table->enum('type', ['sedan', 'suv', 'van', 'minibus']); // Type de véhicule
            $table->integer('capacity'); // Nombre de passagers max
            $table->decimal('price_per_km', 8, 2); // Prix par km
            $table->decimal('base_price', 8, 2); // Prix de base
            $table->string('image')->nullable(); // Photo du véhicule
            $table->boolean('is_available')->default(true); // Disponible ou non
            $table->text('description')->nullable(); // Description
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
