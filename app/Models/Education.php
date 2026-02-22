<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    // Tambahkan baris ini untuk memberitahu nama tabel yang benar
    protected $table = 'educations';

    protected $fillable = [
        'user_id', 
        'patient_id', 
        'diet_score', 
        'activity_score', 
        'used_media', 
        'status'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function patient() {
        return $this->belongsTo(Patient::class);
    }
}