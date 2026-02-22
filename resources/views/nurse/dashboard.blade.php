<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nurse Terminal | E-Supervisi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .glass-card { background: rgba(255, 255, 255, 0.8); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.3); }
        .bg-gradient-main { background: radial-gradient(circle at top right, #e0e7ff 0%, #f8fafc 50%); }
    </style>
</head>
<body class="bg-gradient-main min-h-screen pb-24">
    <header class="sticky top-0 z-50 bg-white/70 backdrop-blur-md border-b border-slate-200">
        <div class="max-w-2xl mx-auto px-6 py-4 flex justify-between items-center">
            <div>
                <h1 class="text-xs font-extrabold uppercase tracking-[0.2em] text-blue-600">E-Supervisi</h1>
                <p class="text-lg font-bold text-slate-900">Nurse Terminal</p>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="bg-slate-900 hover:bg-red-600 text-white text-[10px] font-bold px-4 py-2 rounded-full transition-all duration-300">LOGOUT</button>
            </form>
        </div>
    </header>

    <main class="max-w-2xl mx-auto px-6 mt-8">
        <div class="glass-card p-6 rounded-[2rem] shadow-xl shadow-blue-900/5 mb-8 flex items-center gap-4">
            <div class="w-14 h-14 bg-blue-600 rounded-2xl flex items-center justify-center text-white font-black text-xl shadow-lg shadow-blue-200">
                {{ substr(Auth::user()->name, 0, 1) }}
            </div>
            <div>
                <h2 class="text-xl font-extrabold text-slate-900 leading-none">Welcome, {{ Auth::user()->name }}</h2>
                <p class="text-sm text-slate-500 mt-1 font-medium italic">Cardiac Care Unit (CCU)</p>
            </div>
        </div>

        <div class="flex justify-between items-end mb-6">
            <div>
                <h3 class="text-sm font-extrabold text-slate-900 uppercase tracking-widest">Active Patients</h3>
                <p class="text-xs text-slate-400 font-medium">Monitoring & Education list</p>
            </div>
            <a href="{{ route('perawat.patient.add') }}" class="group flex items-center gap-2 bg-white hover:bg-blue-600 border border-slate-200 hover:border-blue-600 px-5 py-2.5 rounded-full shadow-sm transition-all duration-300">
                <span class="text-blue-600 group-hover:text-white text-xs font-bold">+ New Subject</span>
            </a>
        </div>
        
        @if(session('success'))
            <div class="mb-6 p-4 bg-emerald-50 border border-emerald-100 text-emerald-700 text-sm font-semibold rounded-2xl flex items-center gap-3 animate-pulse">
                <div class="w-2 h-2 bg-emerald-500 rounded-full"></div>
                {{ session('success') }}
            </div>
        @endif
        
        <div class="grid gap-5">
            @forelse($patients ?? [] as $patient)
                @php
                    $latestEdu = $patient->educations->sortByDesc('created_at')->first();
                @endphp
                <div class="glass-card p-6 rounded-[2rem] shadow-lg shadow-slate-200/50 hover:shadow-2xl hover:shadow-blue-900/10 hover:-translate-y-1 transition-all duration-300 group">
                    <div class="flex justify-between items-start">
                        <div class="flex-1">
                            <div class="flex items-center gap-3 mb-1">
                                <span class="text-[10px] font-black uppercase tracking-tighter text-blue-500 bg-blue-50 px-2 py-0.5 rounded-md italic">Inpatient</span>
                                <h4 class="text-lg font-extrabold text-slate-800 tracking-tight">ID: {{ $patient->patient_code }}</h4>
                            </div>
                            <p class="text-sm text-slate-500 font-medium leading-relaxed uppercase">Dx: {{ $patient->medical_diagnosis }}</p>
                        </div>
                        <div class="text-right">
                            @if(!$latestEdu)
                                <span class="text-[9px] font-bold text-slate-500 bg-slate-100 px-3 py-1 rounded-full border border-slate-200 uppercase tracking-widest">NEEDS EDUCATION</span>
                            @elseif(!$latestEdu->supervision)
                                <span class="text-[9px] font-bold text-amber-600 bg-amber-50 px-3 py-1 rounded-full border border-amber-100 uppercase tracking-widest">PENDING REVIEW</span>
                            @else
                                <span class="text-[9px] font-bold text-emerald-600 bg-emerald-50 px-3 py-1 rounded-full border border-emerald-100 uppercase tracking-widest">VERIFIED: {{ strtoupper($latestEdu->supervision->evaluation_category) }} ({{ $latestEdu->supervision->total_score }}/36)</span>
                            @endif
                        </div>
                    </div>

                    <div class="mt-6 flex items-center gap-3">
                        @if(!$latestEdu || !$latestEdu->supervision)
                            <a href="{{ route('perawat.education.create', $patient->id) }}" class="flex-1 bg-slate-900 hover:bg-blue-600 text-white font-bold py-4 rounded-2xl shadow-lg shadow-slate-200 hover:shadow-blue-200 transition-all duration-300 text-sm flex items-center justify-center gap-2">
                                Open Lifestyle Card
                            </a>
                        @else
                            <button disabled class="flex-1 bg-slate-50 text-slate-400 font-bold py-4 rounded-2xl border-2 border-dashed border-slate-200 cursor-not-allowed text-sm flex items-center justify-center gap-2 transition-all">
                                Supervision Completed
                            </button>
                        @endif
                    </div>
                </div>
            @empty
                <div class="text-center py-20 bg-white/40 rounded-[2rem] border-2 border-dashed border-slate-200">
                    <p class="text-slate-400 font-bold italic">No active research subjects found.</p>
                </div>
            @endforelse
        </div>
    </main>
</body>
</html>