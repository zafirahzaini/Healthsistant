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
        Schema::create('patients', function (Blueprint $table) {

            // Primary Key (PatientID)
            $table->id('PatientID');

            // Patient Information
            $table->unsignedInteger('age');
            $table->string('gender');
            $table->string('race');

            // Optional image (based on your ERD)
            $table->string('image_face')->nullable();

            // Timestamps
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};