<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $fillable = [
        'patient_code',
        'medical_diagnosis',
    ];

    // Tambahkan relasi ini
    public function educations()
    {
        return $this->hasMany(Education::class);
    }
}