<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeamApprenticeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('team_apprentice', function (Blueprint $table) {
            $table->id();
            $table->foreignId('agency_id')->constrained('agency')->onUpdate('cascade')->onDelete('cascade');
            $table->string('status_hired')->default('SEDANG DIPROSES');
            $table->string('university');
            $table->string('departement');
            $table->string('proposal');
            $table->string('presentation');
            $table->string('cover_letter');
            $table->float('duration',2, 1);
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
        Schema::dropIfExists('team_apprentice');
    }
}
