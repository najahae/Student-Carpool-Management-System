<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('passengers', function (Blueprint $table) {
        $table->bigInteger('chat_id')->nullable()->after('phone');
    });
}

public function down()
{
    Schema::table('passengers', function (Blueprint $table) {
        $table->dropColumn('chat_id');
    });
}

};
