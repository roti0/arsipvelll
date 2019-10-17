<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttendancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->bigIncrements('id_attendance');
            $table->unsignedBigInteger('userid');
            $table->date('date_attendance');
            $table->time('start');
            $table->time('end');
            $table->time('time_pressence')->nullable();
            $table->time('time_out')->nullable();
            $table->boolean('verified')->default(0);
            $table->timestamps();

            $table->foreign('userid')->references('id')->on('users')->onDelete('cascade');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attendances');
    }
}
