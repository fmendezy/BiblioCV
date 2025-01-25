<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('curriculums', function (Blueprint $table) {
            $table->date('birthdate')->nullable()->after('name');
            $table->string('marital_status')->nullable()->after('birthdate');
            // Eliminar la columna civil_status ya que usaremos marital_status
            if (Schema::hasColumn('curriculums', 'civil_status')) {
                $table->dropColumn('civil_status');
            }
        });
    }

    public function down(): void
    {
        Schema::table('curriculums', function (Blueprint $table) {
            $table->string('civil_status')->nullable();
            $table->dropColumn(['birthdate', 'marital_status']);
        });
    }
}; 