<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_code')->unique();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('payment_id')->nullable()->constrained();
            $table->decimal('total_amount', 15, 2);
            $table->string('status')->default('pending'); // pending, paid, processing, completed, cancelled
            $table->json('items');
            $table->text('shipping_address')->nullable();
            $table->string('customer_name');
            $table->string('customer_email');
            $table->string('customer_phone');
            $table->timestamps();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};