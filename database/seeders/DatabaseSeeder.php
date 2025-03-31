<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            MenuSeeder::class,  // Asegurarse de que se incluya MenuSeeder
            EmpresaSeeder::class,
            TipoPolizaSeeder::class,
        ]);
    }
}
