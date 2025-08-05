<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgrammeJournaliersTable extends Migration
{
    public function up()
    {
        Schema::create('programme_journaliers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('circuit_id')->constrained()->onDelete('cascade');
            $table->integer('jour_numero');
            $table->date('date');
            $table->string('lieu_principal');
            $table->text('activites');
            $table->text('hebergement')->nullable();
            $table->json('horaires')->nullable(); // Détails horaires
            $table->text('notes_speciales')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('programme_journaliers');
    }
}
