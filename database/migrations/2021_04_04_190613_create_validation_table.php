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
            $table->foreignId('team_id')->constrained('team')->onUpdate('cascade')->onDelete('cascade');
            $table->date('result_date');
            $table->string('response_letter',255);
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
