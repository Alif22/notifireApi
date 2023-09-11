<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id('ReportID');
            $table->timestamps();
            $table->string('Comment')->nullable();
            $table->binary('MediaAttachment')->nullable();
            $table->string('ReportStatus');
            $table->unsignedBigInteger('UserID');
            $table->unsignedBigInteger('CategoryID');
            $table->unsignedBigInteger('AddressID');

            $table->foreign('CategoryID')->references('CategoryID')->on('report_categories');
            $table->foreign('UserID')->references('UserID')->on('user_');
            $table->foreign('AddressID')->references('AddressID')->on('addresses')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reports');
    }
}
