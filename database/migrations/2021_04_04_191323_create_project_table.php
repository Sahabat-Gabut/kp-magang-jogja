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
            $table->id();
            $table->foreignId('team_apprentice_id')->constrained('team_apprentice')->onUpdate('cascade')->onDelete('cascade');
            $table->string('name_project',255);
            $table->string('final_project',255)->nullable();
            $table->text('explanation');
            $table->string('status_project',10)->nullable();
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
