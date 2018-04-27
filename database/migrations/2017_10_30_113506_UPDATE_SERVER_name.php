<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UPDATESERVERName extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('company_server_info', function (Blueprint $table) {
            $table->string('server_name', 45);
            $table->string('company_business_code', 45)->nullable()->change();
            $table->integer('company_server_update')->nullable(); 

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('company_server_info', function ($table) {          
            $table->dropColumn('server_name');
            $table->dropColumn('company_server_update');
            $table->string('company_business_code', 45)->change();

        });
    }
}
