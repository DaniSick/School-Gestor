<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('menus')->insert([
            ['id' => 1, 'nombre' => 'Cuentas', 'parent_id' => null, 'ruta' => null],
            ['id' => 2, 'nombre' => 'Polizas', 'parent_id' => null, 'ruta' => null],
            ['id' => 3, 'nombre' => 'Empresas', 'parent_id' => null, 'ruta' => null],
            ['id' => 4, 'nombre' => 'Polizas', 'parent_id' => 2, 'ruta' => '/polizas'],
            ['id' => 5, 'nombre' => 'Tipos Polizas', 'parent_id' => 2, 'ruta' => '/tipos-polizas'],
            ['id' => 6, 'nombre' => 'Reportes', 'parent_id' => null, 'ruta' => '/reportes'],
            ['id' => 7, 'nombre' => 'Configuración', 'parent_id' => null, 'ruta' => '/configuracion'],
        ]);
    }
}
