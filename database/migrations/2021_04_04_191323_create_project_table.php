<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project', function (Blueprint $table) {
            $table->id('id_project');
            $table->unsignedBigInteger('id_team');
            $table->string('name_project',255);
            $table->string('final_project',255);
            $table->text('explanation');
            $table->string('status_project',10);

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
        Schema::dropIfExists('project');
    }
}
