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
        .glass-card {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
        .bg-gradient-supervisor {
            background: radial-gradient(circle at top left, #f5f3ff 0%, #f8fafc 50%);
        }
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
                <button type="submit" class="bg-slate-900 hover:bg-red-600 text-white text-[10px] font-bold px-5 py-2.5 rounded-full transition-all duration-300">
                    LOGOUT
                </button>
            </form>
        </div>
    </header>

    <main class="max-w-3xl mx-auto px-8 mt-10">
        <div class="glass-card p-8 rounded-[2.5rem] shadow-2xl shadow-indigo-900/5 mb-10 flex items-center justify-between border-l-8 border-l-indigo-600">
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

        <div class="mb-8 px-2 flex justify-between items-end">
            <div>
                <h3 class="text-xs font-black text-indigo-900 uppercase tracking-[0.2em] mb-1">Quality Control</h3>
                <p class="text-lg font-extrabold text-slate-800">Pending Review Activities</p>
            </div>
            <div class="text-right">
                <span class="text-[10px] font-bold text-slate-400 uppercase">Total Tasks: {{ count($pendingEducations ?? []) }}</span>
            </div>
        </div>
        
        <div class="space-y-6">
            @forelse($pendingEducations ?? [] as $edu)
                <div class="glass-card p-8 rounded-[2.5rem] shadow-lg shadow-slate-200/60 hover:shadow-2xl hover:shadow-indigo-900/10 hover:-translate-y-1 transition-all duration-300 group">
                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
                        <div class="space-y-1 text-left">
                            <div class="flex items-center gap-3">
                                <h4 class="text-lg font-extrabold text-slate-900 tracking-tight">Nurse: {{ $edu->user->name }}</h4>
                                <span class="text-[9px] font-black px-2.5 py-1 bg-amber-50 text-amber-600 rounded-lg uppercase border border-amber-100 tracking-tighter">Needs Evaluation</span>
                            </div>
                            <div class="flex items-center gap-2 text-slate-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                                <p class="text-xs font-bold uppercase tracking-widest italic">Subject ID: {{ $edu->patient->patient_code }}</p>
                            </div>
                        </div>

                        <button class="w-full md:w-auto px-8 py-4 bg-indigo-600 hover:bg-slate-900 text-white font-black rounded-2xl shadow-xl shadow-indigo-100 transition-all duration-300 text-xs uppercase tracking-widest flex items-center justify-center gap-3 group-hover:scale-105">
                            Verify Report
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7-7 7" /></svg>
                        </button>
                    </div>
                </div>
            @empty
                <div class="text-center py-24 bg-white/40 rounded-[3rem] border-2 border-dashed border-indigo-100">
                    <div class="w-20 h-20 bg-indigo-50 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-indigo-200" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    </div>
                    <p class="text-slate-400 font-extrabold italic text-sm tracking-wide">Excellent. All reports verified.</p>
                </div>
            @endforelse
        </div>
    </main>

    <footer class="mt-24 py-10 text-center border-t border-slate-100">
        <p class="text-[10px] text-slate-400 font-black uppercase tracking-[0.4em]">E-Supervisi Intelligence v2.0</p>
        <p class="text-[9px] text-slate-300 mt-2 font-bold uppercase">Clinical Governance | Poltekkes Riau</p>
    </footer>
</body>
</html>