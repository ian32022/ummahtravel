<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('package_id')->constrained()->onDelete('cascade');
            $table->foreignId('package_date_id')->constrained('package_dates')->onDelete('cascade');
            $table->enum('room_type', ['double', 'triple', 'quad']);
            $table->decimal('total_price', 15, 2);
            $table->enum('status', ['pending', 'confirmed', 'paid', 'cancelled'])->default('pending');
            $table->enum('payment_status', ['unpaid', 'pending', 'paid', 'failed'])->default('unpaid');
            $table->string('payment_method')->nullable();
            $table->text('payment_proof')->nullable();
            $table->timestamp('payment_date')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};