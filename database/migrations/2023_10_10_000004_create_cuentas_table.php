<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCuentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cuentas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('empresa_id');
            $table->unsignedBigInteger('parent_id')->nullable(); // Relación para jerarquía
            $table->string('numero'); // Número de la cuenta
            $table->string('nombre'); // Nombre de la cuenta
            $table->enum('tipo', ['acumulativa', 'detalle']); // Tipo de cuenta
            $table->decimal('haber', 15, 2)->default(0); // Total haber (créditos)
            $table->decimal('cargo', 15, 2)->default(0); // Total cargo (débitos)
            $table->timestamps();

            $table->foreign('empresa_id')->references('id')->on('empresas')->onDelete('cascade');
            $table->foreign('parent_id')->references('id')->on('cuentas')->onDelete('cascade');
            $table->unique(['empresa_id', 'numero']); // Índice compuesto para garantizar unicidad por empresa
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cuentas');
    }
}
