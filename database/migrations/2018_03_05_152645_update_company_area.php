<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateCompanyArea extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('company', function (Blueprint $table) {
            $table->integer('company_area')->nullable();
            $table->string('company_area2',45)->nullable();

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
             $table->dropColumn('company_area');
             $table->dropColumn('company_area2');
        });
    }
}
