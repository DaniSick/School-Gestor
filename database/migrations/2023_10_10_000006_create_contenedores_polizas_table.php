<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContenedoresPolizasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contenedores_polizas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('empresa_id');
            $table->unsignedBigInteger('tipo_poliza_id');
            $table->string('descripcion');
            $table->date('fecha');
            $table->decimal('total_cargos', 15, 2)->default(0);
            $table->decimal('total_abonos', 15, 2)->default(0);
            $table->boolean('finalizado')->default(false);
            $table->timestamps();

            $table->foreign('empresa_id')->references('id')->on('empresas')->onDelete('cascade');
            $table->foreign('tipo_poliza_id')->references('id')->on('tipos_polizas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contenedores_polizas');
    }
}
