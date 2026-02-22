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
        .glass-card { background: rgba(255, 255, 255, 0.8); backdrop-filter: blur(12px); border: 1px solid rgba(255, 255, 255, 0.3); }
        .bg-gradient-supervisor { background: radial-gradient(circle at top left, #f5f3ff 0%, #f8fafc 50%); }
    </style>
</head>
<body class="bg-gradient-supervisor min-h-screen pb-24">
    <header class="sticky top-0 z-50 bg-white/70 backdrop-blur-md border-b border-indigo-100">
        <div class="max-w-3xl mx-auto px-8 py-5 flex justify-between items-center">
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

    <main class="max-w-3xl mx-auto px-8 mt-10">
        <div class="glass-card p-8 rounded-[2.5rem] shadow-2xl shadow-indigo-900/5 mb-6 flex items-center justify-between border-l-8 border-l-indigo-600">
            <div class="flex items-center gap-6">
                <div class="w-16 h-16 bg-indigo-600 rounded-2xl flex items-center justify-center text-white font-black text-2xl shadow-xl shadow-indigo-200">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
                <div>
                    <h2 class="text-2xl font-extrabold text-slate-900 tracking-tight leading-none">Hello, {{ Auth::user()->name }}</h2>
                    <p class="text-sm text-slate-400 mt-2 font-bold uppercase tracking-widest text-[10px]">Clinical Supervisor Lead</p>
                </div>
            </div>
            <div class="hidden md:block text-right">
                <p class="text-[10px] font-black text-slate-400 uppercase">Current Date</p>
                <p class="font-bold text-slate-800">{{ now()->format('d M Y') }}</p>
            </div>
        </div>

        <div class="mb-8 flex justify-end">
            <a href="{{ route('supervisor.history') }}" class="flex items-center gap-2 text-[10px] font-black uppercase tracking-widest text-indigo-600 bg-white px-5 py-3 rounded-full shadow-sm hover:shadow-md transition-all border border-indigo-100">
                View History Log & RTL
            </a>
        </div>

        <div class="mb-8 px-2 flex justify-between items-end">
            <div>
                <h3 class="text-xs font-black text-indigo-900 uppercase tracking-[0.2em] mb-1">Quality Control</h3>
                <p class="text-lg font-extrabold text-slate-800">Pending Review Activities</p>
            </div>
            <div class="text-right">
                <span class="text-[10px] font-bold text-slate-400 uppercase">Total Tasks: {{ count($pendingEducations ?? []) }}</span>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        @if(session('success'))
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: "{{ session('success') }}",
                        showConfirmButton: false,
                        timer: 2500,
                        backdrop: `rgba(15, 23, 42, 0.4)`,
                        customClass: {
                            popup: 'rounded-[2rem] shadow-2xl border border-white/20',
                            title: 'font-black text-2xl text-slate-800 tracking-tight',
                            htmlContainer: 'text-sm font-bold text-slate-500'
                        }
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
                @endphp
                <div class="glass-card p-8 rounded-[2.5rem] shadow-lg shadow-slate-200/60 hover:shadow-2xl hover:shadow-indigo-900/10 hover:-translate-y-1 transition-all duration-300 group">
                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
                        <div class="space-y-1 text-left flex-1">
                            <div class="flex items-center gap-3">
                                <h4 class="text-lg font-extrabold text-slate-900 tracking-tight">Nurse: {{ $edu->user->name }}</h4>
                                <span class="text-[9px] font-black px-2.5 py-1 bg-amber-50 text-amber-600 rounded-lg uppercase border border-amber-100 tracking-tighter">Needs Evaluation</span>
                            </div>
                            <div class="flex items-center gap-2 text-slate-400 mb-3">
                                <p class="text-xs font-bold uppercase tracking-widest italic tracking-tight">Subject ID: {{ $edu->patient->patient_code }}</p>
                            </div>
                            
                            <div class="flex gap-4 items-center pt-2">
                                <div class="flex flex-col">
                                    <span class="text-[8px] font-black text-slate-400 uppercase">Topik Edukasi</span>
                                    <span class="text-xs font-bold text-slate-700">{{ $topics }}/6 Tersampaikan</span>
                                </div>
                                <div class="w-px h-4 bg-slate-200"></div>
                                <div class="flex flex-col">
                                    <span class="text-[8px] font-black text-slate-400 uppercase">Media</span>
                                    <span class="text-xs font-bold text-slate-700">{{ $edu->used_media }}</span>
                                </div>
                            </div>
                        </div>

                        <a href="{{ route('supervisor.review', $edu->id) }}" class="w-full md:w-auto px-8 py-4 bg-indigo-600 hover:bg-slate-900 text-white font-black rounded-2xl shadow-xl shadow-indigo-100 transition-all duration-300 text-xs uppercase tracking-widest flex items-center justify-center gap-3 group-hover:scale-105">
                            Verify Report
                        </a>
                    </div>
                </div>
            @empty
                <div class="text-center py-24 bg-white/40 rounded-[3rem] border-2 border-dashed border-indigo-100">
                    <p class="text-slate-400 font-extrabold italic text-sm tracking-wide">Excellent. All reports verified.</p>
                </div>
            @endforelse
        </div>
    </main>
</body>
</html>