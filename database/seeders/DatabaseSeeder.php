<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Llamamos al seeder de roles
        $this->call(RoleSeeder::class);

        // Llamamos al seeder de usuarios
        $this->call(UserSeeder::class);
        $this->call(PacienteSeeder::class);
    }
}
