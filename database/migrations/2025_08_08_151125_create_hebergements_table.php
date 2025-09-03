<?php
// database/migrations/2025_01_XX_create_hebergements_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('hebergements', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->text('description');
            $table->text('adresse');
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->string('region');
            $table->string('departement');
            $table->string('lieu_touristique')->nullable();
            $table->decimal('tarif_min', 10, 2)->nullable();
            $table->decimal('tarif_max', 10, 2)->nullable();
            $table->string('devise', 3)->default('XOF');
            $table->string('site_web')->nullable();
            $table->string('telephone')->nullable();
            $table->string('email')->nullable();
            $table->integer('note_admin')->nullable()->comment('Note interne 1-5');
            $table->text('commentaire_admin')->nullable();
            $table->enum('statut', ['actif', 'inactif', 'en_cours'])->default('actif');
            $table->json('images')->nullable();
            $table->json('amenities')->nullable(); // WiFi, Piscine, Restaurant, etc.
            $table->json('badges')->nullable(); // Éco-responsable, Vue mer, etc.
            $table->integer('ordre_affichage')->default(0);
            $table->boolean('featured')->default(false);
            $table->integer('vues')->default(0);
            $table->timestamps();
            
            $table->index(['region', 'departement']);
            $table->index('statut');
            $table->index('featured');
        });
    }

    public function down()
    {
        Schema::dropIfExists('hebergements');
    }
};