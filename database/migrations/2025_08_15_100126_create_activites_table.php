<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('activites', function (Blueprint $table) {
            $table->id();
            $table->foreignId('voyage_id')->constrained()->onDelete('cascade');
            $table->string('nom_activite');
            $table->text('description_activite');
            $table->decimal('prix_activite', 8, 2)->default(0);
            $table->enum('type_activite', ['incluse', 'optionnelle']);
            $table->integer('duree_heures')->nullable();
            $table->string('lieu_activite');
            $table->json('equipements_requis')->nullable(); // ['chaussures_marche', 'maillot_bain']
            $table->integer('jour_recommande')->nullable(); // Quel jour du voyage
            $table->string('image_activite')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('activites');
    }
};