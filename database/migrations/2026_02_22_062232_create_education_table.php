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
        Schema::create('educations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete(); // ID Perawat
            $table->foreignId('patient_id')->constrained('patients')->cascadeOnDelete();
            
            // Kolom Instrumen Riset Digital Lifestyle Card
            $table->integer('diet_score');
            $table->integer('activity_score');
            $table->string('used_media');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Pastikan pakai 's' karena nama tabelnya 'educations'
        Schema::dropIfExists('educations');
    }
};