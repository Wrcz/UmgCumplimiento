<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaRegulacionEmpresa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('regulacion_empresa', function (Blueprint $table) {
           $table->increments('idregulacionempresa');
            $table->integer('idempresa');
            $table->integer('idregulacion');
            $table->boolean('estadoregulacionempresa');
            $table->timestamps();


            $table->foreign('idempresa')->references('idempresa')->on('empresas')->ondelete('cascade');
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
        Schema::dropIfExists('regulacion_empresa');
    }
}
