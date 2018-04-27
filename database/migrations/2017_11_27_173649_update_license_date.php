<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateLicenseDate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('license', function (Blueprint $table) {
            
            $table->integer('builder_id');
            $table->integer('status_id');
            $table->date('start_at');
            $table->string('lic_name',100);
            $table->integer('update_id')->nullable();
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
        Schema::table('license', function ($table) { 

            $table->dropColumn('builder_id');
            $table->dropColumn('status_id');
            $table->dropColumn('start_at');
            $table->dropColumn('lic_name');
            $table->dropColumn('update_id');
            $table->dropColumn('deleted_at');
            
        });
    }
}
