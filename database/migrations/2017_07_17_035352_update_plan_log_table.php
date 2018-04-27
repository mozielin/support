<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdatePlanLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('plan_log', function (Blueprint $table) {
	    $table->integer('logplan_id')->unsigned();
            $table->foreign('logplan_id')->references('id')->on('plan');

	    $table->integer('logcompany_id')->unsigned();
	    $table->foreign('logcompany_id')->references('id')->on('company');
	
	    $table->integer('logbuilder_id')->unsigned();
	    $table->foreign('logbuilder_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('plan_log', function (Blueprint $table) {
            $table->dropForeign('plan_log_logplan_id_foreign');
	    $table->dropForeign('plan_log_logcompany_id_foreign');
	    $table->dropForeign('plan_log_logbuilder_id_foreign');
        });
    }
}
