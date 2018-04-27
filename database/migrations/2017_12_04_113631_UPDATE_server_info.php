<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UPDATEServerInfo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('company_server_info', function (Blueprint $table) {
            
            
            $table->string('URL',255)->nullable();
            $table->softDeletes();
            $table->date('sync_at')->nullable();


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

            $table->dropColumn('URL');
            $table->dropColumn('deleted_at');
            $table->dropColumn('sync_at');
            
        });
    }
}
