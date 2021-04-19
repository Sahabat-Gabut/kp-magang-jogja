<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApprenticeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apprentice', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jss_id')->constrained('jss')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('team_apprentice_id')->constrained('team_apprentice')->onUpdate('cascade')->onDelete('cascade');
            $table->char('npm');
            $table->string('cv');
            $table->string('imgSrc')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('apprentice');
    }
}
