<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
            $table->foreignId('apprentice_id')->constrained('apprentice')->onUpdate('cascade')->onDelete('cascade');
            $table->string('name');
            $table->string('description')->nullable();
            $table->enum('status', ['PENGEMBANGAN', 'SELESAI']);
            $table->string('link')->nullable();
            $table->timestampTz('date_of_created')->default(DB::raw('CURRENT_TIMESTAMP'));
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
