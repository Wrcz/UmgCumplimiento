<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaNivelusuarioMenu extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nivelusuario_menu', function (Blueprint $table) {
            $table->integer('idopcionmenu');
            $table->integer('idnivelusuario');
            $table->timestamps();

            $table->primary(['idopcionmenu', 'idnivelusuario']);
            $table->foreign('idopcionmenu')->references('idopcionmenu')->on('opciones_menu')->ondelete('cascade');
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
        Schema::dropIfExists('nivelusuario_menu');
    }
}
