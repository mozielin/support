<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UPDATESeadmin extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::table('seadmin', function (Blueprint $table) {
			
            $table->renameColumn('text','com_id');
			$table->string('title',255)->nullable();
			$table->string('note',255)->nullable();
			$table->string('type',255)->nullable();
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::table('seadmin', function (Blueprint $table) {
            $table->renameColumn('com_id','text');
			$table->dropColumn('title');
			$table->dropColumn('note');
			$table->dropColumn('type');
		});
    }
}
