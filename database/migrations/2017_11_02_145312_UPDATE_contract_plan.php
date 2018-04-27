<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UPDATEContractPlan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('company_contract', function (Blueprint $table) {
           
            $table->integer('contract_plan');
            $table->softDeletes(); 

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('company_contract', function ($table) { 

            $table->dropColumn('contract_plan');
            $table->dropColumn('deleted_at');
            
        });
    }
}
