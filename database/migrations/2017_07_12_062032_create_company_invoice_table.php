<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyInvoiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_invoice', function (Blueprint $table) {
            $table->increments('id');
            $table->string('company_invoice_num', 45);
            $table->string('company_invoice_text', 45);
            $table->integer('company_invoice')->unsigned();
            $table->integer('company_invoice_builder')->unsigned();
            $table->foreign('company_invoice')->references('id')->on('company');
            $table->foreign('company_invoice_builder')->references('id')->on('users');
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
        Schema::dropIfExists('company_invoice');
    }
}
