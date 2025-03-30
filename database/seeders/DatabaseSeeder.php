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
        // Crear roles
        DB::table('roles')->insertOrIgnore([
            ['id' => 1, 'name' => 'Admin', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'name' => 'User', 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Crear un usuario de prueba con rol de Admin
        User::create([
            'name' => 'Admin User',
            'ap1' => 'Example',
            'ap2' => 'Admin',
            'email' => 'admin@example.com',
            'curp' => 'ADMINCURP123456', // Asegúrate de que este CURP sea único
            'sexo' => 1,
            'id_rol' => 1, // Rol de Admin
            'password' => Hash::make('password'),
        ]);
    }
}
