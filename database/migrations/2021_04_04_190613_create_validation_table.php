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
            $table->id();
            $table->foreignId('admin_id')->constrained('admin')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('team_apprentice_id')->constrained('team_apprentice')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('agency_id')->constrained('agency')->onUpdate('cascade')->onDelete('cascade');
            $table->date('result_date');
            $table->date('start_date');
            $table->string('field_supervisor',50);
            $table->string('response_letter',255);
            $table->date('finish');
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
