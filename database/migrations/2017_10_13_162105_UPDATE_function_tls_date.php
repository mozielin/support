<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UPDATEFunctionTlsDate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('company_select_function', function (Blueprint $table) {
            $table->boolean('company_function_tlc'); 
            $table->dateTime('function_tlc_start');
            $table->dateTime('function_tlc_end');
            $table->boolean('company_function_stamps')->change();
            $table->boolean('company_function_audit')->change();
            $table->boolean('company_function_adauth')->change();
            $table->boolean('company_function_syncdaemon')->change();    

            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('company_select_function', function (Blueprint $table) {
            $table->dropColumn('company_function_tlc');
            $table->dropColumn('function_tlc_start');
            $table->dropColumn('function_tlc_end');
            $table->integer('company_function_stamps')->change();
            $table->integer('company_function_audit')->change();
            $table->integer('company_function_adauth')->change();
            $table->integer('company_function_syncdaemon')->change();
        });
    }
}
