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
            $table->foreignId('service_id')->constrained()->onDelete('cascade');
            $table->foreignId('vehicle_id')->constrained()->onDelete('cascade');
            $table->string('client_name');
            $table->string('client_email');
            $table->string('client_phone');
            $table->string('hotel')->nullable();
            $table->string('destination')->nullable();
            $table->enum('service_type', ['one-way', 'round-trip']);
            $table->date('arrival_date')->nullable();
            $table->time('arrival_time')->nullable();
            $table->string('arrival_airline')->nullable();
            $table->string('arrival_flight')->nullable();
            $table->date('departure_date')->nullable();
            $table->time('departure_time')->nullable();
            $table->string('departure_airline')->nullable();
            $table->string('departure_flight')->nullable();
            $table->date('pickup_date');
            $table->time('pickup_time');
            $table->integer('number_passengers');
            $table->decimal('price_normal', 10, 2);
            $table->decimal('price_paypal', 10, 2);
            $table->text('comments')->nullable();
            $table->string('reservation_number')->unique();
            $table->enum('status', ['pending', 'confirmed', 'cancelled', 'completed'])->default('pending');
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
