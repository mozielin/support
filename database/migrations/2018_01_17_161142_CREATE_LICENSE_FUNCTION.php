<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CREATELICENSEFUNCTION extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('license_function', function (Blueprint $table) {
            $table->integer('license_id')->unsigned();
            $table->integer('function_id')->unsigned();

            $table->foreign('license_id')->references('id')->on('license')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('function_id')->references('id')->on('function')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['license_id', 'function_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('license_function');
    }
}
