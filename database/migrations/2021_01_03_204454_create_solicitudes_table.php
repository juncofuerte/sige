<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSolicitudesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicitudes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->integer('estadologico');
            $table->integer('ptoactual');
            $table->integer('ptoanterior');
            $table->integer('estado');
            $table->integer('idusuario');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');            
            $table->unsignedBigInteger('tipocompra_id');
            $table->foreign('tipocompra_id')->references('id')->on('tipocompras');
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
        Schema::dropIfExists('solicitudes');
    }
}
