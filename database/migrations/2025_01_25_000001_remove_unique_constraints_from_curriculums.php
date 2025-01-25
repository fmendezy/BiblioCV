<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('curriculums', function (Blueprint $table) {
            $table->dropUnique(['rut']);
            $table->dropUnique(['email']);
        });
    }

    public function down(): void
    {
        Schema::table('curriculums', function (Blueprint $table) {
            $table->unique('rut');
            $table->unique('email');
        });
    }
}; 