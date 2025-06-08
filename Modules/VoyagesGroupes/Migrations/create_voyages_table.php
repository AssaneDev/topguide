<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('voyages', function (Blueprint $table) {
            $table->id();
            $table->string('destination');
            $table->date('date_depart');
            $table->date('date_retour');
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::create('interets_voyage', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('voyage_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('inscriptions_voyage', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('voyage_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('inscriptions_voyage');
        Schema::dropIfExists('interets_voyage');
        Schema::dropIfExists('voyages');
    }
};
