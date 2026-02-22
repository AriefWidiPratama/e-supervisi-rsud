<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supervision History | E-Supervisi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .glass-card { background: rgba(255, 255, 255, 0.9); backdrop-filter: blur(12px); border: 1px solid rgba(255, 255, 255, 0.3); }
        .bg-gradient-history { background: radial-gradient(circle at top left, #eef2ff 0%, #f1f5f9 100%); }
    </style>
</head>
<body class="bg-gradient-history min-h-screen p-6">
    <main class="max-w-7xl mx-auto">
        
        @if(session('success'))
            <div class="mb-4 p-4 bg-emerald-50 border border-emerald-100 text-emerald-700 text-sm font-semibold rounded-2xl flex items-center gap-3 animate-pulse">
                <div class="w-2 h-2 bg-emerald-500 rounded-full"></div>
                {{ session('success') }}
            </div>
        @endif

        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
            <div>
                <a href="{{ route('supervisor.dashboard') }}" class="flex items-center gap-2 text-slate-400 hover:text-indigo-600 transition-colors mb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
                    <span class="text-xs font-bold uppercase tracking-widest">Back to Dashboard</span>
                </a>
                <h1 class="text-3xl font-extrabold text-slate-900">Rekap Supervisi & RTL</h1>
                <p class="text-sm text-slate-500 font-medium mt-1">Arsip penilaian kinerja edukasi perawat dan pemantauan tindak lanjut</p>
            </div>
            
            <div class="flex items-center gap-4">
                <div class="bg-white px-6 py-3 rounded-2xl border border-slate-200 shadow-sm text-center">
                    <span class="text-[10px] font-black uppercase text-slate-400 tracking-widest">Total Record</span>
                    <p class="text-2xl font-black text-indigo-600 leading-none mt-1">{{ count($completedSupervisions) }}</p>
                </div>
                <a href="{{ route('supervisor.export') }}" class="bg-emerald-600 hover:bg-emerald-500 text-white px-6 py-4 rounded-2xl shadow-lg shadow-emerald-200 flex items-center gap-2 font-black uppercase text-xs tracking-widest transition-all hover:-translate-y-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" /></svg>
                    Download Data Riset
                </a>
            </div>
        </div>

        <div class="glass-card rounded-[2rem] shadow-xl overflow-hidden border-t-8 border-t-indigo-600">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-200 text-slate-500">
                            <th class="p-5 text-[10px] font-black uppercase tracking-widest">Tanggal</th>
                            <th class="p-5 text-[10px] font-black uppercase tracking-widest">Perawat & Pasien</th>
                            <th class="p-5 text-[10px] font-black uppercase tracking-widest">Hasil Observasi</th>
                            <th class="p-5 text-[10px] font-black uppercase tracking-widest w-1/3">Rencana Tindak Lanjut (RTL)</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($completedSupervisions as $history)
                            <tr class="hover:bg-white transition-colors">
                                <td class="p-5 align-top">
                                    <span class="font-bold text-slate-700 text-sm block">{{ $history->created_at->format('d M Y') }}</span>
                                </td>
                                <td class="p-5 align-top">
                                    <div class="font-extrabold text-slate-800 text-base">{{ $history->education->user->name }}</div>
                                    <div class="text-xs text-slate-500 mt-1 font-medium">Subjek: <span class="bg-slate-100 px-2 py-0.5 rounded text-slate-600 font-bold">{{ $history->education->patient->patient_code }}</span></div>
                                </td>
                                <td class="p-5 align-top">
                                    <div class="inline-block px-3 py-1 rounded-full border {{ $history->total_score >= 29 ? 'bg-emerald-50 text-emerald-700 border-emerald-200' : ($history->total_score >= 22 ? 'bg-amber-50 text-amber-700 border-amber-200' : 'bg-red-50 text-red-700 border-red-200') }}">
                                        <span class="text-[10px] font-black uppercase tracking-widest">{{ $history->evaluation_category }}</span>
                                    </div>
                                    <div class="text-xs text-slate-500 mt-2 font-bold">Skor: {{ $history->total_score }} / 36</div>
                                </td>
                                <td class="p-5 align-top">
                                    @if($history->followUps->isNotEmpty())
                                        @php $rtl = $history->followUps->first(); @endphp
                                        <p class="text-xs text-slate-700 font-semibold mb-3 leading-relaxed">"{{ $rtl->action_plan }}"</p>
                                        
                                        <form action="{{ route('supervisor.rtl.update', $rtl->id) }}" method="POST" class="flex items-center gap-2">
                                            @csrf
                                            @method('PATCH')
                                            <span class="text-[9px] font-black uppercase tracking-widest text-slate-400">Target: {{ \Carbon\Carbon::parse($rtl->target_date)->format('d/m/y') }}</span>
                                            
                                            <select name="status" onchange="this.form.submit()" class="text-[10px] font-bold px-2 py-1 rounded border outline-none cursor-pointer {{ $rtl->status == 'Selesai' ? 'bg-emerald-50 text-emerald-600 border-emerald-200' : ($rtl->status == 'Proses' ? 'bg-blue-50 text-blue-600 border-blue-200' : 'bg-amber-50 text-amber-600 border-amber-200') }}">
                                                <option value="Belum" {{ $rtl->status == 'Belum' ? 'selected' : '' }}>Belum</option>
                                                <option value="Proses" {{ $rtl->status == 'Proses' ? 'selected' : '' }}>Proses</option>
                                                <option value="Selesai" {{ $rtl->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                                            </select>
                                        </form>

                                    @else
                                        <span class="text-xs text-slate-400 italic font-medium">Tidak ada data RTL</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="p-16 text-center text-slate-400 text-sm font-bold">
                                    Belum ada data supervisi yang diarsipkan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</body>
</html>