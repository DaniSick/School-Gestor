<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Admin',
                'ap1' => 'Admin',
                'ap2' => 'Admin',
                'email' => 'admin@example.com',
                'curp' => null,
                'sexo' => 1,
                'id_rol' => 1, // Admin role
                'password' => Hash::make('password'), // Default password
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'User',
                'ap1' => 'User',
                'ap2' => 'User',
                'email' => 'user@example.com',
                'curp' => null,
                'sexo' => 2,
                'id_rol' => 2, // User role
                'password' => Hash::make('password'), // Default password
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
