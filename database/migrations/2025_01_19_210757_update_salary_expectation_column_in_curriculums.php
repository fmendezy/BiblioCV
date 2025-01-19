<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateSalaryExpectationColumnInCurriculums extends Migration
{
    public function up()
    {
        Schema::table('curriculums', function (Blueprint $table) {
            $table->decimal('salary_expectation', 15, 2)->change();  // Cambiar a DECIMAL con 15 dígitos y 2 decimales
        });
    }

    public function down()
    {
        Schema::table('curriculums', function (Blueprint $table) {
            $table->integer('salary_expectation')->change();  // Revertir a INT si es necesario
        });
    }
}
