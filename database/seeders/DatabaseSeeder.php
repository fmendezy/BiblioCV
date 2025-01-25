<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            LibrarySeeder::class,
            UserSeeder::class,
            CurriculumSeeder::class,
            SpecificUserSeeder::class,
        ]);

        // Creamos el usuario administrador por defecto
        User::create([
            'name' => 'Administrador BiblioCV',
            'email' => 'administrador@bibliocv.cl',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'rut' => '11111110-3',
            'library_id' => 1, // ID de la Biblioteca Municipal de Paine
        ]);
    }
}
