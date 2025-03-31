<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class, // Seeder de roles
            UserSeeder::class, // Seeder de usuarios
            MenuSeeder::class,
            EmpresaSeeder::class,
            TipoPolizaSeeder::class, // Seeder de tipos de pólizas
        ]);
    }
}
