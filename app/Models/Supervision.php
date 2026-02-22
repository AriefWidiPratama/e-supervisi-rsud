<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supervision extends Model
{
    protected $fillable = [
        'education_id',
        'observer_id',
        'observation_score',
        'feedback',
    ];

    // Relasi balik ke tabel Edukasi
    public function education() {
        return $this->belongsTo(Education::class);
    }

    // Relasi ke tabel User (untuk mengetahui siapa Supervisor yang menilai)
    public function observer() {
        return $this->belongsTo(User::class, 'observer_id');
    }
}