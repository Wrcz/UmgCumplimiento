<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaRegulacionSancion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('regulacion_sancion', function (Blueprint $table) {
            $table->increments('idsancion');
            $table->integer('idarticulo');
            $table->string('descripcionsancion');
            $table->boolean('estadosancion');
            $table->timestamps();

            $table->foreign('idarticulo')->references('idarticulo')->on('regulacion_articulo')->ondelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('regulacion_sancion');
    }
}
