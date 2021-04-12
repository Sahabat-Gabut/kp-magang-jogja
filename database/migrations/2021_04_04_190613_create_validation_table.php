<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateValidationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('validation', function (Blueprint $table) {
            $table->id('id_validation');
            $table->unsignedBigInteger('id_admin');
            $table->unsignedBigInteger('id_team');
            $table->unsignedBigInteger('id_agency');
            $table->date('result_date');
            $table->date('start_date');
            $table->string('field_supervisor',50);
            $table->string('response_letter',255);
            $table->date('finish');

            $table->foreign('id_admin')->references('id_admin')->on('admin');
            $table->foreign('id_team')->references('id_team')->on('team_apprentice');
            $table->foreign('id_agency')->references('id_agency')->on('agency');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('validation');
    }
}
