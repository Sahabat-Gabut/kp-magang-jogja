<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateValuationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('valuation', function (Blueprint $table) {
            $table->id();
            $table->foreignId('progress_project_id')->constrained('progress_project')->onUpdate('cascade')->onDelete('cascade');
            $table->tinyInteger('score');
            $table->text('description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('valuation');
    }
}
