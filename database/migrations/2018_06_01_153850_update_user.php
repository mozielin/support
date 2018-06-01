<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('title',50)->nullable();
            $table->string('mobile',50)->nullable();
            $table->string('phone',50)->nullable();
            $table->string('ext',20)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('title');
            $table->dropColumn('mobile');
            $table->dropColumn('phone');
            $table->dropColumn('ext');
        });
    }
}
