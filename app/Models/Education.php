<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    protected $table = 'educations';

    protected $fillable = [
        'user_id',
        'patient_id',
        'diet_score',
        'activity_score',
        'used_media',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function patient() {
        return $this->belongsTo(Patient::class);
    }

    // Tambahkan relasi ini
    public function supervision() {
        return $this->hasOne(Supervision::class);
    }
}