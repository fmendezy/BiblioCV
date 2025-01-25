<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::dropIfExists('curriculum_logs');
        Schema::dropIfExists('skills');
        Schema::dropIfExists('references');
        Schema::dropIfExists('work_experiences');
        Schema::dropIfExists('academic_educations');
        Schema::dropIfExists('curriculums');

        Schema::create('curriculums', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('rut');
            $table->string('name');
            $table->string('email');
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

        Schema::create('curriculum_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('curriculum_id')->constrained('curriculums')->onDelete('cascade');
            $table->string('action');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('curriculum_logs');
        Schema::dropIfExists('skills');
        Schema::dropIfExists('references');
        Schema::dropIfExists('work_experiences');
        Schema::dropIfExists('academic_educations');
        Schema::dropIfExists('curriculums');
    }
};
