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
        Schema::table('curriculums', function (Blueprint $table) {
            $table->date('birthdate')->nullable()->after('name');
            $table->string('marital_status')->nullable()->after('birthdate');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('curriculums', function (Blueprint $table) {
            $table->dropColumn(['birthdate', 'marital_status']);
        });
    }
};
