<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJssTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jss', function (Blueprint $table) {
            $table->string('id');
            $table->char('NIK',17);
            $table->string('username',50);
            $table->string('fullname',100);
            $table->string('password',100);
            $table->string('email',100)->unique();
            $table->char('no_wa',15);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jss');
    }
}
