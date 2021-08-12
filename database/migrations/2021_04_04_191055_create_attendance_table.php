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
            $table->id();
            $table->timestampTz('start_attendance')->nullable();
            $table->timestampTz('end_attendance')->nullable();
            $table->foreignId('apprentice_id')->constrained('apprentice')->onUpdate('cascade')->onDelete('cascade');
            $table->enum('status', ['TEPAT WAKTU','TERLAMBAT','IZIN','SAKIT'])->nullable();
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
