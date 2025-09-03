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
        Schema::create('user_favorites', function (Blueprint $table) {
            $table->id();
            
            // Relations avec vos tables existantes
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('voyage_id')->constrained()->onDelete('cascade');
            
            // Métadonnées du favori
            $table->text('note_personnelle')->nullable(); // Note privée de l'utilisateur
            $table->integer('priorite')->default(1); // 1=basse, 5=haute priorité
            $table->date('date_voyage_souhaitee')->nullable();
            
            // Préférences de notification
            $table->boolean('notification_prix')->default(false);
            $table->boolean('notification_disponibilite')->default(false);
            
            $table->timestamps();
            
            // Contraintes
            $table->unique(['user_id', 'voyage_id']); // Un seul favori par utilisateur/voyage
            $table->index('priorite');
            $table->index('date_voyage_souhaitee');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('user_favorites');
    }
};