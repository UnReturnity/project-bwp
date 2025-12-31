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
        Schema::create('vouchers', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique(); // The coupon code (e.g., 'SALE2026')
            $table->integer('discount_amount'); // How much Rp to cut off
            $table->integer('min_purchase')->default(0); // Minimum spend requirement
            $table->boolean('is_active')->default(true); // Turn off without deleting
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vouchers');
    }
};
