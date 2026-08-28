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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            // In a real app we'd have a user_id foreign key, but we'll use a string or nullable id for now
            $table->foreignId('user_id')->nullable();
            $table->text('shipping_address');
            $table->string('payment_method'); // 'momo', 'cod', 'credit_card'
            $table->string('payment_status'); // 'pending', 'paid', 'failed'
            $table->unsignedBigInteger('total_amount'); // Storing cents/VND
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
