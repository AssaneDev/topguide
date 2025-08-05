<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsignesEquipeTable extends Migration
{
  public function up()
{
    Schema::create('consignes_equipe', function (Blueprint $table) {
        $table->id();
        $table->foreignId('programme_journalier_id')->constrained('programme_journaliers')->onDelete('cascade');
        $table->enum('type_equipe', ['photographe', 'gestionnaire_posts']);
        $table->text('consignes_specifiques');
        $table->json('moments_cles');
        $table->json('hashtags_jour');
        $table->text('objectifs_contenu');
        $table->enum('priorite', ['normale', 'importante', 'critique'])->default('normale');
        $table->timestamps();
    });
}

public function down()
{
    Schema::dropIfExists('consignes_equipe');
}
}
