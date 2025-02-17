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
            $table->foreign('driverID') ->references('id')-> on ('drivers');
            $table->foreign('carID') ->references('id')-> on ('car');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('carpool', function (Blueprint $table) {
            //
        });
    }
};
