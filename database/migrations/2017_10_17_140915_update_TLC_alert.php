<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTLCAlert extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('seadmin', function (Blueprint $table) {
         $table->integer('builder')->unsigned();
         $table->foreign('builder')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('seadmin', function (Blueprint $table) {
            $table->dropForeign('seadmin_builder_foreign');
        });
    }
}
