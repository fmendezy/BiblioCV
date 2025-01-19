<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCurriculumsTable extends Migration
{
    public function up()
    {
        Schema::create('curriculums', function (Blueprint $table) {
            $table->id();
            $table->string('name');                // Nombre completo
            $table->string('rut')->unique();       // RUT (único)
            $table->date('dob');                   // Fecha de nacimiento
            $table->string('address');             // Dirección
            $table->string('phone');               // Teléfono
            $table->string('email');               // Correo electrónico
            $table->string('civil_status');        // Estado civil
            $table->string('photo')->nullable();   // Foto (opcional y via link)
            $table->string('degree');              // Título profesional
            $table->string('institution');         // Institución de educación
            $table->date('start_date');            // Fecha de inicio en estudios
            $table->date('end_date')->nullable(); // Fecha de término en estudios
            $table->text('courses')->nullable();   // Cursos adicionales
            $table->string('company');             // Nombre de la empresa
            $table->string('position');            // Cargo
            $table->date('job_start_date');        // Fecha de inicio en el trabajo
            $table->date('job_end_date')->nullable(); // Fecha de término en el trabajo
            $table->text('job_description');       // Descripción de las funciones
            $table->text('references')->nullable(); // Referencias laborales
            $table->text('skills')->nullable();    // Habilidades
            $table->string('languages')->nullable(); // Idiomas
            $table->decimal('salary_expectation', 10, 2)->nullable(); // Expectativa de salario
            $table->boolean('available')->default(false); // Disponibilidad inmediata
            $table->text('personal_references')->nullable(); // Referencias personales
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('curriculums');
    }
}
