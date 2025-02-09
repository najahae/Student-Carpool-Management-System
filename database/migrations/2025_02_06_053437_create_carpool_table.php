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
        Schema::create('carpool', function (Blueprint $table) {
            $table->increments ('id');
            $table->unsignedInteger('driverID')->nullable();
            $table->unsignedInteger('carID')->nullable();
            $table->string('pickup_loc');
            $table->string('dropoff_loc');
            $table->string('pickup_date');
            $table->string('pickup_time');
            $table->string('available_seats');
            $table->float('total_fare');
            $table->decimal('fare_per_head', 8, 2)->default(0)->change();
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carpool');
    }
};
