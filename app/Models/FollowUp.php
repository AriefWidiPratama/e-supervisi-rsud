<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FollowUp extends Model
{
    protected $fillable = [
        'supervision_id',
        'action_plan',
        'target_date',
        'status',
    ];

    // Relasi balik ke tabel Supervisi
    public function supervision() {
        return $this->belongsTo(Supervision::class);
    }
}