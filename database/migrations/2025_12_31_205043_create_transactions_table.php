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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            // Who bought it?
            $table->foreignId('user_id')->constrained();
            // Did they use a coupon? (Nullable because maybe they didn't)
            $table->foreignId('voucher_id')->nullable()->constrained();

            $table->string('invoice_code')->unique(); // e.g., INV-2025001
            $table->decimal('total_price', 12, 2); // Final price to pay
            $table->integer('discount_total')->default(0); // How much was saved

            // Status: PENDING -> PAID -> COMPLETED -> CANCELLED
            $table->string('status')->default('PENDING');

            // For uploading the transfer receipt image
            $table->string('proof_of_payment')->nullable();

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
