<?php

namespace App\Http\Controllers;

use App\Models\Education;
use App\Models\Supervision;
use App\Models\FollowUp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupervisorController extends Controller
{
    public function index()
    {
        if (!Auth::user()->hasRole('Supervisor')) abort(403);
        
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

        // Validasi 18 Indikator dan RTL
        $request->validate([
            'education_id' => 'required|exists:educations,id',
            'scores' => 'required|array|size:18', // Memastikan ada 18 jawaban
            'nurse_strengths' => 'nullable|string',
            'areas_of_improvement' => 'nullable|string',
            'action_plan' => 'required|string',
            'target_date' => 'required|date',
        ]);

        // Hitung Total Skor
        $totalScore = array_sum($request->scores);

        // Kategori Efektivitas Edukasi sesuai proposal
        $category = 'Edukasi Kurang';
        if ($totalScore >= 29) {
            $category = 'Edukasi Sangat Baik';
        } elseif ($totalScore >= 22) {
            $category = 'Edukasi Cukup';
        }

        // 1. Simpan Data Supervisi
        $supervision = Supervision::create([
            'education_id' => $request->education_id,
            'observer_id' => Auth::id(),
            'item_scores' => $request->scores, // array 18 skor
            'total_score' => $totalScore,
            'evaluation_category' => $category,
            'nurse_strengths' => $request->nurse_strengths,
            'areas_of_improvement' => $request->areas_of_improvement,
        ]);

        // 2. Simpan Data Rencana Tindak Lanjut (RTL)
        FollowUp::create([
            'supervision_id' => $supervision->id,
            'action_plan' => $request->action_plan,
            'target_date' => $request->target_date,
            'status' => 'Belum', // Default awal
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
            'followUps' // Tarik data RTL juga
        ])->latest()->get();

        return view('supervisor.history', compact('completedSupervisions'));
    }

    // Fungsi untuk mengubah status RTL
    public function updateRtl(Request $request, $id)
    {
        if (!Auth::user()->hasRole('Supervisor')) abort(403);
        
        $request->validate(['status' => 'required|in:Belum,Proses,Selesai']);
        
        $rtl = FollowUp::findOrFail($id);
        $rtl->update(['status' => $request->status]);
        
        return redirect()->back()->with('success', 'Status RTL berhasil diperbarui menjadi ' . $request->status . '!');
    }

    // Fungsi sakti untuk Export Data ke CSV/Excel siap pakai (SPSS-ready)
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

        // Judul Kolom di Excel
        $columns = ['ID Supervisi', 'Tanggal', 'Nama Perawat', 'ID Pasien', 'Diet', 'Aktivitas', 'Rokok', 'Obat', 'Stres', 'Bahaya', 'Media', 'Skor Observasi', 'Kategori Efektivitas', 'Kekuatan', 'Area Perbaikan', 'RTL', 'Status RTL'];

        $callback = function() use($supervisions, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns); // Tulis header kolom

            foreach ($supervisions as $s) {
                $rtl = $s->followUps->first();
                $row = [
                    $s->id,
                    $s->created_at->format('Y-m-d'),
                    $s->education->user->name,
                    $s->education->patient->patient_code,
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
                ];
                fputcsv($file, $row); // Tulis baris per baris
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}