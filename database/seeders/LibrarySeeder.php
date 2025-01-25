<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Library;

class LibrarySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $libraries = [
            [
                'name' => 'Biblioteca Nacional de Chile',
                'email' => 'consultas.bn@bibliotecanacional.gob.cl',
                'phone' => '+56223605400',
                'address' => 'Av. Libertador Bernardo O\'Higgins 651, Santiago, Región Metropolitana',
            ],
            [
                'name' => 'Biblioteca de Santiago',
                'email' => 'info@bibliotecadesantiago.cl',
                'phone' => '+56227771700',
                'address' => 'Matucana 151, Santiago, Región Metropolitana',
            ],
            [
                'name' => 'Biblioteca Regional de Antofagasta',
                'email' => 'biblioteca.antofagasta@bibliotecaspublicas.gob.cl',
                'phone' => '+56552251308',
                'address' => '14 de Febrero 2572, Antofagasta, Región de Antofagasta',
            ],
            [
                'name' => 'Biblioteca Regional de Valparaíso Santiago Severín',
                'email' => 'biblioteca.valparaiso@bibliotecaspublicas.gob.cl',
                'phone' => '+56322217257',
                'address' => 'Plaza Simón Bolívar 1653, Valparaíso, Región de Valparaíso',
            ],
            [
                'name' => 'Biblioteca Regional de La Araucanía',
                'email' => 'biblioteca.araucania@bibliotecaspublicas.gob.cl',
                'phone' => '+56452212131',
                'address' => 'Av. Balmaceda 2815, Temuco, Región de La Araucanía',
            ],
            [
                'name' => 'Biblioteca Pública Municipal de Providencia',
                'email' => 'biblioteca@providencia.cl',
                'phone' => '+56222360635',
                'address' => 'Av. Providencia 1590, Providencia, Región Metropolitana',
            ],
            [
                'name' => 'Biblioteca Municipal de Concepción',
                'email' => 'biblioteca@concepcion.cl',
                'phone' => '+56412224677',
                'address' => 'Víctor Lamas 615, Concepción, Región del Biobío',
            ],
            [
                'name' => 'Biblioteca Regional de Coquimbo',
                'email' => 'biblioteca.coquimbo@bibliotecaspublicas.gob.cl',
                'phone' => '+56512213189',
                'address' => 'Juan José Latorre 782, La Serena, Región de Coquimbo',
            ],
            [
                'name' => 'Biblioteca Municipal de Viña del Mar',
                'email' => 'biblioteca@munivina.cl',
                'phone' => '+56322184759',
                'address' => 'Plaza José Francisco Vergara s/n, Viña del Mar, Región de Valparaíso',
            ],
            [
                'name' => 'Biblioteca Municipal de Puerto Montt',
                'email' => 'biblioteca@puertomontt.cl',
                'phone' => '+56652254961',
                'address' => 'Antonio Varas 810, Puerto Montt, Región de Los Lagos',
            ],
            [
                'name' => 'Biblioteca Municipal de Rancagua',
                'email' => 'biblioteca@rancagua.cl',
                'phone' => '+56722355400',
                'address' => 'Estado 685, Rancagua, Región del Libertador General Bernardo O\'Higgins',
            ],
            [
                'name' => 'Biblioteca Municipal de Punta Arenas',
                'email' => 'biblioteca@puntaarenas.cl',
                'phone' => '+56612244716',
                'address' => 'Magallanes 842, Punta Arenas, Región de Magallanes',
            ],
            [
                'name' => 'Biblioteca Municipal de Arica',
                'email' => 'biblioteca@municipalidadarica.cl',
                'phone' => '+56582231613',
                'address' => '18 de Septiembre 485, Arica, Región de Arica y Parinacota',
            ]
        ];

        foreach ($libraries as $library) {
            Library::create($library);
        }
    }
}
