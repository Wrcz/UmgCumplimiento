<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaRegulacionArticulo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('regulacion_articulo', function (Blueprint $table) {
            $table->increments('idarticulo');
            $table->integer('idregulacion');
            $table->integer('idseccion');
            $table->string('numeroarticulo');
            $table->integer('ordenarticulo');
            $table->string('tituloarticulo');
            $table->string('descripcionarticulo');
            $table->date('fechainiciovigencia')>nullable();
            $table->date('fechafinvigencia')>nullable();
            $table->boolean('estadoarticulo');
            $table->timestamps();

            $table->foreign('idregulacion')->references('idregulacion')->on('regulacion')->ondelete('cascade');
            $table->foreign('idseccion')->references('idseccion')->on('regulacion_seccion')->ondelete('cascade');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('regulacion_articulo');
    }
}
