<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanySelectFunctionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_select_function', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('company_function')->unsigned();
            $table->integer('company_function_builder')->unsigned();
            $table->integer('company_function_stamps');
            $table->integer('company_function_audit');
            $table->integer('company_function_adauth');
            $table->integer('company_function_syncdaemon');
            $table->foreign('company_function')->references('id')->on('company');
            $table->foreign('company_function_builder')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('company_select_function');
    }
}
