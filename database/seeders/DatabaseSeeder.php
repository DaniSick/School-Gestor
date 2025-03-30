<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Crear un rol con id = 1 si no existe
        DB::table('roles')->insertOrIgnore([
            'id' => 1,
            'name' => 'Admin', // Ajusta el nombre del rol según tu lógica
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Crear un usuario de prueba con todos los campos requeridos
        User::create([
            'name' => 'Test User',
            'ap1' => 'Example',
            'ap2' => 'User',
            'email' => 'testexample@example.com',
            'curp' => 'TESTCURP123456',
            'sexo' => 'M',
            'id_rol' => 1, // Asegúrate de que este id exista en la tabla roles
            'password' => Hash::make('password'),
        ]);
    }
}
