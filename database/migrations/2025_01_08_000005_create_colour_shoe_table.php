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
            $table->id();
            $table->foreignId('shoe_id')->constrained('shoes')->onDelete('cascade');
            $table->foreignId('colour_id')->constrained('colours')->onDelete('cascade');
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
