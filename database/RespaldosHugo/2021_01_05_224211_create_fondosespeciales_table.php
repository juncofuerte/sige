<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFondosespecialesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fondosespeciales', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->integer('flag_vigencia');
            $table->integer('flag_detiniciativa'); //indica si la iniciativa tiene detalle (0: global; 1: UE)
            $table->integer('flag_rbd');            //indica si la iniciativa es global o por UE (0: global; 1: UE)
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
        Schema::dropIfExists('fondosespeciales');
    }
}
