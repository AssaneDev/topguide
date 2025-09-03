<?php
// database/migrations/2025_01_XX_create_hebergement_commentaires_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('hebergement_commentaires', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hebergement_id')->constrained('hebergements')->onDelete('cascade');
            $table->string('nom_client');
            $table->string('email_client');
            $table->text('commentaire');
            $table->integer('note_client')->comment('Note client 1-5');
            $table->enum('statut', ['en_attente', 'approuve', 'rejete'])->default('en_attente');
            $table->string('ip_client')->nullable();
            $table->timestamps();
            
            $table->index(['hebergement_id', 'statut']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('hebergement_commentaires');
    }
};