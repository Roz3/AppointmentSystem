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
        Schema::table('callslips', function (Blueprint $table) {
            $table->unsignedBigInteger('counselor_id')->nullable()->after('instructor_id');
            $table->foreign('counselor_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('callslips', function (Blueprint $table) {
            //
        });
    }
};
