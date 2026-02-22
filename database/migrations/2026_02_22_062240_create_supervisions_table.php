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
        Schema::create('supervisions', function (Blueprint $table) {
            $table->id();
            
            // Relasi ke data edukasi yang dinilai
            $table->foreignId('education_id')->constrained('educations')->cascadeOnDelete();
            
            // Relasi ke tabel users (Supervisor yang menilai)
            $table->foreignId('observer_id')->constrained('users')->cascadeOnDelete(); 
            
            // Kolom hasil penilaian supervisor
            $table->integer('observation_score');
            $table->text('feedback');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supervisions');
    }
};