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
       Schema::create('reservations', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->string('email');
    $table->string('phone');
    $table->date('date');
    $table->string('ville');
    $table->string('duree');
    $table->string('langue');
    $table->integer('nbJours')->nullable();
    $table->string('prix');
    $table->text('interets')->nullable();
    $table->text('details')->nullable();
    $table->string('itineraire')->nullable();
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
