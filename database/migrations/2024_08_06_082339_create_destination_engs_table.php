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
        Schema::create('destination_engs', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->longText('short_descp')->nullable();
            $table->string('prix')->nullable();
            $table->longText('long_descp')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('destination_engs');
    }
};
