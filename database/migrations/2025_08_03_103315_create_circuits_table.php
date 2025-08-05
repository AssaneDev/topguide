<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCircuitsTable extends Migration
{
    public function up()
    {
        Schema::create('circuits', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->date('date_debut');
            $table->date('date_fin');
            $table->integer('nb_jours');
            $table->text('description')->nullable();
            $table->enum('statut', ['planifié', 'en_cours', 'terminé'])->default('planifié');
            $table->json('participants')->nullable(); // Infos clients
            $table->string('guide_principal')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('circuits');
    }
}
