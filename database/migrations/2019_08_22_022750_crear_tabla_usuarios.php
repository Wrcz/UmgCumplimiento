<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaUsuarios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->increments('idusuario');
            $table->Integer('idnivelusuario');
            $table->string('nombreusuario');
            $table->string('correoelectronico')->nullable();
            $table->string('password');
            $table->boolean('estadousuario');
            $table->timestamps();

            $table->foreign('idnivelusuario')->references('idnivelusuario')->on('usuarios_nivel')->ondelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuarios');
    }
}
