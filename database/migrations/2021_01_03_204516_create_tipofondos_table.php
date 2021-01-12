<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTipofondosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipofondos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('descripcion');
            $table->integer('flag_vigencia');   //si el tipo de fondo está vigente (0:no vigente, 1: vigente)
            $table->integer('flag_especial');  //si fondo tiene componentes e iniciativas (0:sin componentes, 1: con componentes)
            $table->integer('flag_rbd');      //si la iniciativa es global o por UE (0: global; 1: UE)
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
        Schema::dropIfExists('tipofondos');
    }
}
