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
        Schema::create('drivers', function (Blueprint $table) {
            $table->increments ('id');
            $table->string('fullname');
            $table->string('gender');
            $table->string('studentID');
            $table->string('phoneNum');
            $table->string('email');
            $table->string('password');
            $table->string('studentCard')->nullable();
            $table->string('licenseCard')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('drivers');
    }
};
