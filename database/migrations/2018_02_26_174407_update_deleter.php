<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateDeleter extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('company', function (Blueprint $table) {
            $table->integer('deleter')->nullable();
        });

        Schema::table('company_contract', function (Blueprint $table) {
            $table->integer('deleter')->nullable();
        });

        Schema::table('company_applicant', function (Blueprint $table) {
            $table->integer('deleter')->nullable();
        });

        Schema::table('company_server_info', function (Blueprint $table) {
            $table->integer('deleter')->nullable();
        });

        Schema::table('license', function (Blueprint $table) {
            $table->integer('deleter')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('company', function (Blueprint $table) {
            $table->dropColumn('deleter');
        });

        Schema::table('company_contract', function (Blueprint $table) {
            $table->dropColumn('deleter');
        });

        Schema::table('company_applicant', function (Blueprint $table) {
            $table->dropColumn('deleter');
        });

        Schema::table('company_server_info', function (Blueprint $table) {
            $table->dropColumn('deleter');
        });

        Schema::table('license', function (Blueprint $table) {
            $table->dropColumn('deleter');
        });
    }
}
