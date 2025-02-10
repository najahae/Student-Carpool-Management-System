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
        Schema::table('carpool', function (Blueprint $table) {
            $table->decimal('fare_per_head', 8, 2)->after('total_fare')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('carpool', function (Blueprint $table) {
            $table->dropColumn('fare_per_head');
        });
    }
};
