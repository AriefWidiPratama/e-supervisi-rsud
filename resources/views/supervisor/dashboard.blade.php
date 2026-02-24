<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Supervisor | E-Supervisi Kardiologi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f8fafc; }
        .glass-card { background: #ffffff; border: 1px solid #e2e8f0; }
        .premium-gradient { background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%); } /* Elegan Dark */
        .text-cardio { color: #e11d48; }
    </style>
</head>
<body class="min-h-screen pb-24">
    <header class="sticky top-0 z-50 bg-white/90 backdrop-blur-md border-b border-slate-200">
        <div class="max-w-4xl mx-auto px-6 py-4 flex justify-between items-center">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-full bg-slate-900 flex items-center justify-center text-white">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" /></svg>
                </div>
                <div>
                    <h1 class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">Monitoring System</h1>
                    <p class="text-lg font-bold text-slate-900 leading-none">Supervisor Panel</p>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="bg-rose-50 hover:bg-rose-600 hover:text-white text-rose-600 text-[10px] font-bold px-4 py-2 rounded-full transition-all duration-300">LOGOUT</button>
            </form>
        </div>
    </header>

    <main class="max-w-4xl mx-auto px-6 mt-8">
        <div class="glass-card p-6 md:p-8 rounded-[2rem] shadow-sm mb-8 flex flex-col md:flex-row items-start md:items-center justify-between border-l-4 border-l-slate-800 gap-6">
            <div class="flex items-center gap-5">
                <div class="w-14 h-14 bg-slate-100 rounded-full flex items-center justify-center text-slate-700 font-black text-xl border-2 border-slate-200">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
                <div>
                    <h2 class="text-xl font-extrabold text-slate-900 tracking-tight leading-none">Hello, {{ Auth::user()->name }}</h2>
                    <p class="text-sm text-slate-500 mt-1 font-medium">Kepala Ruangan / Supervisor</p>
                </div>
            </div>
            <div class="flex flex-wrap gap-2 w-full md:w-auto">
                <a href="{{ route('supervisor.nurses') }}" class="inline-flex items-center gap-2 text-xs font-bold text-slate-700 bg-slate-100 hover:bg-slate-200 px-4 py-2.5 rounded-xl transition-all">
                    Kelola Perawat
                </a>
                <a href="{{ route('supervisor.history') }}" class="inline-flex items-center gap-2 text-xs font-bold text-white bg-slate-900 hover:bg-slate-800 px-4 py-2.5 rounded-xl transition-all">
                    Riwayat Supervisi
                </a>
            </div>
        </div>

        <div class="mb-10">
            <h3 class="text-xs font-black text-slate-500 uppercase tracking-widest mb-4">Statistik Performa Edukasi</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                <div class="premium-gradient p-6 rounded-[2rem] shadow-lg text-white">
                    <p class="text-[10px] font-bold uppercase tracking-widest text-slate-300 mb-1">Rata-Rata Skor Edukasi</p>
                    <div class="flex items-baseline gap-2 mt-2">
                        <h4 class="text-5xl font-black">{{ $avgScore }}</h4>
                        <span class="text-slate-400 font-bold text-sm">/ 36</span>
                    </div>
                    <p class="text-xs font-medium text-slate-400 mt-3">Dari {{ $totalSupervisions }} supervisi</p>
                </div>

                <div class="md:col-span-2 glass-card p-6 rounded-[2rem] shadow-sm flex flex-col justify-center">
                    <div class="space-y-4">
                        <div>
                            <div class="flex justify-between text-xs font-bold mb-1">
                                <span class="text-emerald-600">Sangat Baik (≥29)</span>
                                <span class="text-slate-600">{{ $pctSangatBaik }}%</span>
                            </div>
                            <div class="w-full bg-slate-100 rounded-full h-2">
                                <div class="bg-emerald-500 h-2 rounded-full" style="width: {{ $pctSangatBaik }}%"></div>
                            </div>
                        </div>
                        <div>
                            <div class="flex justify-between text-xs font-bold mb-1">
                                <span class="text-amber-500">Cukup (22-28)</span>
                                <span class="text-slate-600">{{ $pctCukup }}%</span>
                            </div>
                            <div class="w-full bg-slate-100 rounded-full h-2">
                                <div class="bg-amber-400 h-2 rounded-full" style="width: {{ $pctCukup }}%"></div>
                            </div>
                        </div>
                        <div>
                            <div class="flex justify-between text-xs font-bold mb-1">
                                <span class="text-rose-500">Kurang (<22)</span>
                                <span class="text-slate-600">{{ $pctKurang }}%</span>
                            </div>
                            <div class="w-full bg-slate-100 rounded-full h-2">
                                <div class="bg-rose-500 h-2 rounded-full" style="width: {{ $pctKurang }}%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mb-4 flex justify-between items-end">
            <h3 class="text-sm font-extrabold text-slate-900 uppercase tracking-widest">Antrean Evaluasi</h3>
            <span class="text-[10px] font-bold text-slate-500 bg-white px-3 py-1 rounded-lg border border-slate-200">Sisa: {{ count($pendingEducations ?? []) }}</span>
        </div>
        
        <div class="space-y-4">
            @forelse($pendingEducations ?? [] as $edu)
                @php
                    $topics = 0;
                    if($edu->topic_diet) $topics++;
                    if($edu->topic_activity) $topics++;
                    if($edu->topic_smoking) $topics++;
                    if($edu->topic_medication) $topics++;
                    if($edu->topic_stress) $topics++;
                    if($edu->topic_warning_signs) $topics++;
                    $displayInitial = strtoupper($edu->patient->patient_code);
                @endphp
                <div class="glass-card p-5 md:p-6 rounded-3xl shadow-sm hover:shadow-md transition-all group">
                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-5">
                        <div class="flex-1">
                            <div class="flex items-center gap-3 mb-2">
                                <span class="w-2 h-2 rounded-full bg-amber-500 animate-pulse"></span>
                                <h4 class="text-sm font-extrabold text-slate-900">Perawat: {{ $edu->user->name }}</h4>
                            </div>
                            
                            <div class="grid grid-cols-2 gap-4 mt-3 p-4 bg-slate-50 rounded-2xl">
                                <div>
                                    <span class="text-[9px] font-black uppercase tracking-widest text-slate-400 block mb-1">Inisial Pasien</span>
                                    <p class="text-sm font-bold text-slate-800">{{ $displayInitial }}</p>
                                </div>
                                <div>
                                    <span class="text-[9px] font-black uppercase tracking-widest text-slate-400 block mb-1">Diagnosa Penyakit</span>
                                    <p class="text-xs font-bold text-slate-700 truncate" title="{{ $edu->patient->medical_diagnosis }}">{{ $edu->patient->medical_diagnosis }}</p>
                                </div>
                                <div>
                                    <span class="text-[9px] font-black uppercase tracking-widest text-slate-400 block mb-1">Topik Disampaikan</span>
                                    <p class="text-xs font-bold text-emerald-600">{{ $topics }}/6 Topik</p>
                                </div>
                                <div>
                                    <span class="text-[9px] font-black uppercase tracking-widest text-slate-400 block mb-1">Media</span>
                                    <p class="text-xs font-bold text-slate-700">{{ $edu->used_media }}</p>
                                </div>
                            </div>
                        </div>

                        <a href="{{ route('supervisor.review', $edu->id) }}" class="w-full md:w-auto px-6 py-4 bg-slate-900 hover:bg-rose-600 text-white font-bold rounded-xl shadow-md transition-all text-xs uppercase tracking-widest text-center">
                            Mulai Evaluasi
                        </a>
                    </div>
                </div>
            @empty
                <div class="text-center py-16 bg-white rounded-[2rem] border border-slate-200">
                    <p class="text-slate-400 font-bold text-sm">Semua laporan telah dievaluasi.</p>
                </div>
            @endforelse
        </div>
    </main>
</body>
</html>