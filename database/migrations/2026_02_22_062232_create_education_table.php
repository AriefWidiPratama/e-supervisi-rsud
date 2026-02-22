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
            
            // 6 Topik Checklist Digital Lifestyle Card (Sesuai Proposal TKT 3)
            $table->boolean('topic_diet')->default(false);
            $table->boolean('topic_activity')->default(false);
            $table->boolean('topic_smoking')->default(false);
            $table->boolean('topic_medication')->default(false);
            $table->boolean('topic_stress')->default(false);
            $table->boolean('topic_warning_signs')->default(false);
            
            $table->string('used_media'); // Digital Card, Printed Card, Kombinasi
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('educations');
    }
};