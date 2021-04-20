<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendance', function (Blueprint $table) {
            $table->date('date_att')->primary();
            $table->foreignId('apprentice_id')->constrained('apprentice')->onUpdate('cascade')->onDelete('cascade');
            $table->timestampTz('first_timesheet')->nullable();
            $table->timestampTz('last_timesheet')->nullable();
            $table->string('status_early',20);
            $table->string('status_finish',20);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attendance');
    }
}
