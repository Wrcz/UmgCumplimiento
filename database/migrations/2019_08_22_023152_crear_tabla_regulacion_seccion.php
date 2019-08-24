<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaRegulacionSeccion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('regulacion_seccion', function (Blueprint $table) {
            $table->increments('idseccion');
            $table->integer('idregulacion');
            $table->string('noseccion');
            $table->string('tituloseccion');
            $table->string('descripcionseccion');
            $table->boolean('estadoseccion');
            $table->timestamps();

            $table->foreign('idregulacion')->references('idregulacion')->on('regulacion')->ondelete('cascade');
                  });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('regulacion_seccion');
    }
}
