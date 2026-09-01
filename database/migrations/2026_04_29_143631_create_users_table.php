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
        Schema::create('users', function (Blueprint $table) {

            // Primary Key (Custom ID like MO123, NS456)
            $table->string('userID', 5)->primary();

            // User Information
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');

            // Additional Fields (based on your ERD)
            $table->unsignedInteger('age'); // safer than integer
            $table->string('role');

            // Timestamps
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};