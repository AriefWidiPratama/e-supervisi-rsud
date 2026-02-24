<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Education;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EducationController extends Controller
{
    public function create($patient_id)
    {
        if (!Auth::user()->hasRole('Nurse')) abort(403);
        $patient = Patient::findOrFail($patient_id);
        
        // Panggil data edukasi yang sudah ada jika belum disupervisi
        $education = Education::where('patient_id', $patient_id)->whereDoesntHave('supervision')->latest()->first();
        
        return view('nurse.education_form', compact('patient', 'education'));
    }

    public function store(Request $request)
    {
        if (!Auth::user()->hasRole('Nurse')) abort(403);

        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'used_media' => 'required|in:Digital Card,Printed Card,Combination',
        ]);

        $details = $request->input('details', []);

        $data = [
            'user_id' => Auth::id(),
            'patient_id' => $request->patient_id,
            'topic_diet' => $request->has('topic_diet') || count(array_intersect($details, ['Kurangi garam', 'Batasi gorengan', 'Perbanyak sayur & buah'])) > 0,
            'topic_activity' => $request->has('topic_activity') || count(array_intersect($details, ['Anjuran aktivitas', 'Batas aman aktivitas'])) > 0,
            'topic_smoking' => $request->has('topic_smoking') || count(array_intersect($details, ['Edukasi berhenti merokok', 'Edukasi hindari asap rokok'])) > 0,
            'topic_medication' => $request->has('topic_medication') || count(array_intersect($details, ['Waktu minum obat', 'Kepatuhan obat'])) > 0,
            'topic_stress' => $request->has('topic_stress') || count(array_intersect($details, ['Istirahat cukup', 'Relaksasi/ibadah'])) > 0,
            'topic_warning_signs' => $request->has('topic_warning_signs') || count(array_intersect($details, ['Nyeri dada', 'Sesak napas', 'Pusing berat'])) > 0,
            'detailed_checklists' => $details,
            'used_media' => $request->used_media,
        ];

        // LOGIKA BARU: Jika data sudah ada, Update. Jika belum, Create baru.
        $education = Education::where('patient_id', $request->patient_id)->whereDoesntHave('supervision')->latest()->first();
        if ($education) {
            $education->update($data);
        } else {
            Education::create($data);
        }

        return redirect()->route('perawat.dashboard')->with('success', 'Dokumentasi Edukasi berhasil diperbarui dan disimpan!');
    }
}