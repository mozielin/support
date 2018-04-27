<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyApplicantTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_applicant', function (Blueprint $table) {
            $table->increments('id');
   	        $table->integer('company_id')->unsigned();
            $table->string('company_applicant_phone', 45);
            $table->string('company_applicant_mobile', 45);
            $table->string('company_applicant_email', 45);
            $table->string('company_applicant_dep', 45);
            $table->string('company_applicant_title', 45);
            $table->integer('company_applicant_builder')->unsigned();
            $table->foreign('company_id')->references('id')->on('company');
            $table->foreign('company_applicant_builder')->references('id')->on('users');
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
        Schema::dropIfExists('company_applicant');
    }
}
