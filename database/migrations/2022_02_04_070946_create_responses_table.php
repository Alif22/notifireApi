<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResponsesTable extends Migration
{
    /**s
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('responses', function (Blueprint $table) {
            $table->id('ResponseID');
            $table->string('ActionTaken')->nullable();
            $table->string('Remark')->nullable();
            $table->timestamps();
            //removed officerID
            $table->unsignedBigInteger('OfficerID');
            $table->unsignedBigInteger('UserID');
            $table->unsignedBigInteger('ReportID');
            
            $table->foreign('OfficerID')->references('OfficerID')->on('officers');
            $table->foreign('UserID')->references('UserID')->on('user_')->onupdate('cascade');
            $table->foreign('ReportID')->references('ReportID')->on('reports')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('responses');
    }
}
