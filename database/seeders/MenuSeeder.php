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
            ['id' => 4, 'nombre' => 'Empresas', 'parent_id' => 3, 'ruta' => '/empresas'],
            ['id' => 5, 'nombre' => 'Pólizas', 'parent_id' => 2, 'ruta' => '/tipos-polizas/{empresa_id}'],
            ['id' => 6, 'nombre' => 'Tipos de Pólizas', 'parent_id' => 2, 'ruta' => '/tipos-polizas/{empresa_id}'],
            ['id' => 7, 'nombre' => 'Reportes', 'parent_id' => null, 'ruta' => '/reportes'],
            ['id' => 8, 'nombre' => 'Configuración', 'parent_id' => null, 'ruta' => '/configuracion'],
            ['id' => 9, 'nombre' => 'Cuentas', 'parent_id' => 1, 'ruta' => '/cuentas/{empresa_id}'],
            ['id' => 10, 'nombre' => 'Inicio', 'parent_id' => 8, 'ruta' => '/dashboard'],
        ]);
    }
}
