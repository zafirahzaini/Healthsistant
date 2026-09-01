<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('admissions', function (Blueprint $table) {
            // Add bed_number right after admission_ward
            $table->string('bed_number')->nullable()->after('admission_ward');

            // Drop unnecessary columns
            $table->dropColumn(['DiseaseID', 'acuity_level', 'diagnosis_notes']);
        });
    }

    public function down(): void
    {
        Schema::table('admissions', function (Blueprint $table) {
            $table->dropColumn('bed_number');
            $table->string('DiseaseID')->nullable();
            $table->string('acuity_level')->nullable();
            $table->text('diagnosis_notes')->nullable();
        });
    }
};