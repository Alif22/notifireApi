<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateAddressIdForeignConstraint extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_', function (Blueprint $table) {
            $table->dropForeign('user__AddressID_foreign');
            $table->foreign('AddressID')->references('AddressID')->on('addresses')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_', function (Blueprint $table) {
            //
        });
    }
}
