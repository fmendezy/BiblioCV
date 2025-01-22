<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('academic_educations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('curriculum_id')->constrained('curriculums')->onDelete('cascade');
            $table->string('institution');
            $table->string('degree');
            $table->string('start_year');
            $table->string('end_year')->nullable();
            $table->timestamps();
        });

        Schema::create('work_experiences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('curriculum_id')->constrained('curriculums')->onDelete('cascade');
            $table->string('position');
            $table->string('company');
            $table->string('start_date');
            $table->string('end_date')->nullable();
            $table->text('responsibilities');
            $table->timestamps();
        });

        Schema::create('additional_trainings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('curriculum_id')->constrained('curriculums')->onDelete('cascade');
            $table->string('course_name');
            $table->string('institution');
            $table->string('year');
            $table->integer('duration_hours');
            $table->timestamps();
        });

        Schema::create('skills', function (Blueprint $table) {
            $table->id();
            $table->foreignId('curriculum_id')->constrained('curriculums')->onDelete('cascade');
            $table->string('skill');
            $table->timestamps();
        });

        Schema::create('references', function (Blueprint $table) {
            $table->id();
            $table->foreignId('curriculum_id')->constrained('curriculums')->onDelete('cascade');
            $table->string('name');
            $table->string('position');
            $table->string('company');
            $table->string('phone');
            $table->string('email');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('academic_educations');
        Schema::dropIfExists('work_experiences');
        Schema::dropIfExists('additional_trainings');
        Schema::dropIfExists('skills');
        Schema::dropIfExists('references');
    }
};
