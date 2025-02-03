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
        Schema::create('material_shoe', function (Blueprint $table) {
            $table->unsignedBigInteger('shoe_id');  // Foreign key for shoes
            $table->unsignedBigInteger('material_id');  // Foreign key for materials
            $table->foreign('shoe_id')->references('id')->on('shoes')->onDelete('cascade');
            $table->foreign('material_id')->references('id')->on('materials')->onDelete('cascade');
            $table->primary(['shoe_id', 'material_id']);  // Composite primary key
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('material_shoe');
    }
};
