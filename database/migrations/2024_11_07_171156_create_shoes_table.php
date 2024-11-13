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
            $table->id('product_code');
            $table->string('name');
            $table->string('brand');
            $table->string('type');
            $table->string('material');
            $table->decimal('price',total:12 ,places:2);
            $table->string('colour');
            $table->integer('stock');
            $table->date('release_date');
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
