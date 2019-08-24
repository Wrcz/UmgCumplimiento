<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaUsuariosEmpresas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios_empresas', function (Blueprint $table) {
            $table->integer('idusuario');
            $table->integer('idempresa');
            $table->timestamps();

            $table->primary(['idusuario', 'idempresa']);
            $table->foreign('idusuario')->references('idusuario')->on('usuarios')->ondelete('cascade');
            $table->foreign('idempresa')->references('idempresa')->on('empresas')->ondelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuarios_empresas');
    }
}
