<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terminal Perawat | E-Supervisi RSUD Arifin Achmad</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f8fafc; }
        .glass-card { background: #ffffff; border: 1px solid #e2e8f0; }
        .text-cardio { color: #e11d48; } 
        .bg-cardio { background-color: #e11d48; }
        .hover-bg-cardio:hover { background-color: #be123c; }
    </style>
</head>
<body class="min-h-screen pb-24">
    <header class="sticky top-0 z-50 bg-white/90 backdrop-blur-md border-b border-slate-200">
        <div class="max-w-2xl mx-auto px-6 py-4 flex justify-between items-center">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-full bg-rose-100 flex items-center justify-center text-cardio">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd" /></svg>
                </div>
                <div>
                    <h1 class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">Terminal Perawat</h1>
                    <p class="text-lg font-bold text-slate-900 leading-none">Sistem E-Supervisi</p>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="bg-slate-100 hover:bg-rose-50 hover:text-cardio text-slate-600 text-[10px] font-bold px-4 py-2 rounded-full transition-all duration-300">LOGOUT</button>
            </form>
        </div>
    </header>

    <main class="max-w-2xl mx-auto px-6 mt-8">
        <div class="glass-card p-6 rounded-[2rem] shadow-sm mb-8 flex items-center gap-4 border-l-4 border-l-rose-500">
            <div class="w-14 h-14 bg-slate-900 rounded-2xl flex items-center justify-center text-white font-black text-xl">
                {{ substr(Auth::user()->name, 0, 1) }}
            </div>
            <div>
                <h2 class="text-xl font-extrabold text-slate-900 leading-none">Selamat Bertugas, {{ Auth::user()->name }}</h2>
                <p class="text-sm text-slate-500 mt-1 font-medium">Fokus Layanan: Pasien Hipertensi & Jantung</p>
            </div>
        </div>

        <div class="flex justify-between items-end mb-6">
            <div>
                <h3 class="text-sm font-extrabold text-slate-900 uppercase tracking-widest">Daftar Pasien Aktif</h3>
                <p class="text-xs text-slate-400 font-medium">Monitoring edukasi gaya hidup</p>
            </div>
            <a href="{{ route('perawat.patient.add') }}" class="group flex items-center gap-2 bg-white border border-slate-200 hover:border-rose-500 px-5 py-2.5 rounded-full shadow-sm transition-all duration-300">
                <span class="text-cardio font-bold text-xs">+ Tambah Pasien</span>
            </a>
        </div>
        
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        @if(session('success'))
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'success', title: 'Berhasil!', text: "{{ session('success') }}",
                        showConfirmButton: false, timer: 2500,
                        customClass: { popup: 'rounded-[2rem] shadow-2xl border border-white', title: 'font-black text-2xl text-slate-800' }
                    });
                });
            </script>
        @endif
        
        <div class="grid gap-5">
            @forelse($patients ?? [] as $patient)
                @php
                    $latestEdu = $patient->educations->sortByDesc('created_at')->first();
                    $displayInitial = strtoupper($patient->patient_code);
                @endphp
                <div class="glass-card p-6 rounded-[2rem] shadow-sm hover:shadow-md transition-all duration-300">
                    <div class="flex flex-wrap md:flex-nowrap justify-between items-start gap-4">
                        <div class="flex-1 w-full">
                            <div class="flex items-center gap-2 mb-3">
                                <span class="w-2 h-2 rounded-full bg-rose-500 animate-pulse"></span>
                                <span class="text-[10px] font-black uppercase tracking-widest text-slate-500">Inisial Pasien:</span>
                                <h4 class="text-xl font-extrabold text-slate-900 tracking-tight">{{ $displayInitial }}</h4>
                            </div>
                            <div class="bg-slate-50 p-3 rounded-xl border border-slate-100">
                                <span class="text-[9px] font-black uppercase tracking-widest text-slate-400 block mb-1">Diagnosa Penyakit:</span>
                                <p class="text-sm text-slate-700 font-bold leading-snug">{{ $patient->medical_diagnosis }}</p>
                            </div>
                        </div>
                        
                        <div class="flex items-center gap-2 mt-2 md:mt-0">
                            @if(!$latestEdu)
                                <span class="text-[10px] font-bold text-rose-600 bg-rose-50 px-3 py-1.5 rounded-full border border-rose-100 whitespace-nowrap">BELUM DIEDUKASI</span>
                            @elseif(!$latestEdu->supervision)
                                <span class="text-[10px] font-bold text-amber-600 bg-amber-50 px-3 py-1.5 rounded-full border border-amber-100 whitespace-nowrap">MENUNGGU REVIEW</span>
                            @else
                                <span class="text-[10px] font-bold text-emerald-600 bg-emerald-50 px-3 py-1.5 rounded-full border border-emerald-100 whitespace-nowrap">SELESAI SUPERVISI</span>
                            @endif

                            @if(!$latestEdu || !$latestEdu->supervision)
                            <form action="{{ route('perawat.patient.destroy', $patient->id) }}" method="POST" onsubmit="return confirm('Hapus data pasien ini?');" class="inline-block">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-slate-400 hover:text-red-500 bg-slate-50 hover:bg-red-50 p-2 rounded-full transition-colors border border-slate-200" title="Hapus Pasien">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                </button>
                            </form>
                            @endif
                        </div>
                    </div>

                    <div class="mt-5">
                        @if(!$latestEdu || !$latestEdu->supervision)
                            <a href="{{ route('perawat.education.create', $patient->id) }}" class="w-full bg-slate-900 hover:bg-rose-600 text-white font-bold py-4 rounded-2xl shadow-md transition-all duration-300 text-sm flex items-center justify-center gap-2">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" /></svg>
                                {{ $latestEdu ? 'Lanjutkan Lifestyle Card' : 'Buka Lifestyle Card' }}
                            </a>
                        @else
                            <button disabled class="w-full bg-slate-50 text-slate-400 font-bold py-4 rounded-2xl border border-slate-200 cursor-not-allowed text-sm flex items-center justify-center gap-2">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" /></svg>
                                Edukasi & Supervisi Selesai
                            </button>
                        @endif
                    </div>
                </div>
            @empty
                <div class="text-center py-20 bg-white rounded-[2rem] border border-slate-200">
                    <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4 text-slate-300">
                        <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                    </div>
                    <p class="text-slate-500 font-bold">Belum ada data pasien.</p>
                </div>
            @endforelse
        </div>
    </main>
</body>
</html>