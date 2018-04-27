<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TLCAlert extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seadmin', function (Blueprint $table) {
            $table->increments('id');
            $table->string('company_name', 45);
            $table->date('company_tlc_start');
            $table->date('company_tlc_end');
            $table->string('text')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('seadmin');
    }
}
