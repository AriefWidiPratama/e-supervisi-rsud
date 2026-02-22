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
        
        $table->json('lifestyle_topics'); // Menyimpan checklist Diet, Aktivitas, Obat, dll
        $table->enum('used_media', ['Digital Card', 'Printed Card', 'Combination']);
        $table->enum('supervision_status', ['Pending', 'In Progress', 'Completed'])->default('Pending');
        
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('education');
    }
};
