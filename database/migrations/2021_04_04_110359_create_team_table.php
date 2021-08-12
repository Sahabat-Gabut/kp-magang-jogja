<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeamTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('team', function (Blueprint $table) {
            $table->id();
            $table->foreignId('admin_id')->nullable()->constrained('admin')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('agency_id')->constrained('agency')->onUpdate('cascade')->onDelete('cascade');
            $table->enum('status', ['SEDANG DIPROSES','DITERIMA', 'DITOLAK', 'SELESAI'])->default('SEDANG DIPROSES');
            $table->string('university');
            $table->string('departement');
            $table->string('proposal');
            $table->string('presentation');
            $table->string('cover_letter');
            $table->date('date_start');
            $table->date('date_finish');
            $table->date('date_of_created');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('team');
    }
}
