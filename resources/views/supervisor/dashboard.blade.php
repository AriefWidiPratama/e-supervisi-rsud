<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supervisor Executive | E-Supervisi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .glass-card { background: rgba(255, 255, 255, 0.8); backdrop-filter: blur(12px); border: 1px solid rgba(255, 255, 255, 0.5); }
        .premium-gradient { background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%); }
        .bg-gradient-supervisor { background: radial-gradient(circle at top left, #f5f3ff 0%, #f8fafc 50%); }
    </style>
</head>
<body class="bg-gradient-supervisor min-h-screen pb-24">
    <header class="sticky top-0 z-50 bg-white/70 backdrop-blur-md border-b border-indigo-100">
        <div class="max-w-4xl mx-auto px-8 py-5 flex justify-between items-center">
            <div>
                <h1 class="text-[10px] font-black uppercase tracking-[0.3em] text-indigo-600 mb-1">Monitoring System</h1>
                <p class="text-xl font-extrabold text-slate-900 tracking-tight">Supervisor Panel</p>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="bg-slate-900 hover:bg-red-600 text-white text-[10px] font-bold px-5 py-2.5 rounded-full transition-all duration-300">LOGOUT</button>
            </form>
        </div>
    </header>

    <main class="max-w-4xl mx-auto px-6 md:px-8 mt-10">
        <div class="glass-card p-8 rounded-[2.5rem] shadow-2xl shadow-indigo-900/5 mb-8 flex flex-col md:flex-row items-start md:items-center justify-between border-l-8 border-l-indigo-600 gap-6">
            <div class="flex items-center gap-6">
                <div class="w-16 h-16 bg-indigo-600 rounded-2xl flex items-center justify-center text-white font-black text-2xl shadow-xl shadow-indigo-200">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
                <div>
                    <h2 class="text-2xl font-extrabold text-slate-900 tracking-tight leading-none">Hello, {{ Auth::user()->name }}</h2>
                    <p class="text-sm text-slate-400 mt-2 font-bold uppercase tracking-widest text-[10px]">Clinical Supervisor Lead</p>
                </div>
            </div>
            <div class="flex flex-col gap-2 w-full md:w-auto text-right">
                <a href="{{ route('supervisor.nurses') }}" class="inline-flex items-center justify-center gap-2 text-[10px] font-black uppercase tracking-widest text-white bg-indigo-600 hover:bg-indigo-700 px-5 py-3 rounded-full transition-all shadow-md">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" /></svg>
                    Kelola Akun Perawat
                </a>
                <a href="{{ route('supervisor.history') }}" class="inline-flex items-center justify-center gap-2 text-[10px] font-black uppercase tracking-widest text-indigo-600 bg-indigo-50 hover:bg-indigo-100 px-5 py-3 rounded-full transition-all">
                    View History Log & RTL
                </a>
            </div>
        </div>

        <div class="mb-10">
            <h3 class="text-xs font-black text-indigo-900 uppercase tracking-[0.2em] mb-4">Performance Analytics</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                
                <div class="premium-gradient p-6 rounded-[2rem] shadow-xl text-white relative overflow-hidden">
                    <div class="relative z-10">
                        <p class="text-[10px] font-black uppercase tracking-widest text-indigo-200 mb-1">Rata-Rata Skor Edukasi</p>
                        <div class="flex items-baseline gap-2 mt-2">
                            <h4 class="text-5xl font-black tracking-tighter">{{ $avgScore }}</h4>
                            <span class="text-indigo-200 font-bold text-sm">/ 36</span>
                        </div>
                        <p class="text-xs font-medium text-indigo-100 mt-3">Dari total {{ $totalSupervisions }} supervisi</p>
                    </div>
                    <svg class="absolute -bottom-4 -right-4 w-32 h-32 text-white/10" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z"/><path d="M12 6c-3.31 0-6 2.69-6 6s2.69 6 6 6 6-2.69 6-6-2.69-6-6-6zm0 10c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4z"/></svg>
                </div>

                <div class="md:col-span-2 glass-card p-6 rounded-[2rem] shadow-lg flex flex-col justify-center">
                    <p class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-4">Distribusi Efektivitas Edukasi Perawat</p>
                    
                    <div class="space-y-4">
                        <div>
                            <div class="flex justify-between text-xs font-bold mb-1">
                                <span class="text-emerald-600">Sangat Baik (≥29)</span>
                                <span class="text-slate-600">{{ $pctSangatBaik }}%</span>
                            </div>
                            <div class="w-full bg-slate-100 rounded-full h-2.5">
                                <div class="bg-emerald-500 h-2.5 rounded-full" style="width: {{ $pctSangatBaik }}%"></div>
                            </div>
                        </div>
                        <div>
                            <div class="flex justify-between text-xs font-bold mb-1">
                                <span class="text-amber-500">Cukup (22-28)</span>
                                <span class="text-slate-600">{{ $pctCukup }}%</span>
                            </div>
                            <div class="w-full bg-slate-100 rounded-full h-2.5">
                                <div class="bg-amber-400 h-2.5 rounded-full" style="width: {{ $pctCukup }}%"></div>
                            </div>
                        </div>
                        <div>
                            <div class="flex justify-between text-xs font-bold mb-1">
                                <span class="text-red-500">Kurang (<22)</span>
                                <span class="text-slate-600">{{ $pctKurang }}%</span>
                            </div>
                            <div class="w-full bg-slate-100 rounded-full h-2.5">
                                <div class="bg-red-500 h-2.5 rounded-full" style="width: {{ $pctKurang }}%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mb-6 flex justify-between items-end">
            <div>
                <h3 class="text-xs font-black text-indigo-900 uppercase tracking-[0.2em] mb-1">Quality Control</h3>
                <p class="text-lg font-extrabold text-slate-800">Pending Review Activities</p>
            </div>
            <div class="text-right bg-slate-100 px-3 py-1 rounded-lg">
                <span class="text-[10px] font-bold text-slate-500 uppercase">Tasks: {{ count($pendingEducations ?? []) }}</span>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        @if(session('success'))
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'success', title: 'Berhasil!', text: "{{ session('success') }}",
                        showConfirmButton: false, timer: 2500, backdrop: `rgba(15, 23, 42, 0.4)`,
                        customClass: { popup: 'rounded-[2rem] shadow-2xl border border-white/20', title: 'font-black text-2xl text-slate-800 tracking-tight' }
                    });
                });
            </script>
        @endif
        
        <div class="space-y-6">
            @forelse($pendingEducations ?? [] as $edu)
                @php
                    $topics = 0;
                    if($edu->topic_diet) $topics++;
                    if($edu->topic_activity) $topics++;
                    if($edu->topic_smoking) $topics++;
                    if($edu->topic_medication) $topics++;
                    if($edu->topic_stress) $topics++;
                    if($edu->topic_warning_signs) $topics++;

                    // LOGIKA INISIAL: Mengambil utuh tanpa dipotong
                    $displayInitial = strtoupper($edu->patient->patient_code);
                @endphp
                <div class="glass-card p-6 md:p-8 rounded-[2.5rem] shadow-lg shadow-slate-200/60 hover:shadow-2xl hover:shadow-indigo-900/10 hover:-translate-y-1 transition-all duration-300 group border border-slate-100">
                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
                        <div class="space-y-1 text-left flex-1">
                            <div class="flex items-center gap-3">
                                <h4 class="text-lg font-extrabold text-slate-900 tracking-tight">Nurse: {{ $edu->user->name }}</h4>
                                <span class="text-[9px] font-black px-2.5 py-1 bg-amber-50 text-amber-600 rounded-lg uppercase border border-amber-100 tracking-tighter">Needs Evaluation</span>
                            </div>
                            
                            <div class="flex items-center gap-2 mt-1">
                                <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Subjek Riset:</span>
                                <span class="text-sm font-black text-indigo-600 tracking-widest">{{ $displayInitial }}</span>
                            </div>
                            
                            <div class="flex gap-4 items-center pt-3 border-t border-slate-100 mt-4">
                                <div class="flex flex-col">
                                    <span class="text-[8px] font-black text-slate-400 uppercase">Topik Edukasi</span>
                                    <span class="text-sm font-black text-slate-700">{{ $topics }}/6 Tersampaikan</span>
                                </div>
                                <div class="w-px h-6 bg-slate-200"></div>
                                <div class="flex flex-col">
                                    <span class="text-[8px] font-black text-slate-400 uppercase">Media Edukasi</span>
                                    <span class="text-sm font-black text-slate-700">{{ $edu->used_media }}</span>
                                </div>
                            </div>
                        </div>

                        <a href="{{ route('supervisor.review', $edu->id) }}" class="w-full md:w-auto px-8 py-5 bg-indigo-600 hover:bg-slate-900 text-white font-black rounded-2xl shadow-xl shadow-indigo-200 transition-all duration-300 text-xs uppercase tracking-widest flex items-center justify-center gap-3 group-hover:scale-105">
                            Verify Report
                        </a>
                    </div>
                </div>
            @empty
                <div class="text-center py-20 bg-white/40 rounded-[3rem] border-2 border-dashed border-indigo-100">
                    <p class="text-slate-400 font-extrabold italic text-sm tracking-wide">Excellent. All reports verified.</p>
                </div>
            @endforelse
        </div>
    </main>
</body>
</html>