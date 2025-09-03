<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('voyages', function (Blueprint $table) {
            $table->id();
            $table->string('nom_voyage');
            $table->text('description_courte');
            $table->longText('description_longue');
            $table->string('image_principale');
            $table->string('image_couverture');
            $table->enum('type_voyage', ['culturel', 'aventure', 'detente', 'famille', 'eco-tourisme', 'decouverte']);
            $table->string('region');
            $table->integer('duree_jours');
            $table->decimal('prix_base', 10, 2);
            $table->decimal('prix_avec_guide', 10, 2)->nullable();
            $table->integer('participants_min')->default(1);
            $table->integer('participants_max');
            $table->enum('difficulte', ['facile', 'modere', 'difficile'])->default('facile');
            $table->json('transports_inclus')->nullable();
            $table->json('hebergements_inclus')->nullable();
            $table->boolean('repas_inclus')->default(false);
            $table->boolean('guide_inclus')->default(false);
            $table->text('equipements_recommandes')->nullable();
            $table->text('conditions_particulieres')->nullable();
            $table->text('informations_generales')->nullable();
            $table->text('offre_guide')->nullable();
            $table->enum('statut', ['brouillon', 'publie', 'archive'])->default('brouillon');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('voyages');
    }
};