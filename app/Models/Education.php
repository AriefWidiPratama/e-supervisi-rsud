<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    protected $table = 'educations';

    protected $fillable = [
        'user_id',
        'patient_id',
        'topic_diet',
        'topic_activity',
        'topic_smoking',
        'topic_medication',
        'topic_stress',
        'topic_warning_signs',
        'detailed_checklists', // Tambahkan ini
        'used_media',
    ];

    protected $casts = [
        'detailed_checklists' => 'array', // Konversi otomatis JSON ke Array
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function patient() {
        return $this->belongsTo(Patient::class);
    }

    public function supervision() {
        return $this->hasOne(Supervision::class);
    }
}