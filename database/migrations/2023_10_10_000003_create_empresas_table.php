<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpresasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->unique();
            $table->string('razon_social');
            $table->string('rfc')->unique();
            $table->string('direccion');
            $table->string('telefono');
            $table->string('email');
            $table->string('representante_legal');
            $table->date('fecha_creacion');
            $table->boolean('estatus')->default(true);
            $table->timestamps();

            // Índices adicionales
            $table->index('nombre');
            $table->index('rfc');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('empresas');
    }
}
