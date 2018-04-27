<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UPDATECompany extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('company', function (Blueprint $table) {
            $table->string('company_code', 45)->nullable();         
            $table->string('company_cel', 45)->nullable()->change();
            $table->string('company_url', 45)->nullable()->change();
            $table->string('company_population', 45)->nullable()->change();
            $table->integer('company_capital')->nullable()->change();
            $table->integer('company_EIN')->nullable()->change();
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
            $table->dropColumn('company_code');
            $table->string('company_cel', 45)->change();
            $table->string('company_url', 45)->change();
            $table->string('company_population', 45)->change();
            $table->integer('company_capital')->change();
            $table->integer('company_EIN')->change();
        });
    }
}
