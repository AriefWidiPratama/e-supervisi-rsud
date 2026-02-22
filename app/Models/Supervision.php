<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supervision extends Model
{
    protected $fillable = [
        'education_id',
        'observer_id',
        'item_scores',
        'total_score',
        'evaluation_category',
        'nurse_strengths',
        'areas_of_improvement',
    ];

    protected $casts = [
        'item_scores' => 'array', // Mengubah JSON dari database menjadi Array otomatis
    ];

    public function education() {
        return $this->belongsTo(Education::class);
    }

    public function observer() {
        return $this->belongsTo(User::class, 'observer_id');
    }

    // Relasi ke Rencana Tindak Lanjut (RTL)
    public function followUps() {
        return $this->hasMany(FollowUp::class);
    }
}