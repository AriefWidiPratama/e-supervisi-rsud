<?php

namespace App\Http\Controllers;

use App\Models\Education;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupervisorController extends Controller
{
    public function index()
    {
        // Keamanan: Hanya Supervisor yang boleh masuk
        if (!Auth::user()->hasRole('Supervisor')) {
            abort(403);
        }

        // Mengambil data edukasi terbaru
        $pendingEducations = Education::with(['user', 'patient'])->get();

        return view('supervisor.dashboard', compact('pendingEducations'));
    }
}