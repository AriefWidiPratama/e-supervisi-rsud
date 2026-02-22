<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Education;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EducationController extends Controller
{
    /**
     * Show the education form for a specific patient.
     */
    public function create($patient_id)
    {
        if (!Auth::user()->hasRole('Nurse')) {
            abort(403);
        }

        $patient = Patient::findOrFail($patient_id);
        return view('nurse.education_form', compact('patient'));
    }

    /**
     * Store the research data (Lifestyle Card).
     */
    public function store(Request $request)
    {
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'diet_score' => 'required|integer|min:0|max:100',
            'activity_score' => 'required|integer|min:0|max:100',
            'used_media' => 'required|in:Digital Card,Printed Card,Combination',
        ]);

        Education::create([
            'user_id' => Auth::id(),
            'patient_id' => $request->patient_id,
            'diet_score' => $request->diet_score,
            'activity_score' => $request->activity_score,
            'used_media' => $request->used_media,
        ]);

        return redirect()->route('perawat.dashboard')->with('success', 'Observation data recorded successfully!');
    }
}