<?php

namespace Database\Seeders;

use App\Models\Curriculum;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CurriculumSeeder extends Seeder
{
    public function run(): void
    {
        $curriculums = [
            [
                'rut' => '15678901-2',
                'name' => 'Ana María González Soto',
                'email' => 'ana.gonzalez@gmail.com',
                'phone' => '+56912345678',
                'birthdate' => '1990-05-15',
                'marital_status' => 'Soltera',
                'job_title' => 'Ingeniero Civil Industrial',
                'profile_summary' => 'Profesional con 5 años de experiencia en gestión de proyectos y mejora continua.',
                'summary' => 'Ingeniera Civil Industrial con sólida formación académica y experiencia en optimización de procesos y gestión de equipos. Enfocada en resultados y mejora continua.',
                'user_id' => User::where('library_id', 1)->where('role', 'employee')->first()->id,
                'educations' => [
                    [
                        'institution' => 'Universidad de Chile',
                        'degree' => 'Ingeniero Civil Industrial',
                        'start_date' => '2008-03-01',
                        'end_date' => '2013-12-20'
                    ],
                    [
                        'institution' => 'Universidad de Chile',
                        'degree' => 'Magíster en Gestión de Operaciones',
                        'start_date' => '2014-03-01',
                        'end_date' => '2016-12-15'
                    ]
                ],
                'experiences' => [
                    [
                        'company' => 'Consultora ABC',
                        'position' => 'Ingeniero de Proyectos Senior',
                        'start_date' => '2016-01-01',
                        'end_date' => '2023-12-31',
                        'description' => 'Liderazgo de proyectos de mejora continua y optimización de procesos en diversas industrias.'
                    ],
                    [
                        'company' => 'Empresa XYZ',
                        'position' => 'Analista de Procesos',
                        'start_date' => '2013-12-01',
                        'end_date' => '2015-12-31',
                        'description' => 'Análisis y mejora de procesos productivos.'
                    ]
                ],
                'skills' => [
                    ['name' => 'Gestión de Proyectos'],
                    ['name' => 'Six Sigma'],
                    ['name' => 'Lean Manufacturing'],
                    ['name' => 'MS Project'],
                    ['name' => 'Power BI']
                ],
                'references' => [
                    [
                        'name' => 'Juan Pérez',
                        'relation' => 'Gerente de Operaciones en Consultora ABC',
                        'contact' => '+56987654321'
                    ],
                    [
                        'name' => 'María Silva',
                        'relation' => 'Directora de Proyectos en Empresa XYZ',
                        'contact' => '+56976543210'
                    ]
                ]
            ],
            [
                'rut' => '16789012-3',
                'name' => 'Carlos Alberto Muñoz Vera',
                'email' => 'carlos.munoz@gmail.com',
                'phone' => '+56923456789',
                'birthdate' => '1985-07-20',
                'marital_status' => 'Casado',
                'job_title' => 'Contador Auditor',
                'profile_summary' => 'Experto en contabilidad y finanzas con sólida experiencia en auditorías.',
                'summary' => 'Contador Auditor con más de 10 años de experiencia en el área contable y fiscal. Especialista en auditorías financieras y tributarias.',
                'user_id' => User::where('library_id', 2)->where('role', 'employee')->first()->id,
                'educations' => [
                    [
                        'institution' => 'Universidad de Santiago',
                        'degree' => 'Contador Público',
                        'start_date' => '2005-03-01',
                        'end_date' => '2009-12-20'
                    ],
                    [
                        'institution' => 'Universidad de Santiago',
                        'degree' => 'Magíster en Auditoría',
                        'start_date' => '2010-03-01',
                        'end_date' => '2012-12-15'
                    ]
                ],
                'experiences' => [
                    [
                        'company' => 'Consultora ABC',
                        'position' => 'Auditor Senior',
                        'start_date' => '2009-01-01',
                        'end_date' => '2016-12-31',
                        'description' => 'Responsable de auditorías financieras y tributarias en diversas industrias.'
                    ],
                    [
                        'company' => 'Empresa XYZ',
                        'position' => 'Auditor de Auditoría Interna',
                        'start_date' => '2012-01-01',
                        'end_date' => '2013-12-31',
                        'description' => 'Análisis y evaluación de controles internos y procesos de gestión.'
                    ]
                ],
                'skills' => [
                    ['name' => 'Auditoría'],
                    ['name' => 'Contabilidad'],
                    ['name' => 'Fiscalidad'],
                    ['name' => 'Análisis de Riesgos'],
                    ['name' => 'Control Interno']
                ],
                'references' => [
                    [
                        'name' => 'María Silva',
                        'relation' => 'Directora de Auditoría en Empresa XYZ',
                        'contact' => '+56976543210'
                    ],
                    [
                        'name' => 'Juan Pérez',
                        'relation' => 'Gerente de Auditoría en Consultora ABC',
                        'contact' => '+56987654321'
                    ]
                ]
            ],
            [
                'rut' => '17890123-4',
                'name' => 'Patricia Andrea Rojas López',
                'email' => 'patricia.rojas@gmail.com',
                'phone' => '+56934567890',
                'birthdate' => '1988-09-10',
                'marital_status' => 'Casada',
                'job_title' => 'Psicóloga Organizacional',
                'profile_summary' => 'Especialista en selección de personal y desarrollo organizacional.',
                'summary' => 'Psicóloga Organizacional con especialización en psicología laboral y desarrollo de equipos. Experiencia en consultoría y desarrollo de estrategias organizacionales.',
                'user_id' => User::where('library_id', 3)->where('role', 'employee')->first()->id,
                'educations' => [
                    [
                        'institution' => 'Universidad de Santiago',
                        'degree' => 'Psicóloga',
                        'start_date' => '2010-03-01',
                        'end_date' => '2014-12-20'
                    ],
                    [
                        'institution' => 'Universidad de Santiago',
                        'degree' => 'Magíster en Psicología Organizacional',
                        'start_date' => '2015-03-01',
                        'end_date' => '2017-12-15'
                    ]
                ],
                'experiences' => [
                    [
                        'company' => 'Consultora ABC',
                        'position' => 'Psicóloga Organizacional',
                        'start_date' => '2014-01-01',
                        'end_date' => '2016-12-31',
                        'description' => 'Consultoría y desarrollo de estrategias organizacionales en diversas industrias.'
                    ],
                    [
                        'company' => 'Empresa XYZ',
                        'position' => 'Psicóloga Organizacional',
                        'start_date' => '2016-01-01',
                        'end_date' => '2023-12-31',
                        'description' => 'Desarrollo y aplicación de estrategias organizacionales en la empresa XYZ.'
                    ]
                ],
                'skills' => [
                    ['name' => 'Psicología Organizacional'],
                    ['name' => 'Desarrollo de Equipos'],
                    ['name' => 'Consultoría'],
                    ['name' => 'Estrategias Organizacionales'],
                    ['name' => 'Análisis de Desempeño']
                ],
                'references' => [
                    [
                        'name' => 'Juan Pérez',
                        'relation' => 'Gerente de Recursos Humanos en Consultora ABC',
                        'contact' => '+56987654321'
                    ],
                    [
                        'name' => 'María Silva',
                        'relation' => 'Directora de Recursos Humanos en Empresa XYZ',
                        'contact' => '+56976543210'
                    ]
                ]
            ],
            [
                'rut' => '18901234-5',
                'name' => 'Juan Pablo Silva Castro',
                'email' => 'juan.silva@gmail.com',
                'phone' => '+56945678901',
                'birthdate' => '1992-02-18',
                'marital_status' => 'Soltero',
                'job_title' => 'Ingeniero en Informática',
                'profile_summary' => 'Desarrollador full-stack con experiencia en tecnologías web modernas.',
                'summary' => 'Ingeniero en Informática con sólida formación académica y experiencia en desarrollo de software y tecnologías web. Desarrollador full-stack con conocimientos en diversas tecnologías.',
                'user_id' => User::where('library_id', 4)->where('role', 'employee')->first()->id,
                'educations' => [
                    [
                        'institution' => 'Universidad de Santiago',
                        'degree' => 'Ingeniero en Informática',
                        'start_date' => '2010-03-01',
                        'end_date' => '2014-12-20'
                    ],
                    [
                        'institution' => 'Universidad de Santiago',
                        'degree' => 'Magíster en Desarrollo de Software',
                        'start_date' => '2015-03-01',
                        'end_date' => '2017-12-15'
                    ]
                ],
                'experiences' => [
                    [
                        'company' => 'Consultora ABC',
                        'position' => 'Desarrollador Full-Stack',
                        'start_date' => '2014-01-01',
                        'end_date' => '2016-12-31',
                        'description' => 'Desarrollo de aplicaciones web y desarrollo de software.'
                    ],
                    [
                        'company' => 'Empresa XYZ',
                        'position' => 'Desarrollador Full-Stack',
                        'start_date' => '2016-01-01',
                        'end_date' => '2023-12-31',
                        'description' => 'Desarrollo de aplicaciones web y desarrollo de software.'
                    ]
                ],
                'skills' => [
                    ['name' => 'Desarrollo de Software'],
                    ['name' => 'Full-Stack Development'],
                    ['name' => 'Web Development'],
                    ['name' => 'JavaScript'],
                    ['name' => 'Node.js']
                ],
                'references' => [
                    [
                        'name' => 'Juan Pérez',
                        'relation' => 'Gerente de Tecnologías en Consultora ABC',
                        'contact' => '+56987654321'
                    ],
                    [
                        'name' => 'María Silva',
                        'relation' => 'Directora de Tecnologías en Empresa XYZ',
                        'contact' => '+56976543210'
                    ]
                ]
            ],
            [
                'rut' => '19012345-6',
                'name' => 'María José Pérez Díaz',
                'email' => 'maria.perez@gmail.com',
                'phone' => '+56956789012',
                'birthdate' => '1987-11-25',
                'marital_status' => 'Casada',
                'job_title' => 'Trabajadora Social',
                'profile_summary' => 'Experiencia en programas sociales y trabajo comunitario.',
                'summary' => 'Trabajadora Social con más de 10 años de experiencia en programas sociales y trabajo comunitario. Especialista en intervención comunitaria y desarrollo de estrategias sociales.',
                'user_id' => User::where('library_id', 5)->where('role', 'employee')->first()->id,
                'educations' => [
                    [
                        'institution' => 'Universidad de Santiago',
                        'degree' => 'Licenciada en Trabajo Social',
                        'start_date' => '2007-03-01',
                        'end_date' => '2011-12-20'
                    ],
                    [
                        'institution' => 'Universidad de Santiago',
                        'degree' => 'Magíster en Trabajo Social',
                        'start_date' => '2012-03-01',
                        'end_date' => '2014-12-15'
                    ]
                ],
                'experiences' => [
                    [
                        'company' => 'Consultora ABC',
                        'position' => 'Trabajadora Social',
                        'start_date' => '2007-01-01',
                        'end_date' => '2011-12-31',
                        'description' => 'Intervención comunitaria y desarrollo de estrategias sociales.'
                    ],
                    [
                        'company' => 'Empresa XYZ',
                        'position' => 'Trabajadora Social',
                        'start_date' => '2011-01-01',
                        'end_date' => '2014-12-31',
                        'description' => 'Intervención comunitaria y desarrollo de estrategias sociales.'
                    ],
                    [
                        'company' => 'Consultora ABC',
                        'position' => 'Coordinadora de Programas Sociales',
                        'start_date' => '2014-01-01',
                        'end_date' => '2016-12-31',
                        'description' => 'Coordinación y desarrollo de programas sociales y comunitaria.'
                    ],
                    [
                        'company' => 'Empresa XYZ',
                        'position' => 'Coordinadora de Programas Sociales',
                        'start_date' => '2016-01-01',
                        'end_date' => '2023-12-31',
                        'description' => 'Coordinación y desarrollo de programas sociales y comunitaria.'
                    ]
                ],
                'skills' => [
                    ['name' => 'Intervención Comunitaria'],
                    ['name' => 'Desarrollo de Estrategias Sociales'],
                    ['name' => 'Coordinación de Programas'],
                    ['name' => 'Análisis de Impacto Social'],
                    ['name' => 'Gestión de Proyectos']
                ],
                'references' => [
                    [
                        'name' => 'Juan Pérez',
                        'relation' => 'Gerente de Programas Sociales en Consultora ABC',
                        'contact' => '+56987654321'
                    ],
                    [
                        'name' => 'María Silva',
                        'relation' => 'Directora de Programas Sociales en Empresa XYZ',
                        'contact' => '+56976543210'
                    ]
                ]
            ],
            [
                'rut' => '20123456-7',
                'name' => 'Diego Alejandro Torres Vidal',
                'email' => 'diego.torres@gmail.com',
                'phone' => '+56967890123',
                'birthdate' => '1983-06-05',
                'marital_status' => 'Casado',
                'job_title' => 'Arquitecto',
                'profile_summary' => 'Diseñador de espacios innovadores con enfoque sustentable.',
                'summary' => 'Arquitecto con sólida formación académica y experiencia en diseño de espacios innovadores y sustentables.',
                'user_id' => User::where('library_id', 6)->where('role', 'employee')->first()->id,
                'educations' => [
                    [
                        'institution' => 'Universidad de Santiago',
                        'degree' => 'Arquitecto',
                        'start_date' => '2005-03-01',
                        'end_date' => '2010-12-20'
                    ],
                    [
                        'institution' => 'Universidad de Santiago',
                        'degree' => 'Magíster en Diseño Urbano',
                        'start_date' => '2011-03-01',
                        'end_date' => '2013-12-15'
                    ]
                ],
                'experiences' => [
                    [
                        'company' => 'Consultora ABC',
                        'position' => 'Arquitecto Senior',
                        'start_date' => '2010-01-01',
                        'end_date' => '2013-12-31',
                        'description' => 'Diseño de espacios innovadores y sustentables.'
                    ],
                    [
                        'company' => 'Empresa XYZ',
                        'position' => 'Arquitecto',
                        'start_date' => '2013-01-01',
                        'end_date' => '2016-12-31',
                        'description' => 'Diseño de espacios innovadores y sustentables.'
                    ],
                    [
                        'company' => 'Consultora ABC',
                        'position' => 'Coordinador de Diseño',
                        'start_date' => '2016-01-01',
                        'end_date' => '2023-12-31',
                        'description' => 'Coordinación y desarrollo de proyectos de diseño.'
                    ],
                    [
                        'company' => 'Empresa XYZ',
                        'position' => 'Coordinador de Diseño',
                        'start_date' => '2016-01-01',
                        'end_date' => '2023-12-31',
                        'description' => 'Coordinación y desarrollo de proyectos de diseño.'
                    ]
                ],
                'skills' => [
                    ['name' => 'Diseño Urbano'],
                    ['name' => 'Sustentabilidad'],
                    ['name' => 'Innovación'],
                    ['name' => 'Coordinación'],
                    ['name' => 'Diseño Arquitectónico']
                ],
                'references' => [
                    [
                        'name' => 'Juan Pérez',
                        'relation' => 'Gerente de Diseño en Consultora ABC',
                        'contact' => '+56987654321'
                    ],
                    [
                        'name' => 'María Silva',
                        'relation' => 'Directora de Diseño en Empresa XYZ',
                        'contact' => '+56976543210'
                    ]
                ]
            ],
            [
                'rut' => '21234567-8',
                'name' => 'Valentina Paz Morales Ruiz',
                'email' => 'valentina.morales@gmail.com',
                'phone' => '+56978901234',
                'birthdate' => '1980-03-12',
                'marital_status' => 'Casada',
                'job_title' => 'Periodista',
                'profile_summary' => 'Comunicadora con experiencia en medios digitales y gestión de contenidos.',
                'summary' => 'Periodista con más de 10 años de experiencia en comunicación y gestión de contenidos digitales.',
                'user_id' => User::where('library_id', 7)->where('role', 'employee')->first()->id,
                'educations' => [
                    [
                        'institution' => 'Universidad de Santiago',
                        'degree' => 'Periodismo',
                        'start_date' => '2002-03-01',
                        'end_date' => '2006-12-20'
                    ],
                    [
                        'institution' => 'Universidad de Santiago',
                        'degree' => 'Magíster en Comunicación',
                        'start_date' => '2007-03-01',
                        'end_date' => '2009-12-15'
                    ]
                ],
                'experiences' => [
                    [
                        'company' => 'Consultora ABC',
                        'position' => 'Periodista',
                        'start_date' => '2006-01-01',
                        'end_date' => '2009-12-31',
                        'description' => 'Periodismo en medios impresos y digitales.'
                    ],
                    [
                        'company' => 'Empresa XYZ',
                        'position' => 'Periodista',
                        'start_date' => '2009-01-01',
                        'end_date' => '2012-12-31',
                        'description' => 'Periodismo en medios impresos y digitales.'
                    ],
                    [
                        'company' => 'Consultora ABC',
                        'position' => 'Gerente de Contenido Digital',
                        'start_date' => '2012-01-01',
                        'end_date' => '2016-12-31',
                        'description' => 'Gestión y desarrollo de contenido digital.'
                    ],
                    [
                        'company' => 'Empresa XYZ',
                        'position' => 'Gerente de Contenido Digital',
                        'start_date' => '2016-01-01',
                        'end_date' => '2023-12-31',
                        'description' => 'Gestión y desarrollo de contenido digital.'
                    ]
                ],
                'skills' => [
                    ['name' => 'Periodismo'],
                    ['name' => 'Comunicación'],
                    ['name' => 'Gestión de Contenido'],
                    ['name' => 'Diseño Gráfico'],
                    ['name' => 'Análisis de Audiencia']
                ],
                'references' => [
                    [
                        'name' => 'Juan Pérez',
                        'relation' => 'Gerente de Comunicación en Consultora ABC',
                        'contact' => '+56987654321'
                    ],
                    [
                        'name' => 'María Silva',
                        'relation' => 'Directora de Comunicación en Empresa XYZ',
                        'contact' => '+56976543210'
                    ]
                ]
            ],
            [
                'rut' => '22345678-9',
                'name' => 'Sebastián Ignacio Castro Parra',
                'email' => 'sebastian.castro@gmail.com',
                'phone' => '+56989012345',
                'birthdate' => '1978-08-20',
                'marital_status' => 'Casado',
                'job_title' => 'Profesor de Historia',
                'profile_summary' => 'Docente con experiencia en educación media y superior.',
                'summary' => 'Profesor de Historia con más de 15 años de experiencia en la enseñanza de la historia y la educación media.',
                'user_id' => User::where('library_id', 8)->where('role', 'employee')->first()->id,
                'educations' => [
                    [
                        'institution' => 'Universidad de Santiago',
                        'degree' => 'Licenciado en Historia',
                        'start_date' => '1998-03-01',
                        'end_date' => '2002-12-20'
                    ],
                    [
                        'institution' => 'Universidad de Santiago',
                        'degree' => 'Magíster en Historia',
                        'start_date' => '2003-03-01',
                        'end_date' => '2005-12-15'
                    ]
                ],
                'experiences' => [
                    [
                        'company' => 'Consultora ABC',
                        'position' => 'Profesor de Historia',
                        'start_date' => '2002-01-01',
                        'end_date' => '2005-12-31',
                        'description' => 'Enseñanza de la historia en la educación media.'
                    ],
                    [
                        'company' => 'Empresa XYZ',
                        'position' => 'Profesor de Historia',
                        'start_date' => '2005-01-01',
                        'end_date' => '2009-12-31',
                        'description' => 'Enseñanza de la historia en la educación media.'
                    ],
                    [
                        'company' => 'Consultora ABC',
                        'position' => 'Coordinador de Educación Media',
                        'start_date' => '2009-01-01',
                        'end_date' => '2012-12-31',
                        'description' => 'Coordinación y desarrollo de la educación media.'
                    ],
                    [
                        'company' => 'Empresa XYZ',
                        'position' => 'Coordinador de Educación Media',
                        'start_date' => '2012-01-01',
                        'end_date' => '2016-12-31',
                        'description' => 'Coordinación y desarrollo de la educación media.'
                    ]
                ],
                'skills' => [
                    ['name' => 'Enseñanza'],
                    ['name' => 'Historia'],
                    ['name' => 'Educación Media'],
                    ['name' => 'Coordinación'],
                    ['name' => 'Análisis Histórico']
                ],
                'references' => [
                    [
                        'name' => 'Juan Pérez',
                        'relation' => 'Gerente de Educación en Consultora ABC',
                        'contact' => '+56987654321'
                    ],
                    [
                        'name' => 'María Silva',
                        'relation' => 'Directora de Educación en Empresa XYZ',
                        'contact' => '+56976543210'
                    ]
                ]
            ],
            [
                'rut' => '23456789-0',
                'name' => 'Camila Fernanda López Torres',
                'email' => 'camila.lopez@gmail.com',
                'phone' => '+56990123456',
                'birthdate' => '1995-04-15',
                'marital_status' => 'Soltera',
                'job_title' => 'Diseñadora Gráfica',
                'profile_summary' => 'Creativa con experiencia en diseño editorial y branding.',
                'summary' => 'Diseñadora Gráfica con más de 5 años de experiencia en diseño editorial y branding.',
                'user_id' => User::where('library_id', 9)->where('role', 'employee')->first()->id,
                'educations' => [
                    [
                        'institution' => 'Universidad de Santiago',
                        'degree' => 'Diseñadora Gráfica',
                        'start_date' => '2010-03-01',
                        'end_date' => '2014-12-20'
                    ],
                    [
                        'institution' => 'Universidad de Santiago',
                        'degree' => 'Magíster en Diseño Gráfico',
                        'start_date' => '2015-03-01',
                        'end_date' => '2017-12-15'
                    ]
                ],
                'experiences' => [
                    [
                        'company' => 'Consultora ABC',
                        'position' => 'Diseñadora Gráfica',
                        'start_date' => '2010-01-01',
                        'end_date' => '2014-12-31',
                        'description' => 'Diseño de material gráfico para medios impresos y digitales.'
                    ],
                    [
                        'company' => 'Empresa XYZ',
                        'position' => 'Diseñadora Gráfica',
                        'start_date' => '2014-01-01',
                        'end_date' => '2017-12-31',
                        'description' => 'Diseño de material gráfico para medios impresos y digitales.'
                    ],
                    [
                        'company' => 'Consultora ABC',
                        'position' => 'Coordinadora de Diseño Gráfico',
                        'start_date' => '2017-01-01',
                        'end_date' => '2023-12-31',
                        'description' => 'Coordinación y desarrollo de estrategias de diseño gráfico.'
                    ],
                    [
                        'company' => 'Empresa XYZ',
                        'position' => 'Coordinadora de Diseño Gráfico',
                        'start_date' => '2017-01-01',
                        'end_date' => '2023-12-31',
                        'description' => 'Coordinación y desarrollo de estrategias de diseño gráfico.'
                    ]
                ],
                'skills' => [
                    ['name' => 'Diseño Gráfico'],
                    ['name' => 'Branding'],
                    ['name' => 'Diseño Editorial'],
                    ['name' => 'Coordinación'],
                    ['name' => 'Innovación']
                ],
                'references' => [
                    [
                        'name' => 'Juan Pérez',
                        'relation' => 'Gerente de Diseño en Consultora ABC',
                        'contact' => '+56987654321'
                    ],
                    [
                        'name' => 'María Silva',
                        'relation' => 'Directora de Diseño en Empresa XYZ',
                        'contact' => '+56976543210'
                    ]
                ]
            ],
            [
                'rut' => '24567890-1',
                'name' => 'Roberto Antonio Soto Vega',
                'email' => 'roberto.soto@gmail.com',
                'phone' => '+56901234567',
                'birthdate' => '1980-01-01',
                'marital_status' => 'Casado',
                'job_title' => 'Ingeniero Comercial',
                'profile_summary' => 'Especialista en marketing digital y desarrollo de negocios.',
                'summary' => 'Ingeniero Comercial con más de 10 años de experiencia en marketing digital y desarrollo de negocios.',
                'user_id' => User::where('library_id', 10)->where('role', 'employee')->first()->id,
                'educations' => [
                    [
                        'institution' => 'Universidad de Santiago',
                        'degree' => 'Ingeniero Comercial',
                        'start_date' => '2000-03-01',
                        'end_date' => '2004-12-20'
                    ],
                    [
                        'institution' => 'Universidad de Santiago',
                        'degree' => 'Magíster en Marketing Digital',
                        'start_date' => '2005-03-01',
                        'end_date' => '2007-12-15'
                    ]
                ],
                'experiences' => [
                    [
                        'company' => 'Consultora ABC',
                        'position' => 'Ingeniero Comercial',
                        'start_date' => '2004-01-01',
                        'end_date' => '2007-12-31',
                        'description' => 'Desarrollo y gestión de estrategias de marketing digital.'
                    ],
                    [
                        'company' => 'Empresa XYZ',
                        'position' => 'Ingeniero Comercial',
                        'start_date' => '2007-01-01',
                        'end_date' => '2010-12-31',
                        'description' => 'Desarrollo y gestión de estrategias de marketing digital.'
                    ],
                    [
                        'company' => 'Consultora ABC',
                        'position' => 'Gerente de Marketing Digital',
                        'start_date' => '2010-01-01',
                        'end_date' => '2014-12-31',
                        'description' => 'Gestión y desarrollo de estrategias de marketing digital.'
                    ],
                    [
                        'company' => 'Empresa XYZ',
                        'position' => 'Gerente de Marketing Digital',
                        'start_date' => '2014-01-01',
                        'end_date' => '2017-12-31',
                        'description' => 'Gestión y desarrollo de estrategias de marketing digital.'
                    ]
                ],
                'skills' => [
                    ['name' => 'Marketing Digital'],
                    ['name' => 'Estrategias de Marketing'],
                    ['name' => 'Desarrollo de Negocios'],
                    ['name' => 'Coordinación'],
                    ['name' => 'Análisis de Mercado']
                ],
                'references' => [
                    [
                        'name' => 'Juan Pérez',
                        'relation' => 'Gerente de Marketing en Consultora ABC',
                        'contact' => '+56987654321'
                    ],
                    [
                        'name' => 'María Silva',
                        'relation' => 'Directora de Marketing en Empresa XYZ',
                        'contact' => '+56976543210'
                    ]
                ]
            ],
        ];

        foreach ($curriculums as $curriculumData) {
            $educations = $curriculumData['educations'] ?? [];
            $experiences = $curriculumData['experiences'] ?? [];
            $skills = $curriculumData['skills'] ?? [];
            $references = $curriculumData['references'] ?? [];

            unset($curriculumData['educations'], $curriculumData['experiences'], $curriculumData['skills'], $curriculumData['references']);

            $curriculum = Curriculum::create($curriculumData);

            foreach ($educations as $education) {
                $curriculum->educations()->create($education);
            }

            foreach ($experiences as $experience) {
                $curriculum->experiences()->create($experience);
            }

            foreach ($skills as $skill) {
                $curriculum->skills()->create($skill);
            }

            foreach ($references as $reference) {
                $curriculum->references()->create($reference);
            }
        }
    }
} 