<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            // Biblioteca Nacional de Chile (library_id: 1)
            [
                'name' => 'Roberto Antonio González Silva',
                'email' => 'rgonzalez@bibliotecanacional.gob.cl',
                'password' => Hash::make('password'),
                'rut' => '11111111-1',
                'role' => 'employee',
                'library_id' => 1
            ],
            [
                'name' => 'María José Vargas Pinto',
                'email' => 'mvargas@bibliotecanacional.gob.cl',
                'password' => Hash::make('password'),
                'rut' => '11111112-K',
                'role' => 'employee',
                'library_id' => 1
            ],
            [
                'name' => 'Felipe Andrés Rojas Muñoz',
                'email' => 'frojas@bibliotecanacional.gob.cl',
                'password' => Hash::make('password'),
                'rut' => '11111113-8',
                'role' => 'employee',
                'library_id' => 1
            ],

            // Biblioteca de Santiago (library_id: 2)
            [
                'name' => 'Marcela Alejandra Soto Vidal',
                'email' => 'msoto@bibliotecadesantiago.cl',
                'password' => Hash::make('password'),
                'rut' => '11111114-6',
                'role' => 'employee',
                'library_id' => 2
            ],
            [
                'name' => 'Juan Carlos Pérez Muñoz',
                'email' => 'jperez@bibliotecadesantiago.cl',
                'password' => Hash::make('password'),
                'rut' => '11111115-4',
                'role' => 'employee',
                'library_id' => 2
            ],

            // Biblioteca Regional de Antofagasta (library_id: 3)
            [
                'name' => 'Patricia Andrea Cortés Díaz',
                'email' => 'pcortes@bibliotecaspublicas.gob.cl',
                'password' => Hash::make('password'),
                'rut' => '11111116-2',
                'role' => 'employee',
                'library_id' => 3
            ],
            [
                'name' => 'Diego Alejandro Fuentes Soto',
                'email' => 'dfuentes@bibliotecaspublicas.gob.cl',
                'password' => Hash::make('password'),
                'rut' => '11111117-0',
                'role' => 'employee',
                'library_id' => 3
            ],

            // Biblioteca Regional de Valparaíso (library_id: 4)
            [
                'name' => 'Camila Fernanda Herrera Vega',
                'email' => 'cherrera@bibliotecaspublicas.gob.cl',
                'password' => Hash::make('password'),
                'rut' => '11111118-9',
                'role' => 'employee',
                'library_id' => 4
            ],

            // Biblioteca Regional de La Araucanía (library_id: 5)
            [
                'name' => 'Sebastián Ignacio Morales Parra',
                'email' => 'smorales@bibliotecaspublicas.gob.cl',
                'password' => Hash::make('password'),
                'rut' => '11111119-7',
                'role' => 'employee',
                'library_id' => 5
            ],
            [
                'name' => 'Valentina Paz Castro Rivas',
                'email' => 'vcastro@bibliotecaspublicas.gob.cl',
                'password' => Hash::make('password'),
                'rut' => '11111120-0',
                'role' => 'employee',
                'library_id' => 5
            ],

            // Biblioteca Municipal de Providencia (library_id: 6)
            [
                'name' => 'Rodrigo Alberto Silva Contreras',
                'email' => 'rsilva@providencia.cl',
                'password' => Hash::make('password'),
                'rut' => '11111121-9',
                'role' => 'employee',
                'library_id' => 6
            ],
            [
                'name' => 'Ana María López Torres',
                'email' => 'alopez@providencia.cl',
                'password' => Hash::make('password'),
                'rut' => '11111122-7',
                'role' => 'employee',
                'library_id' => 6
            ],

            // Biblioteca Municipal de Concepción (library_id: 7)
            [
                'name' => 'Cristóbal Andrés Muñoz Araya',
                'email' => 'cmunoz@concepcion.cl',
                'password' => Hash::make('password'),
                'rut' => '11111123-5',
                'role' => 'employee',
                'library_id' => 7
            ],

            // Biblioteca Regional de Coquimbo (library_id: 8)
            [
                'name' => 'Isabel Margarita Ramírez Flores',
                'email' => 'iramirez@bibliotecaspublicas.gob.cl',
                'password' => Hash::make('password'),
                'rut' => '11111124-3',
                'role' => 'employee',
                'library_id' => 8
            ],
            [
                'name' => 'Jorge Eduardo Vera Campos',
                'email' => 'jvera@bibliotecaspublicas.gob.cl',
                'password' => Hash::make('password'),
                'rut' => '11111125-1',
                'role' => 'employee',
                'library_id' => 8
            ],

            // Biblioteca Municipal de Viña del Mar (library_id: 9)
            [
                'name' => 'Paula Andrea Mendoza Ruiz',
                'email' => 'pmendoza@munivina.cl',
                'password' => Hash::make('password'),
                'rut' => '11111126-K',
                'role' => 'employee',
                'library_id' => 9
            ],
            [
                'name' => 'Daniel Alejandro Torres Vidal',
                'email' => 'dtorres@munivina.cl',
                'password' => Hash::make('password'),
                'rut' => '11111127-8',
                'role' => 'employee',
                'library_id' => 9
            ],

            // Biblioteca Municipal de Puerto Montt (library_id: 10)
            [
                'name' => 'Carmen Gloria Sánchez Mora',
                'email' => 'csanchez@puertomontt.cl',
                'password' => Hash::make('password'),
                'rut' => '11111128-6',
                'role' => 'employee',
                'library_id' => 10
            ],

            // Biblioteca Municipal de Rancagua (library_id: 11)
            [
                'name' => 'Francisco Javier Navarro Soto',
                'email' => 'fnavarro@rancagua.cl',
                'password' => Hash::make('password'),
                'rut' => '11111129-4',
                'role' => 'employee',
                'library_id' => 11
            ],
            [
                'name' => 'Catalina Paz Ortiz Vega',
                'email' => 'cortiz@rancagua.cl',
                'password' => Hash::make('password'),
                'rut' => '11111130-8',
                'role' => 'employee',
                'library_id' => 11
            ],

            // Biblioteca Municipal de Punta Arenas (library_id: 12)
            [
                'name' => 'Andrés Eduardo Pizarro Rojas',
                'email' => 'apizarro@puntaarenas.cl',
                'password' => Hash::make('password'),
                'rut' => '11111131-6',
                'role' => 'employee',
                'library_id' => 12
            ],

            // Biblioteca Municipal de Arica (library_id: 13)
            [
                'name' => 'Constanza Belén Araya Díaz',
                'email' => 'caraya@municipalidadarica.cl',
                'password' => Hash::make('password'),
                'rut' => '11111132-4',
                'role' => 'employee',
                'library_id' => 13
            ],
            [
                'name' => 'Matías Ignacio Bravo Lagos',
                'email' => 'mbravo@municipalidadarica.cl',
                'password' => Hash::make('password'),
                'rut' => '11111133-2',
                'role' => 'employee',
                'library_id' => 13
            ]
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
} 
