<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('voyage_consultations', function (Blueprint $table) {
            $table->id();
            
            // Relations avec vos tables existantes
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('voyage_id')->constrained()->onDelete('cascade');
            
            // Type de consultation
            $table->enum('type', [
                'detail',              // Page détail
                'programme',           // Programme limité  
                'programme_complet',   // Programme complet
                'galerie',            // Galerie photos
                'reservation',        // Page réservation
                'etape_specifique'    // Étape spécifique
            ])->default('detail');
            
            // Données de suivi
            $table->integer('temps_consultation_secondes')->nullable();
            $table->json('etapes_consultees')->nullable(); // [1,2,3] quelles étapes vues
            $table->string('page_source')->nullable(); // D'où vient l'utilisateur
            $table->ipAddress('ip_address')->nullable();
            
            $table->timestamps();
            
            // Index pour les performances
            $table->index(['user_id', 'voyage_id']);
            $table->index(['type', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('voyage_consultations');
    }
};