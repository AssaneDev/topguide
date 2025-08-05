<?php
// database/migrations/XXXX_XX_XX_create_shuttle_bookings_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('shuttle_bookings', function (Blueprint $table) {
            $table->id();
            $table->string('booking_reference')->unique(); // Référence unique (ex: SHT-ABC123)
            
            // Informations client
            $table->string('customer_name');
            $table->string('customer_email');
            $table->string('customer_phone');
            
            // Détails de la réservation
            $table->integer('passenger_count'); // Nombre de passagers
            $table->foreignId('vehicle_id')->constrained()->onDelete('cascade');
            $table->string('pickup_location'); // Lieu de prise en charge
            $table->string('destination'); // Destination
            $table->dateTime('pickup_datetime'); // Date et heure de prise en charge
            $table->decimal('total_price', 10, 2); // Prix total
            
            // Statuts
            $table->enum('status', ['pending', 'confirmed', 'paid', 'completed', 'cancelled'])->default('pending');
            $table->enum('payment_status', ['pending', 'paid', 'failed', 'refunded'])->default('pending');
            
            // Informations supplémentaires
            $table->string('payment_intent_id')->nullable(); // ID Stripe
            $table->text('special_requests')->nullable(); // Demandes spéciales
            
            // Timestamps spéciaux
            $table->timestamp('confirmed_at')->nullable();
            $table->timestamp('paid_at')->nullable();
            
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('shuttle_bookings');
    }
};