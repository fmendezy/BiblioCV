<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curriculum extends Model
{
    use HasFactory;

    // Especificar el nombre de la tabla
    protected $table = 'curriculums';


    // Definir los campos que son asignables masivamente
    protected $fillable = [
        'name',             // Nombre completo
        'rut',              // RUT
        'dob',              // Fecha de nacimiento
        'address',          // Dirección
        'phone',            // Teléfono
        'email',             // Correo electrónico
        'civil_status',     // Estado civil
        'photo',            // Enlace de Foto
        'degree',           // Título profesional
        'institution',      // Institución de educación
        'start_date',       // Fecha de inicio
        'end_date',         // Fecha de finalización
        'courses',          // Cursos adicionales
        'company',          // Nombre de la empresa
        'position',         // Cargo ocupado
        'job_start_date',   // Fecha de inicio en el trabajo
        'job_end_date',     // Fecha de término del trabajo
        'job_description',  // Descripción de las funciones
        'references',       // Referencias laborales
        'skills',           // Habilidades
        'languages',        // Idiomas
        'salary_expectation', // Expectativa de sueldo
        'available',        // Disponibilidad inmediata
        'personal_references' // Referencias personales
    ];
}
