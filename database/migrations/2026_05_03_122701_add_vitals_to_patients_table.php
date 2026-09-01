<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('patients', function (Blueprint $table) {

            // ✅ ADD ONLY IF NOT EXISTS (SAFE)
            if (!Schema::hasColumn('patients', 'name')) {
                $table->string('name')->nullable();
            }

            if (!Schema::hasColumn('patients', 'ic_number')) {
                $table->string('ic_number')->nullable();
            }

            if (!Schema::hasColumn('patients', 'temperature')) {
                $table->decimal('temperature', 5, 2)->nullable();
            }

            if (!Schema::hasColumn('patients', 'heart_rate')) {
                $table->integer('heart_rate')->nullable();
            }

            if (!Schema::hasColumn('patients', 'respiratory_rate')) {
                $table->integer('respiratory_rate')->nullable();
            }

            if (!Schema::hasColumn('patients', 'sbp')) {
                $table->integer('sbp')->nullable();
            }

            if (!Schema::hasColumn('patients', 'dbp')) {
                $table->integer('dbp')->nullable();
            }

            if (!Schema::hasColumn('patients', 'pulse')) {
                $table->integer('pulse')->nullable();
            }

            if (!Schema::hasColumn('patients', 'symptoms')) {
                $table->text('symptoms')->nullable();
            }

        });
    }

    public function down(): void
    {
        Schema::table('patients', function (Blueprint $table) {

            $table->dropColumn([
                'name',
                'ic_number',
                'temperature',
                'heart_rate',
                'respiratory_rate',
                'sbp',
                'dbp',
                'pulse',
                'symptoms'
            ]);

        });
    }
};