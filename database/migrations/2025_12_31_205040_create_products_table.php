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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            // Connects to categories table. If category is deleted, this prevents errors.
            $table->foreignId('category_id')->constrained();
            $table->integer('stock');
            $table->decimal('price', 10, 2);
            $table->string('image')->nullable(); // For the bread photos
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
