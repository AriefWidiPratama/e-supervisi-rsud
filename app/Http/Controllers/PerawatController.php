<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PerawatController extends Controller
{
    /**
     * Display the Nurse Dashboard with a list of their OWN research subjects.
     */
    public function index()
    {
        if (!Auth::user()->hasRole('Nurse')) {
            abort(403);
        }

        // FITUR ISOLASI DATA: Mengambil data pasien yang HANYA dimiliki oleh perawat yang sedang login
        $patients = Patient::with('educations.supervision')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();
        
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

        // Catatan: Pastikan nama view ini sesuai dengan file form kamu. 
        // Jika nama filemu 'patient_form.blade.php', ubah 'nurse.create_patient' menjadi 'nurse.patient_form'
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

        // Aturan 'unique' dihapus agar perawat berbeda bisa menginput inisial yang kebetulan sama
        $request->validate([
            'patient_code' => 'required|string',
            'medical_diagnosis' => 'required|string',
        ]);

        Patient::create([
            'user_id' => Auth::id(), // WAJIB: Kunci data pasien ini ke ID perawat yang sedang login
            'patient_code' => strtoupper($request->patient_code), // Otomatis jadikan huruf KAPITAL semua
            'medical_diagnosis' => $request->medical_diagnosis,
        ]);

        return redirect()->route('perawat.dashboard')->with('success', 'Data subjek berhasil ditambahkan!');
    }

    /**
     * Delete a specific research subject.
     */
    public function destroy($id)
    {
        if (!Auth::user()->hasRole('Nurse')) abort(403);
        
        // PENGAMANAN EKSTRA: Pastikan perawat hanya bisa menghapus pasien miliknya sendiri
        $patient = Patient::where('user_id', Auth::id())->findOrFail($id);
        $patient->delete();
        
        return redirect()->back()->with('success', 'Data subjek berhasil dihapus!');
    }
}