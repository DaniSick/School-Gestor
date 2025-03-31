<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CuentaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $empresaId = 1; // Asume que las cuentas pertenecen a la primera empresa

        $cuentas = [
            ['numero' => '1100', 'nombre' => 'Efectivo y Equivalentes', 'tipo' => 'acumulativa', 'children' => [
                ['numero' => '1101', 'nombre' => 'Caja', 'tipo' => 'detalle'],
                ['numero' => '1102', 'nombre' => 'Bancos', 'tipo' => 'detalle'],
            ]],
            ['numero' => '1200', 'nombre' => 'Cuentas por Cobrar', 'tipo' => 'acumulativa', 'children' => [
                ['numero' => '1201', 'nombre' => 'Clientes', 'tipo' => 'detalle'],
                ['numero' => '1202', 'nombre' => 'Documentos por Cobrar', 'tipo' => 'detalle'],
            ]],
            ['numero' => '1300', 'nombre' => 'Inventarios', 'tipo' => 'acumulativa', 'children' => [
                ['numero' => '1301', 'nombre' => 'Materias Primas', 'tipo' => 'detalle'],
                ['numero' => '1302', 'nombre' => 'Productos Terminados', 'tipo' => 'detalle'],
            ]],
            // ...continúa con el resto de las cuentas
        ];

        foreach ($cuentas as $cuenta) {
            $this->createCuenta($empresaId, null, $cuenta);
        }
    }

    private function createCuenta($empresaId, $parentId, $cuentaData)
    {
        $cuentaId = DB::table('cuentas')->insertGetId([
            'empresa_id' => $empresaId,
            'parent_id' => $parentId,
            'numero' => $cuentaData['numero'],
            'nombre' => $cuentaData['nombre'],
            'tipo' => $cuentaData['tipo'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        if (isset($cuentaData['children'])) {
            foreach ($cuentaData['children'] as $child) {
                $this->createCuenta($empresaId, $cuentaId, $child);
            }
        }
    }
}
