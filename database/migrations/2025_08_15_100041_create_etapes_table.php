<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('etapes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('voyage_id')->constrained()->onDelete('cascade');
            $table->integer('numero_jour');
            $table->string('titre_etape');
            $table->text('description_etape');
            $table->string('lieu_depart')->nullable();
            $table->string('lieu_arrivee')->nullable();
            $table->time('heure_debut')->nullable();
            $table->time('heure_fin')->nullable();
            $table->json('activites_jour')->nullable(); // ['visite_monument', 'randonnee', 'repas_local']
            $table->string('hebergement_etape')->nullable();
            $table->text('notes_speciales')->nullable();
            $table->string('image_etape')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('etapes');
    }
};