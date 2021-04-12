<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin', function (Blueprint $table) {
            $table->id('id_admin');
            $table->unsignedTinyInteger('id_role_admin');
            $table->unsignedBigInteger('id_jss');
            $table->string('imgSrc');

            $table->foreign('id_role_admin')->references('id_role_admin')->on('role_admin');
            $table->foreign('id_jss')->references('id')->on('jss_users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin');
    }
}
