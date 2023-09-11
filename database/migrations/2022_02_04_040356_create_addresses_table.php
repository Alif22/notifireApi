<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->id('AddressID');
            $table->string('AddressLine');
            $table->string('City');
            $table->decimal('Latitude',11,8);
            $table->decimal('Longitude',11,8);
            $table->integer('PostalCode');
            $table->unsignedBigInteger('StateID');
            
            $table->foreign('StateID')->references('StateID')->on('states');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('addresses');
    }
}
