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
        Schema::create('voyage_models', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->longText('short_descp')->nullable();
            $table->string('image_cap')->nullable();
            $table->string('image')->nullable();
            $table->string('prix')->nullable();
            $table->longText('long_descp')->nullable();
            $table->longText('information')->nullable();
            $table->string('dure_sejour')->nullable();
            $table->string('type_voyage')->nullable();
            $table->string('nombre_participant')->nullable();
            $table->string('lieux')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('voyage_models');
    }
};
