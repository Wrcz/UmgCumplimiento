<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaCumplimientoArticulo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cumplimiento_articulo', function (Blueprint $table) {
            $table->increments('idcumplimientoempresa');
            $table->integer('idregulacionempresa');
            $table->integer('idarticulo');
            $table->string('observacionescumplimiento');
            $table->date('fechacumplimiento');
            $table->boolean('estadocumplimiento');
            $table->timestamps();

            $table->foreign('idarticulo')->references('idarticulo')->on('regulacion_articulo')->ondelete('cascade');
            $table->foreign('idregulacionempresa')->references('idregulacionempresa')->on('regulacion_empresa')->ondelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cumplimiento_articulo');
    }
}
