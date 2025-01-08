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
        Schema::create('colour_shoe', function (Blueprint $table) {
            $table->unsignedBigInteger('shoe_id');  // Foreign key for shoes
            $table->unsignedBigInteger('colour_id');  // Foreign key for colours
            $table->foreign('shoe_id')->references('id')->on('shoes')->onDelete('cascade');
            $table->foreign('colour_id')->references('id')->on('colours')->onDelete('cascade');
            $table->primary(['shoe_id', 'colour_id']);  // Composite primary key
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('colour_shoe');
    }
};
