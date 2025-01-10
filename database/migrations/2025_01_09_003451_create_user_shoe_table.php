<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('user_shoe', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id'); // Foreign key to users table
            $table->unsignedBigInteger('shoe_id'); // Foreign key to shoes table

            // Add foreign key constraints
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('shoe_id')->references('id')->on('shoes')->onDelete('cascade');

            // Set composite primary key
            $table->primary(['user_id', 'shoe_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_shoe');
    }
};