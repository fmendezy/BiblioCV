<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('statistics', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('library_id');
            $table->enum('action_type', ['created', 'updated', 'deleted']);
            $table->date('action_date');
            $table->integer('count')->default(0);
            $table->integer('total_curriculums')->default(0);
            $table->integer('curriculums_by_employee')->default(0);
            $table->integer('curriculums_per_day')->default(0);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('library_id')->references('id')->on('library')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('statistics');
    }
};
