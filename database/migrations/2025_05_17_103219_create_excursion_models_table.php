<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('excursion_models', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->longText('short_descp')->nullable();
            $table->string('image_cap')->nullable();
            $table->string('image')->nullable();
            $table->string('prix')->nullable();
            $table->string('prix_guide')->nullable();
            $table->longText('long_descp')->nullable();
            $table->longText('information')->nullable();
            $table->longText('offre_guide')->nullable();
            $table->string('dure_sejour')->nullable();
            $table->string('type_excursion')->nullable();
            $table->string('lieux')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('excursion_models');
    }
};
