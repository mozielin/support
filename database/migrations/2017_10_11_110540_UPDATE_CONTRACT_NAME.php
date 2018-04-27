<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UPDATECONTRACTNAME extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('company_contract', function (Blueprint $table) {
            $table->string('contract_title', 60); 
            $table->string('contract_status', 60);
            $table->string('contract_price', 60);
            $table->string('contract_quantity', 60);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('company_contract', function (Blueprint $table) {
            $table->dropColumn('contract_title');
            $table->dropColumn('contract_status');
            $table->dropColumn('contract_price');
            $table->dropColumn('contract_quantity');
        });
    }
}
