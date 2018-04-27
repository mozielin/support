<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CREATEUploadmutifile extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contract_file', function (Blueprint $table) {
            $table->increments('id');
            $table->string('file_name', 255);
            $table->integer('contract_id');
            $table->integer('file_builder');
            $table->integer('file_updateby')->nullable();
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
        Schema::dropIfExists('contract_file');
    }
}
