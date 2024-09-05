<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAutorizacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('autorizaciones', function (Blueprint $table) {
            $table->id();
            $table->integer('autciclo');
            $table->string('autvac','6');
            $table->string('autprod');
            $table->string('autprop');
            $table->integer('autdosis');
            $table->string('autprov');
            $table->string('autmun');
            $table->string('autloc');
            $table->string('autmotivo');
            $table->string('autlugar');
            $table->integer('tecid');
            $table->integer('autstatus');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('autorizaciones');
    }
}
