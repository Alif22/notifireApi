<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_', function (Blueprint $table) {
            $table->id('UserID');
            $table->string('UserName');
            $table->string('UserPhoneNumber')->nullable();
            $table->string('UserIDNumber')->nullable()->unique();
            $table->string('UserType');
            $table->string('Email')->unique();
            $table->string('Password');
            $table->unsignedBigInteger('AddressID')->nullable();

            $table->foreign('AddressID')->references('AddressID')->on('addresses')->onUpdate('cascade')
            ->onDelete('cascade');
        });
       
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_');
    }
}
