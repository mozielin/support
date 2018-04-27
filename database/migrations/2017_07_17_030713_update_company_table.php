<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateCompanyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('company', function (Blueprint $table) {
		
		 $table->integer('com_industry_id')->unsigned();
        	 $table->foreign('com_industry_id')->references('id')->on('company_industry');
		 $table->integer('com_type_id')->unsigned();
		 $table->foreign('com_type_id')->references('id')->on('company_types');          
		 $table->integer('com_plan_id')->unsigned();
		 $table->foreign('com_plan_id')->references('id')->on('plan');

		 $table->integer('com_sales_id')->unsigned();
		 $table->foreign('com_sales_id')->references('id')->on('users');

		 $table->integer('com_builder_id')->unsigned();
		 $table->foreign('com_builder_id')->references('id')->on('users');
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
            $table->dropForeign('company_com_industry_id_foreign');
	    $table->dropForeign('company_com_type_id_foreign');
	    $table->dropForeign('company_com_plan_id_foreign');
	    $table->dropForeign('company_com_sales_id_foreign');
	    $table->dropForeign('company_com_builder_id_foreign');
        });
    }
}
