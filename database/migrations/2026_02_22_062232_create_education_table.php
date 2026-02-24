<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('educations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('patient_id')->constrained('patients')->cascadeOnDelete();
            
            // 6 Topik Utama Edukasi
            $table->boolean('topic_diet')->default(false);
            $table->boolean('topic_activity')->default(false);
            $table->boolean('topic_smoking')->default(false);
            $table->boolean('topic_medication')->default(false);
            $table->boolean('topic_stress')->default(false);
            $table->boolean('topic_warning_signs')->default(false);
            
            // Kolom baru untuk merekam rincian checklist edukasi
            $table->json('detailed_checklists')->nullable(); 
            
            $table->string('used_media'); 
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('educations');
    }
};