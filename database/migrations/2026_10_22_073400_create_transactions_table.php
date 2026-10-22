<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * LKPD Pertemuan 7 - Transaksi Checkout & Database Logging
     */
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_code')->unique();
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
            $table->string('buyer_name');
            $table->string('buyer_phone');
            $table->text('buyer_address');
            $table->string('courier');
            $table->decimal('shipping_cost', 12, 2);
            $table->integer('quantity');
            $table->decimal('total_price', 12, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
