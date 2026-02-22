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
        $table->foreignId('education_id')->constrained('educations')->cascadeOnDelete();
        $table->foreignId('supervisor_id')->constrained('users')->cascadeOnDelete(); // ID Supervisor
        
        $table->json('observation_scores'); // Skor 0-1-2 untuk 18 indikator [cite: 40, 658]
        $table->integer('total_score'); // Maksimal skor 36 [cite: 408]
        
        $table->text('feedback')->nullable(); // Umpan balik [cite: 662]
        $table->text('follow_up_plan')->nullable(); // Rencana Tindak Lanjut (RTL) [cite: 663]
        
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
