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
        
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        @if(session('success'))
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'success', title: 'Berhasil!', text: "{{ session('success') }}",
                        showConfirmButton: false, timer: 2500, backdrop: `rgba(15, 23, 42, 0.4)`,
                        customClass: { popup: 'rounded-[2rem] shadow-2xl', title: 'font-black text-2xl text-slate-800' }
                    });
                });
            </script>
        @endif
        
        <div class="grid gap-5">
            @forelse($patients ?? [] as $patient)
                @php
                    $latestEdu = $patient->educations->sortByDesc('created_at')->first();
                    // LOGIKA BARU: Tampilkan Inisial Utuh (Tidak dipotong)
                    $displayInitial = strtoupper($patient->patient_code);
                @endphp
                <div class="glass-card p-6 rounded-[2rem] shadow-lg shadow-slate-200/50 hover:shadow-2xl hover:shadow-blue-900/10 hover:-translate-y-1 transition-all duration-300 group">
                    <div class="flex justify-between items-start">
                        <div class="flex-1">
                            <div class="flex items-center gap-3 mb-1">
                                <span class="text-[10px] font-black uppercase tracking-tighter text-blue-500 bg-blue-50 px-2 py-0.5 rounded-md italic">Inpatient</span>
                                <h4 class="text-lg font-extrabold text-slate-800 tracking-tight">Nama Pasien: {{ $displayInitial }}</h4>
                            </div>
                            <p class="text-sm text-slate-500 font-medium leading-relaxed uppercase">Diagnosa Medis: {{ $patient->medical_diagnosis }}</p>
                        </div>
                        
                        <div class="text-right flex flex-col items-end gap-3">
                            @if(!$latestEdu)
                                <span class="text-[9px] font-bold text-slate-500 bg-slate-100 px-3 py-1 rounded-full border border-slate-200 uppercase tracking-widest">NEEDS EDUCATION</span>
                            @elseif(!$latestEdu->supervision)
                                <span class="text-[9px] font-bold text-amber-600 bg-amber-50 px-3 py-1 rounded-full border border-amber-100 uppercase tracking-widest">PENDING REVIEW</span>
                            @else
                                <span class="text-[9px] font-bold text-emerald-600 bg-emerald-50 px-3 py-1 rounded-full border border-emerald-100 uppercase tracking-widest">VERIFIED: {{ strtoupper($latestEdu->supervision->evaluation_category) }}</span>
                            @endif

                            @if(!$latestEdu || !$latestEdu->supervision)
                            <form action="{{ route('perawat.patient.destroy', $patient->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data pasien ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-slate-300 hover:text-red-500 transition-colors" title="Hapus Pasien">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                </button>
                            </form>
                            @endif
                        </div>
                    </div>

                    <div class="mt-6 flex items-center gap-3">
                        @if(!$latestEdu || !$latestEdu->supervision)
                            <a href="{{ route('perawat.education.create', $patient->id) }}" class="flex-1 bg-slate-900 hover:bg-blue-600 text-white font-bold py-4 rounded-2xl shadow-lg shadow-slate-200 hover:shadow-blue-200 transition-all duration-300 text-sm flex items-center justify-center gap-2">
                                {{ $latestEdu ? 'Lanjutkan Isi Lifestyle Card' : 'Open Lifestyle Card' }}
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
                    <p class="text-slate-400 font-bold italic">Belum ada pasien terdaftar.</p>
                </div>
            @endforelse
        </div>
    </main>
</body>
</html>