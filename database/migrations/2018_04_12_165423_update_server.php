<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateServer extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('company_server_info', function (Blueprint $table) {
            $table->string('sync_ver', 45)->nullable();   
            $table->string('build_type', 45)->nullable();
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
            $table->dropColumn('sync_ver');
            $table->dropColumn('build_type');
        });
    }
}
