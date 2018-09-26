<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReceipt extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receipt', function (Blueprint $table) {
            $table->increments('id');
            $table->date('rcpdate');
            $table->string('price');
            $table->string('rcpnum');
            $table->longText('note')->nullable();
            $table->integer('contract_id');
            $table->integer('company_id')->nullable();
            $table->integer('builder');
            $table->integer('updater')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('receipt');
    }
}
