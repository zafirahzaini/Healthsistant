<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('admissions', function (Blueprint $table) {
            if (Schema::hasColumn('admissions', 'DiseaseID')) {
                $table->dropColumn('DiseaseID');
            }
            if (Schema::hasColumn('admissions', 'acuity_level')) {
                $table->dropColumn('acuity_level');
            }
            if (Schema::hasColumn('admissions', 'diagnosis_notes')) {
                $table->dropColumn('diagnosis_notes');
            }
            if (!Schema::hasColumn('admissions', 'bed_number')) {
                $table->string('bed_number')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('admissions', function (Blueprint $table) {
            //
        });
    }
};