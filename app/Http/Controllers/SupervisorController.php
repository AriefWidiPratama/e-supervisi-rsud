<?php

namespace App\Http\Controllers;

use App\Models\Education;
use App\Models\Supervision;
use App\Models\FollowUp;
use App\Models\User; // Tambahkan ini agar model User dikenali
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash; // Tambahkan ini untuk hashing password

class SupervisorController extends Controller
{
    public function index()
    {
        if (!Auth::user()->hasRole('Supervisor')) abort(403);
        
        $pendingEducations = Education::with(['user', 'patient'])
            ->whereDoesntHave('supervision') 
            ->latest()
            ->get()
            ->unique('patient_id'); 

        // --- FITUR MAHAL: EXECUTIVE ANALYTICS ---
        $allSupervisions = Supervision::all();
        $totalSupervisions = $allSupervisions->count();
        
        // Hitung rata-rata skor observasi (Maks 36)
        $avgScore = $totalSupervisions > 0 ? round($allSupervisions->avg('total_score'), 1) : 0;
        
        // Hitung Distribusi Kategori
        $sangatBaik = $allSupervisions->where('evaluation_category', 'Edukasi Sangat Baik')->count();
        $cukup = $allSupervisions->where('evaluation_category', 'Edukasi Cukup')->count();
        $kurang = $allSupervisions->where('evaluation_category', 'Edukasi Kurang')->count();

        // Hitung Persentase untuk Visualisasi Bar
        $pctSangatBaik = $totalSupervisions > 0 ? round(($sangatBaik / $totalSupervisions) * 100) : 0;
        $pctCukup = $totalSupervisions > 0 ? round(($cukup / $totalSupervisions) * 100) : 0;
        $pctKurang = $totalSupervisions > 0 ? round(($kurang / $totalSupervisions) * 100) : 0;

        return view('supervisor.dashboard', compact(
            'pendingEducations', 'totalSupervisions', 'avgScore',
            'sangatBaik', 'cukup', 'kurang',
            'pctSangatBaik', 'pctCukup', 'pctKurang'
        ));
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
            'scores' => 'required|array|size:18', 
            'nurse_strengths' => 'nullable|string',
            'areas_of_improvement' => 'nullable|string',
            'action_plan' => 'required|string',
            'target_date' => 'required|date',
        ]);

        $totalScore = array_sum($request->scores);

        $category = 'Edukasi Kurang';
        if ($totalScore >= 29) {
            $category = 'Edukasi Sangat Baik';
        } elseif ($totalScore >= 22) {
            $category = 'Edukasi Cukup';
        }

        $supervision = Supervision::create([
            'education_id' => $request->education_id,
            'observer_id' => Auth::id(),
            'item_scores' => $request->scores,
            'total_score' => $totalScore,
            'evaluation_category' => $category,
            'nurse_strengths' => $request->nurse_strengths,
            'areas_of_improvement' => $request->areas_of_improvement,
        ]);

        FollowUp::create([
            'supervision_id' => $supervision->id,
            'action_plan' => $request->action_plan,
            'target_date' => $request->target_date,
            'status' => 'Belum', 
        ]);

        return redirect()->route('supervisor.dashboard')->with('success', 'Supervisi dan RTL berhasil disimpan!');
    }

    public function history()
    {
        if (!Auth::user()->hasRole('Supervisor')) abort(403);

        $completedSupervisions = Supervision::with([
            'education.user', 
            'education.patient', 
            'observer',
            'followUps'
        ])->latest()->get();

        return view('supervisor.history', compact('completedSupervisions'));
    }

    public function updateRtl(Request $request, $id)
    {
        if (!Auth::user()->hasRole('Supervisor')) abort(403);
        
        $request->validate(['status' => 'required|in:Belum,Proses,Selesai']);
        
        $rtl = FollowUp::findOrFail($id);
        $rtl->update(['status' => $request->status]);
        
        return redirect()->back()->with('success', 'Status RTL berhasil diperbarui!');
    }

    public function exportData()
    {
        if (!Auth::user()->hasRole('Supervisor')) abort(403);

        $fileName = 'Data_Riset_Supervisi_' . date('Y-m-d') . '.csv';
        $supervisions = Supervision::with(['education.user', 'education.patient', 'followUps'])->get();

        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $columns = ['ID Supervisi', 'Tanggal', 'Nama Perawat', 'Nama Pasien', 'Diet', 'Aktivitas', 'Rokok', 'Obat', 'Stres', 'Bahaya', 'Media', 'Skor Observasi', 'Kategori Efektivitas', 'Kekuatan', 'Area Perbaikan', 'RTL', 'Status RTL'];

        $callback = function() use($supervisions, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns); 

            foreach ($supervisions as $s) {
                $rtl = $s->followUps->first();
                
                // FIXED INISIAL UNTUK EXPORT (Ambil Utuh)
                $initials = strtoupper($s->education->patient->patient_code);

                fputcsv($file, [
                    $s->id,
                    $s->created_at->format('Y-m-d'),
                    $s->education->user->name,
                    $initials, 
                    $s->education->topic_diet ? '1' : '0',
                    $s->education->topic_activity ? '1' : '0',
                    $s->education->topic_smoking ? '1' : '0',
                    $s->education->topic_medication ? '1' : '0',
                    $s->education->topic_stress ? '1' : '0',
                    $s->education->topic_warning_signs ? '1' : '0',
                    $s->education->used_media,
                    $s->total_score,
                    $s->evaluation_category,
                    $s->nurse_strengths,
                    $s->areas_of_improvement,
                    $rtl ? $rtl->action_plan : '-',
                    $rtl ? $rtl->status : '-'
                ]);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    // ==========================================
    // FITUR ENTERPRISE: MANAJEMEN AKUN PERAWAT
    // ==========================================
    
    // Menampilkan halaman manajemen perawat
    public function manageNurses()
    {
        if (!Auth::user()->hasRole('Supervisor')) abort(403);
        
        // Ambil semua user yang memiliki peran sebagai Perawat (Spatie Permission)
        $nurses = User::whereHas('roles', function($q) {
            $q->where('name', 'Nurse');
        })->get(); 
        
        return view('supervisor.nurses_manage', compact('nurses'));
    }

    // Menyimpan akun perawat baru
    public function storeNurse(Request $request)
    {
        if (!Auth::user()->hasRole('Supervisor')) abort(403);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Berikan role perawat menggunakan Spatie Permission
        $user->assignRole('Nurse');

        return redirect()->back()->with('success', 'Akun Perawat berhasil dibuat & aktif!');
    }
}