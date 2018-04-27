<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdataServerInfo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('company_server_info', function (Blueprint $table) {
            $table->string('company_server_interip', 45)->nullable()->change();
            $table->string('company_server_extip', 45)->nullable()->change();
            $table->string('company_version_num', 45)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('company_server_info', function (Blueprint $table) {
            $table->string('company_server_interip', 45)->change();
            $table->string('company_server_extip', 45)->change();
            $table->string('company_version_num', 45)->change();
        });
    }
}
