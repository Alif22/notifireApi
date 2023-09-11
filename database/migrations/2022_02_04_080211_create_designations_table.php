<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDesignationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('designations', function (Blueprint $table) {
            $table->id('DesignationID');
            $table->unsignedBigInteger('OfficerID');
            $table->unsignedBigInteger('ResponseID');

            $table->foreign('OfficerID')->references('OfficerID')->on('officers')
            ->onUpdate('cascade');
            $table->foreign('ResponseID')->references('ResponseID')->on('responses')
            ->onUpdate('cascade')
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
        Schema::dropIfExists('designations');
    }
}
