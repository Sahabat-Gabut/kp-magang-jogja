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
            $table->unsignedBigInteger('id_appren');
            $table->timestampTz('first_timesheet');
            $table->timestampTz('last_timesheet');
            $table->string('status_early',20);
            $table->string('status_finish',20);

            $table->foreign('id_appren')->references('id_appren')->on('apprentice');
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
