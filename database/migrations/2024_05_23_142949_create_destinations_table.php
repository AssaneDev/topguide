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
        Schema::create('destinations', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->longText('short_descp')->nullable();
            $table->string('image_cap')->nullable();
            $table->string('image')->nullable();
            $table->int('prix')->nullable();
            $table->int('prix_guide')->nullable();
            $table->longText('long_descp')->nullable();
            $table->longText('information')->nullable();
            $table->longText('offre_guide')->nullable();
            $table->string('name_en')->nullable();
            $table->string('short_descp_en')->nullable();
            $table->string('long_descp_en')->nullable();
            $table->string('name_es')->nullable();
            $table->string('short_descp_es')->nullable();
            $table->string('long_descp_es')->nullable();
            $table->int('dure_sejour')->nullable();
            $table->string('type_circuit')->nullable();
            $table->string('lieux')->nullable();
             $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('destinations');
    }
};
