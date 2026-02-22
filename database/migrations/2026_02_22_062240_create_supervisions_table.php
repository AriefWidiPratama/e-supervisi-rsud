<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('supervisions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('education_id')->constrained('educations')->cascadeOnDelete();
            $table->foreignId('observer_id')->constrained('users')->cascadeOnDelete(); 
            
            // Komponen Kuantitatif (Observasi 18 Indikator)
            $table->json('item_scores')->nullable(); // Menyimpan rincian skor 0-1-2 tiap indikator
            $table->integer('total_score'); // Maksimal 36
            $table->string('evaluation_category'); // Edukasi Sangat Baik, Cukup, Kurang
            
            // Komponen Kualitatif (Buku Supervisi Klinis)
            $table->text('nurse_strengths')->nullable(); // Kekuatan Perawat
            $table->text('areas_of_improvement')->nullable(); // Area yang Perlu Ditingkatkan
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('supervisions');
    }
};