<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('diagnosis_records', function (Blueprint $table) {

            $table->id('DiagnosisID');

            // Foreign keys
            $table->unsignedBigInteger('DiseaseID');
            $table->unsignedBigInteger('AdmissionID');

            // Acuity (simple version for now)
            $table->string('acuity_level');

            $table->timestamps();

            // Relationships
            $table->foreign('DiseaseID')->references('DiseaseID')->on('diseases')->onDelete('cascade');
            $table->foreign('AdmissionID')->references('AdmissionID')->on('admissions')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('diagnosis_records');
    }
};