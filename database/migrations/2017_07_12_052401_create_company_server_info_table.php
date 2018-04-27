<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyServerInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_server_info', function (Blueprint $table) {
            $table->increments('id');
            $table->string('company_server_mac', 45);
            $table->string('company_server_type', 45);
            $table->string('company_version_num', 45);
            $table->string('company_business_code', 45);
            $table->string('company_server_interip', 45);
            $table->string('company_server_extip', 45);
            $table->integer('company_server')->unsigned();
            $table->integer('company_server_builder')->unsigned();
            $table->foreign('company_server')->references('id')->on('company');
            $table->foreign('company_server_builder')->references('id')->on('users');
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
        Schema::dropIfExists('company_server_info');
    }
}
