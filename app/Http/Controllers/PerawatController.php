<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PerawatController extends Controller
{
    /**
     * Display the Nurse Dashboard with a list of all research subjects.
     */
    public function index()
    {
        if (!Auth::user()->hasRole('Nurse')) {
            abort(403);
        }

        $patients = Patient::latest()->get(); // Menampilkan pasien terbaru di atas
        
        return view('nurse.dashboard', compact('patients'));
    }

    /**
     * Show the form for creating a new research subject (Patient).
     */
    public function create()
    {
        if (!Auth::user()->hasRole('Nurse')) {
            abort(403);
        }

        return view('nurse.create_patient');
    }

    /**
     * Store a newly created research subject in storage.
     */
    public function store(Request $request)
    {
        if (!Auth::user()->hasRole('Nurse')) {
            abort(403);
        }

        $request->validate([
            'patient_code' => 'required|unique:patients,patient_code',
            'medical_diagnosis' => 'required|string',
        ]);

        Patient::create([
            'patient_code' => $request->patient_code,
            'medical_diagnosis' => $request->medical_diagnosis,
        ]);

        return redirect()->route('perawat.dashboard')->with('success', 'New research subject added successfully!');
    }
}