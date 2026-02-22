<?php

namespace App\Http\Controllers;

use App\Models\Education;
use App\Models\Supervision;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupervisorController extends Controller
{
    public function index()
    {
        if (!Auth::user()->hasRole('Supervisor')) abort(403);
        
        // Kita hanya tampilkan edukasi yang BELUM disupervisi
        $pendingEducations = Education::with(['user', 'patient'])
            ->whereDoesntHave('supervision') 
            ->latest()
            ->get();

        return view('supervisor.dashboard', compact('pendingEducations'));
    }

    public function review($education_id)
    {
        if (!Auth::user()->hasRole('Supervisor')) abort(403);

        $education = Education::with(['user', 'patient'])->findOrFail($education_id);
        return view('supervisor.review_form', compact('education'));
    }

    public function storeReview(Request $request)
    {
        if (!Auth::user()->hasRole('Supervisor')) abort(403);

        $request->validate([
            'education_id' => 'required|exists:educations,id',
            'observation_score' => 'required|integer|min:0|max:100',
            'feedback' => 'required|string',
        ]);

        Supervision::create([
            'education_id' => $request->education_id,
            'observer_id' => Auth::id(),
            'observation_score' => $request->observation_score,
            'feedback' => $request->feedback,
        ]);

        return redirect()->route('supervisor.dashboard')->with('success', 'Clinical observation verified successfully!');
    }
}