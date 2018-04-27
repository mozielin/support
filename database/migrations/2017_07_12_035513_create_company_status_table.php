<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_status', function (Blueprint $table) {
            $table->increments('id');
            $table->string('company_status_name', 45);
            $table->integer('company_status')->unsigned();
            $table->integer('company_status_builder')->unsigned();
            $table->foreign('company_status')->references('id')->on('company');
            $table->foreign('company_status_builder')->references('id')->on('users');
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
        Schema::dropIfExists('company_status');
    }
}
