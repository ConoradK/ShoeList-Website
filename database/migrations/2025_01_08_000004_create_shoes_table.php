<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * This method is responsible for creating the "shoes" table in the database.
     */
    public function up(): void
    {
        // Create the "shoes" table with the specified columns
        Schema::create('shoes', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('name'); // Shoe name
            $table->foreignId('brand_id')->constrained('brands')->onDelete('cascade'); // Foreign key for brands
            $table->foreignId('type_id')->constrained('types')->onDelete('cascade'); // Foreign key for types
            $table->decimal('price', 12, 2); // Price
            $table->integer('stock'); // Stock quantity
            $table->date('release_date'); // Release date
        });
    }

    /**
     * Reverse the migrations.
     * This method is responsible for dropping the "shoes" table if the migration is rolled back.
     */
    public function down(): void
    {
        // Drop the "shoes" table if it exists
        Schema::dropIfExists('shoes');
    }
};
