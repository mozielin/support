<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyContractTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_contract', function (Blueprint $table) {
            $table->increments('id');
            $table->string('company_contract_picture', 200);
            $table->date('company_contract_date');
            $table->date('company_contract_start');
            $table->date('company_contract_end');
            $table->date('company_contract_check')->nullable();
            $table->integer('company_contract')->unsigned();
            $table->integer('company_contract_builder')->unsigned();
            $table->foreign('company_contract')->references('id')->on('company');
            $table->foreign('company_contract_builder')->references('id')->on('users');
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
        Schema::dropIfExists('company_contract');
    }
}
