<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('patients', function (Blueprint $table) {
    
        $table->string('death_type')->nullable(); // 'Sudden' or 'Expected'
        $table->dateTime('time_of_death')->nullable()->after('death_type');
        $table->string('cause_of_death')->nullable()->after('time_of_death');
        $table->string('declared_by')->nullable()->after('cause_of_death');
        $table->text('mortality_notes')->nullable()->after('declared_by');
        });
    }

    public function down(): void
    {
        Schema::table('patients', function (Blueprint $table) {
            $table->dropColumn([
                'death_type',
                'time_of_death',
                'cause_of_death',
                'declared_by',
                'mortality_notes'
            ]);
        });
    }
};