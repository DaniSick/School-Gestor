<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Empresa;
use App\Models\TipoPoliza;

class TipoPolizaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tiposPolizasBase = [
            ['tipo' => 'Eg', 'descripcion' => 'Egreso'],
            ['tipo' => 'Ig', 'descripcion' => 'Ingreso'],
            ['tipo' => 'Dr', 'descripcion' => 'Diario'],
        ];

        // Asignar los tipos de pólizas base a todas las empresas existentes
        $empresas = Empresa::all();

        if ($empresas->isEmpty()) {
            $this->command->info('No hay empresas registradas. El seeder no se ejecutará.');
            return;
        }

        foreach ($empresas as $empresa) {
            foreach ($tiposPolizasBase as $tipoPoliza) {
                TipoPoliza::updateOrCreate(
                    [
                        'empresa_id' => $empresa->id,
                        'tipo' => $tipoPoliza['tipo'],
                    ],
                    [
                        'descripcion' => $tipoPoliza['descripcion'],
                    ]
                );
            }
        }

        $this->command->info('Tipos de pólizas base creados con éxito.');
    }
}
