<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::insert([
            [
                'name' => 'Admin',
                'email' => 'admin@example.com',
                'password' => Hash::make('12345678'),
                'role_id' => 1, // Asegúrate de que este ID coincida con el Administrador en roles
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Fisioterapeuta',
                'email' => 'fisioterapeuta@example.com',
                'password' => Hash::make('12345678'),
                'role_id' => 2, // Asegúrate de que este ID coincida con Fisioterapeuta en roles
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
