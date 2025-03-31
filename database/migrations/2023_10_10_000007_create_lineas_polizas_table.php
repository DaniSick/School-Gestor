<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLineasPolizasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lineas_polizas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('contenedor_poliza_id');
            $table->unsignedBigInteger('cuenta_id');
            $table->text('descripcion')->nullable();
            $table->decimal('cargo', 15, 2)->default(0);
            $table->decimal('abono', 15, 2)->default(0);
            $table->timestamps();

            $table->foreign('contenedor_poliza_id')->references('id')->on('contenedores_polizas')->onDelete('cascade');
            $table->foreign('cuenta_id')->references('id')->on('cuentas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lineas_polizas');
    }
}
