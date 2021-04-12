<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApprenticeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apprentice', function (Blueprint $table) {
            $table->id('id_appren');
            $table->unsignedBigInteger('id_jss');
            $table->unsignedBigInteger('id_team');
            $table->string('cv');
            $table->string('imgSrc',255);

            $table->foreign('id_jss')->references('id')->on('jss_users');
            $table->foreign('id_team')->references('id_team')->on('team_apprentice');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('apprentice');
    }
}
