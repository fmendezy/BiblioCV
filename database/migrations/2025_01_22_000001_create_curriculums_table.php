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
            $table->string('civil_status');
            $table->text('summary')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('curriculums');
    }
};