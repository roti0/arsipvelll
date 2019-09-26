<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('address');
            $table->unsignedBigInteger('job');
            $table->date('hiredate');
            $table->date('birthdate');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->integer('level')->default('2');
            $table->boolean('status')->default('1');
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('job')->references('id_jobs')->on('jobs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
