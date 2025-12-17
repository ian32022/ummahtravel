<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            // kode order
            $table->string('order_code')->unique();

            // relasi utama
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('package_id')->constrained()->cascadeOnDelete();
            $table->foreignId('package_date_id')->constrained('package_dates')->cascadeOnDelete();

            // data booking
            $table->enum('room_type', ['double', 'triple', 'quad']);
            $table->integer('jumlah_jamaah')->default(1);

            // harga
            $table->decimal('total_amount', 15, 2);

            // status order
            $table->enum('status', [
                'pending',
                'confirmed',
                'paid',
                'processing',
                'completed',
                'cancelled'
            ])->default('pending');

            // status pembayaran
            $table->enum('payment_status', [
                'unpaid',
                'pending',
                'paid',
                'failed'
            ])->default('unpaid');

            // info pembayaran
            $table->string('payment_method')->nullable();
            $table->text('payment_proof')->nullable();
            $table->timestamp('payment_date')->nullable();

            // data customer (snapshot)
            $table->string('customer_name');
            $table->string('customer_email');
            $table->string('customer_phone');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
