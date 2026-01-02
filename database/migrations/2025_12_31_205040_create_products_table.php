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
            // Connects to categories. "constrained" means it MUST match a real category ID.
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');

            $table->string('name');
            $table->text('description')->nullable(); // Good for showing details on the shop page
            $table->integer('stock');
            $table->decimal('price', 10, 2); // Allows cents (e.g., 15000.00)
            $table->string('image')->nullable();

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
