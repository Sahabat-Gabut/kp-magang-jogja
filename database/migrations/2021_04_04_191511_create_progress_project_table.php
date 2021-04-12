<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgressProjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('progress_project', function (Blueprint $table) {
            $table->id('id_prog_project');
            $table->unsignedBigInteger('id_project');
            $table->timestampTz('datetime_input');
            $table->string('name_prog_project');
            $table->string('status_prog');

            $table->foreign('id_project')->references('id_project')->on('project');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('progress_project');
    }
}
