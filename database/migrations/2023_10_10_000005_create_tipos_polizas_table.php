<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTiposPolizasTable extends Migration
{
    public function up()
    {
        Schema::create('tipos_polizas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('empresa_id');
            $table->string('tipo');
            $table->text('descripcion')->nullable();
            $table->timestamps();

            $table->foreign('empresa_id')->references('id')->on('empresas')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('tipos_polizas');
    }
}
