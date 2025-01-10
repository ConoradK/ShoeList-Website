<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username')->unique(); // Unique username
            $table->string('password'); // Password field
            $table->enum('role', ['admin', 'user'])->default('user'); // Role column
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
};
