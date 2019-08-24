<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaCumplimientoEvidencia extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cumplimiento_evidencia', function (Blueprint $table) {
          $table->increments('idevidenciacumplimiento');
          $table->integer('idcumplimientoempresa');
          $table->string('nombreevidencia');
          $table->binary('documentoevidencia');
          $table->string('observacionevidencia');
          $table->date('fechacargada');
          $table->timestamps();

            $table->foreign('idcumplimientoempresa')->references('idcumplimientoempresa')->on('cumplimiento_articulo')->ondelete('cascade');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cumplimiento_evidencia');
    }
}
