<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('follow_ups', function (Blueprint $table) {
            $table->id();
            $table->foreignId('supervision_id')->constrained('supervisions')->cascadeOnDelete();
            
            $table->string('action_plan'); // Rencana Tindak Lanjut
            $table->date('target_date'); // Target Waktu
            $table->enum('status', ['Belum', 'Proses', 'Selesai'])->default('Belum');
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('follow_ups');
    }
};