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
        Schema::create('car', function (Blueprint $table) {
            $table->increments ('id');
            $table->unsignedInteger('driverID')->nullable();
            $table->string('carType')->nullable();
            $table->string('carModel');
            $table->string('carColor');
            $table->string('carPlate');
            $table->string('carCapacity');
            $table->string('carImage')->nullable();
            $table->string('roadtaxExp');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('car');
    }
};
