<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentSalariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_salaries', function (Blueprint $table) {
            $table->bigIncrements('id_salaries');
            $table->dateTime('datepayments');
            $table->unsignedBigInteger('userid');
            $table->bigInteger('bonus')->nullable();
            $table->bigInteger('salary_cuts')->nullable();
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
        Schema::dropIfExists('payment_salaries');
    }
}
