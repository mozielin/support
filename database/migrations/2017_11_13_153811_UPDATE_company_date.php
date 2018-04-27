<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UPDATECompanyDate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('company', function (Blueprint $table) {
            $table->date('company_create')->nullable();         
            $table->string('company_engname', 60)->nullable();
            $table->integer('company_status')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('company', function ($table) {          
            $table->dropColumn('company_create');
            $table->dropColumn('company_engname');
            $table->dropColumn('company_status');
            
        });
    }
}
