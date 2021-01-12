<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIniciativasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('iniciativas', function (Blueprint $table) {
            $table->id();
            $table->text('nombre');
            $table->integer('flag_vigencia');
            $table->text('descripcion')->nullable();
            $table->string('rbd')->nullable();
            $table->unsignedBigInteger('componente_id');
            $table->foreign('componente_id')
                    ->references('id')
                    ->on('componentes')
                    ->onDelete('cascade');      
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
        Schema::dropIfExists('iniciativas');
    }
}
