<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaRegulacion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('regulacion', function (Blueprint $table) {
            $table->increments('idregulacion');
            $table->string('identificacion');
            $table->string('nombreregulacion');
            $table->string('descripcionregulacion');
            $table->string('pais');
            $table->date('fechainiciovigencia')->nullable();
            $table->date('fechafinvigencia')->nullable();
            $table->boolean('estadoregulacion');
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
        Schema::dropIfExists('regulacion');
    }
}
