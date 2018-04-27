<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UPDATEApplicantSoftdelete extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('company_applicant', function (Blueprint $table) {
            $table->softDeletes();
            $table->string('company_applicant_email2')->nullable();
            
        });

        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('company_applicant', function (Blueprint $table) {
            $table->dropColumn('deleted_at');
            $table->dropColumn('company_applicant_email2');
            
        });

    }
}
