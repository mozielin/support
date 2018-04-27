<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UPDATEApplicant extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('company_applicant', function (Blueprint $table) {
           
            $table->string('applicant_name',60);
            $table->string('applicant_note',100)->nullable();
            
            
            $table->string('company_applicant_phone', 45)->nullable()->change();
            $table->string('company_applicant_mobile', 45)->nullable()->change();
            $table->string('company_applicant_email', 45)->nullable()->change();
            $table->string('company_applicant_dep', 45)->nullable()->change();
            $table->string('company_applicant_title', 45)->nullable()->change();


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('company_applicant', function ($table) { 

            $table->dropColumn('applicant_name');
            $table->dropColumn('applicant_note');
            
            $table->string('company_applicant_phone', 45)->change();
            $table->string('company_applicant_mobile', 45)->change();
            $table->string('company_applicant_email', 45)->change();
            $table->string('company_applicant_dep', 45)->change();
            $table->string('company_applicant_title', 45)->change();
            
         
            
        });
    }
}
