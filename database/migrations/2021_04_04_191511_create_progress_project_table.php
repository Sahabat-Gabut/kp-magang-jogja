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
            $table->id();
            $table->foreignId('project_id')->constrained('project')->onUpdate('cascade')->onDelete('cascade');
            $table->string('name');
            $table->string('explanation');
            $table->string('status');
            $table->string('file');
            $table->timestampTz('date_of_created');
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
