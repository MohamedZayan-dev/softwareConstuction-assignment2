<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('personalities', function (Blueprint $table) {
            $table->dropColumn('quiz_id');
        });

        Schema::table('personalities', function (Blueprint $table) {
            $table->foreignId('quiz_id')->nullable()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('personalities', function (Blueprint $table) {
            //
        });
    }
};
