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
        return view('nurse.education_form', compact('patient'));
    }

    public function store(Request $request)
    {
        if (!Auth::user()->hasRole('Nurse')) abort(403);

        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'used_media' => 'required|in:Digital Card,Printed Card,Combination',
        ]);

        // Simpan data edukasi. has() akan bernilai true jika dicentang, false jika tidak.
        Education::create([
            'user_id' => Auth::id(),
            'patient_id' => $request->patient_id,
            'topic_diet' => $request->has('topic_diet'),
            'topic_activity' => $request->has('topic_activity'),
            'topic_smoking' => $request->has('topic_smoking'),
            'topic_medication' => $request->has('topic_medication'),
            'topic_stress' => $request->has('topic_stress'),
            'topic_warning_signs' => $request->has('topic_warning_signs'),
            'used_media' => $request->used_media,
        ]);

        return redirect()->route('perawat.dashboard')->with('success', 'Dokumentasi Edukasi Lifestyle berhasil disimpan!');
    }
}