<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTemplatesConsignesTable extends Migration
{
    public function up()
    {
        Schema::create('templates_consignes', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->text('description')->nullable();
            $table->enum('type_equipe', ['photographe', 'gestionnaire_posts', 'both']);
            $table->string('categorie')->nullable(); // 'nature', 'culture', 'aventure', etc.
            $table->json('mots_cles'); // Mots-clés pour déclenchement automatique
            $table->text('consignes_template');
            $table->json('moments_cles_template');
            $table->json('hashtags_template');
            $table->text('objectifs_template');
            $table->enum('priorite_defaut', ['normale', 'importante', 'critique'])->default('normale');
            $table->boolean('actif')->default(true);
            $table->integer('ordre')->default(0); // Pour ordonner les templates
            $table->timestamps();
            
            $table->index(['type_equipe', 'categorie']);
            $table->index(['actif', 'ordre']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('templates_consignes');
    }
}