<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('galeries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('voyage_id')->constrained()->onDelete('cascade');
            $table->string('chemin_image');
            $table->string('alt_image')->nullable();
            $table->integer('ordre_affichage')->default(0);
            $table->enum('type_image', ['galerie', 'etape_specifique', 'activite']);
            $table->integer('numero_jour')->nullable(); // Si lié à une étape spécifique
            $table->foreignId('activite_id')->nullable()->constrained('activites')->onDelete('set null');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('galeries');
    }
};