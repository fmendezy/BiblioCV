<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('curriculums', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('rut')->unique();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone');
            $table->string('job_title')->nullable();
            $table->text('profile_summary')->nullable();
            $table->string('photo')->nullable();
            $table->string('civil_status')->nullable();
            $table->text('summary')->nullable();
            $table->timestamps();
        });

        Schema::create('academic_educations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('curriculum_id')->constrained('curriculums')->onDelete('cascade');
            $table->string('institution');
            $table->string('degree');
            $table->date('start_date');
            $table->date('end_date');
            $table->timestamps();
        });

        Schema::create('work_experiences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('curriculum_id')->constrained('curriculums')->onDelete('cascade');
            $table->string('company');
            $table->string('position');
            $table->date('start_date');
            $table->date('end_date');
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::create('skills', function (Blueprint $table) {
            $table->id();
            $table->foreignId('curriculum_id')->constrained('curriculums')->onDelete('cascade');
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('references', function (Blueprint $table) {
            $table->id();
            $table->foreignId('curriculum_id')->constrained('curriculums')->onDelete('cascade');
            $table->string('name');
            $table->string('relation');
            $table->string('contact');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('references');
        Schema::dropIfExists('skills');
        Schema::dropIfExists('work_experiences');
        Schema::dropIfExists('academic_educations');
        Schema::dropIfExists('curriculums');
    }
};