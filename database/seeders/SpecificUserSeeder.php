<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Curriculum;
use Carbon\Carbon;

class SpecificUserSeeder extends Seeder
{
    public function run()
    {
        // Crear el usuario específico
        $user = User::create([
            'name' => 'Juan Pérez Soto',
            'email' => 'juan.perez@gmail.com',
            'password' => bcrypt('password'),
            'rut' => '98765430-5',
            'role' => 'user',
            'library_id' => 1, // Biblioteca Nacional
        ]);

        // Primer CV - 2022 (Un trabajo)
        $cv1 = Curriculum::create([
            'rut' => '98765430-5',
            'name' => 'Juan Pérez Soto',
            'email' => 'juan.perez@gmail.com',
            'phone' => '+56912345678',
            'birthdate' => '1990-05-15',
            'marital_status' => 'Soltero',
            'job_title' => 'Desarrollador Web Junior',
            'profile_summary' => 'Desarrollador web con experiencia inicial en tecnologías frontend y backend. Apasionado por aprender nuevas tecnologías y resolver problemas.',
            'user_id' => $user->id,
            'created_at' => '2022-03-15 10:30:00',
            'updated_at' => '2022-03-15 10:30:00'
        ]);

        // Educación
        $cv1->educations()->createMany([
            [
                'institution' => 'Universidad de Chile',
                'degree' => 'Ingeniería en Informática',
                'start_date' => '2015-03-01',
                'end_date' => '2020-12-15'
            ]
        ]);

        // Experiencia (primer trabajo)
        $cv1->experiences()->create([
            'company' => 'TechStart SpA',
            'position' => 'Desarrollador Web Junior',
            'start_date' => '2022-01-01',
            'end_date' => '2022-12-31',
            'description' => 'Desarrollo de aplicaciones web usando PHP y JavaScript. Mantenimiento de sistemas existentes.'
        ]);

        // Habilidades iniciales
        $cv1->skills()->createMany([
            ['name' => 'HTML5'],
            ['name' => 'CSS3'],
            ['name' => 'JavaScript'],
            ['name' => 'PHP'],
            ['name' => 'MySQL']
        ]);

        // Referencias
        $cv1->references()->createMany([
            [
                'name' => 'Carlos Ruiz',
                'relation' => 'Tech Lead en TechStart SpA',
                'contact' => '+56987654321'
            ]
        ]);

        // Segundo CV - 2023 (Dos trabajos)
        $cv2 = Curriculum::create([
            'rut' => '98765430-5',
            'name' => 'Juan Pérez Soto',
            'email' => 'juan.perez@gmail.com',
            'phone' => '+56912345678',
            'birthdate' => '1990-05-15',
            'marital_status' => 'Soltero',
            'job_title' => 'Desarrollador Web Semi Senior',
            'profile_summary' => 'Desarrollador web con experiencia en desarrollo full-stack. Especializado en Laravel y React. Enfocado en crear soluciones escalables y mantenibles.',
            'user_id' => $user->id,
            'created_at' => '2023-04-20 14:45:00',
            'updated_at' => '2023-04-20 14:45:00'
        ]);

        // Misma educación
        $cv2->educations()->createMany([
            [
                'institution' => 'Universidad de Chile',
                'degree' => 'Ingeniería en Informática',
                'start_date' => '2015-03-01',
                'end_date' => '2020-12-15'
            ]
        ]);

        // Experiencias acumuladas
        $cv2->experiences()->createMany([
            [
                'company' => 'WebSolutions Chile',
                'position' => 'Desarrollador Web Semi Senior',
                'start_date' => '2023-01-01',
                'end_date' => '2023-12-31',
                'description' => 'Desarrollo de aplicaciones web empresariales usando Laravel y React. Implementación de APIs RESTful.'
            ],
            [
                'company' => 'TechStart SpA',
                'position' => 'Desarrollador Web Junior',
                'start_date' => '2022-01-01',
                'end_date' => '2022-12-31',
                'description' => 'Desarrollo de aplicaciones web usando PHP y JavaScript. Mantenimiento de sistemas existentes.'
            ]
        ]);

        // Habilidades aumentadas
        $cv2->skills()->createMany([
            ['name' => 'Laravel'],
            ['name' => 'React'],
            ['name' => 'Node.js'],
            ['name' => 'Docker'],
            ['name' => 'Git']
        ]);

        // Referencias actualizadas
        $cv2->references()->createMany([
            [
                'name' => 'Carlos Ruiz',
                'relation' => 'Tech Lead en TechStart SpA',
                'contact' => '+56987654321'
            ],
            [
                'name' => 'Pedro Sánchez',
                'relation' => 'Senior Developer en WebSolutions Chile',
                'contact' => '+56987654322'
            ]
        ]);

        // Tercer CV - 2024 (Tres trabajos)
        $cv3 = Curriculum::create([
            'rut' => '98765430-5',
            'name' => 'Juan Pérez Soto',
            'email' => 'juan.perez@gmail.com',
            'phone' => '+56912345678',
            'birthdate' => '1990-05-15',
            'marital_status' => 'Soltero',
            'job_title' => 'Desarrollador Full Stack Senior',
            'profile_summary' => 'Desarrollador Full Stack Senior con sólida experiencia en arquitectura de software y liderazgo técnico. Especializado en soluciones cloud y metodologías ágiles.',
            'user_id' => $user->id,
            'created_at' => '2024-01-10 09:15:00',
            'updated_at' => '2024-01-10 09:15:00'
        ]);

        // Misma educación más certificación
        $cv3->educations()->createMany([
            [
                'institution' => 'Universidad de Chile',
                'degree' => 'Ingeniería en Informática',
                'start_date' => '2015-03-01',
                'end_date' => '2020-12-15'
            ],
            [
                'institution' => 'AWS',
                'degree' => 'AWS Certified Developer Associate',
                'start_date' => '2023-11-01',
                'end_date' => '2023-12-15'
            ]
        ]);

        // Experiencias laborales actualizadas
        $cv3->experiences()->createMany([
            [
                'company' => 'GlobalTech SA',
                'position' => 'Desarrollador Full Stack Senior',
                'start_date' => '2024-01-01',
                'end_date' => '2024-12-31',
                'description' => 'Liderazgo técnico en proyectos cloud. Desarrollo de arquitecturas serverless y microservicios.'
            ],
            [
                'company' => 'WebSolutions Chile',
                'position' => 'Desarrollador Full Stack Semi Senior',
                'start_date' => '2023-01-01',
                'end_date' => '2023-12-31',
                'description' => 'Desarrollo de aplicaciones web con Laravel y React. Implementación de CI/CD.'
            ],
            [
                'company' => 'TechStart SpA',
                'position' => 'Desarrollador Web Junior',
                'start_date' => '2022-03-01',
                'end_date' => '2022-12-31',
                'description' => 'Desarrollo de aplicaciones web con PHP y MySQL.'
            ]
        ]);

        // Habilidades completas
        $cv3->skills()->createMany([
            ['name' => 'AWS'],
            ['name' => 'Microservicios'],
            ['name' => 'TypeScript'],
            ['name' => 'MongoDB'],
            ['name' => 'CI/CD']
        ]);

        // Referencias actualizadas
        $cv3->references()->createMany([
            [
                'name' => 'Roberto González',
                'relation' => 'CTO en GlobalTech SA',
                'contact' => '+56987654323'
            ],
            [
                'name' => 'Ana Martínez',
                'relation' => 'Project Manager en WebSolutions Chile',
                'contact' => '+56987654322'
            ]
        ]);
    }
} 