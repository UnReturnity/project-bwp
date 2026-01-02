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
    Schema::create('carts', function (Blueprint $table) {
        $table->id();
        // Who owns this cart item?
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        // What product is it?
        $table->foreignId('product_id')->constrained()->onDelete('cascade');
        // How many?
        $table->integer('quantity')->default(1);
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
