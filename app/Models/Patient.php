<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $fillable = [
        'user_id', // WAJIB DITAMBAHKAN: Untuk mengunci data pasien ke perawat tertentu
        'patient_code',
        'medical_diagnosis',
    ];

    // Relasi ke data edukasi (Lifestyle Card)
    public function educations()
    {
        return $this->hasMany(Education::class);
    }

    // Relasi balik ke Perawat (User) yang mendaftarkan pasien ini
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}