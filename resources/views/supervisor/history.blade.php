<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Rekap Hasil | E-Supervisi Klinik</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Roboto', sans-serif; background-color: #e2e8f0; }
        .header-blue { background: linear-gradient(90deg, #0056b3 0%, #0072ff 100%); }
        ::-webkit-scrollbar { width: 0px; background: transparent; }
    </style>
</head>
<body class="flex justify-center min-h-screen">

    <div class="w-full max-w-md bg-gray-50 min-h-screen shadow-2xl flex flex-col relative overflow-hidden">
        
        <header class="header-blue text-white px-4 py-4 flex justify-between items-center shadow-md relative z-20">
            <div class="flex items-center gap-4">
                <a href="{{ route('supervisor.dashboard') }}" class="hover:bg-white/20 p-1 rounded-full transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" /></svg>
                </a>
                <h1 class="text-lg font-bold">Rekap Hasil</h1>
            </div>
            
            <a href="{{ route('supervisor.export') }}" class="bg-white text-blue-800 hover:bg-gray-100 flex items-center gap-1 px-3 py-1.5 rounded text-xs font-bold shadow-sm transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" /></svg>
                UNDUH
            </a>
        </header>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        @if(session('success'))
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'success', title: 'Berhasil!', text: "{{ session('success') }}",
                        showConfirmButton: false, timer: 2000,
                        customClass: { popup: 'rounded shadow-xl', title: 'font-bold text-xl' }
                    });
                });
            </script>
        @endif

        <main class="flex-1 overflow-y-auto p-4 space-y-4 pb-20">
            
            <div class="flex justify-between items-center mb-2 px-1">
                <span class="text-xs font-bold text-gray-500 uppercase">Total: {{ count($completedSupervisions) }} Data</span>
            </div>

            @forelse($completedSupervisions as $history)
                <div class="bg-white rounded border border-gray-200 shadow-sm overflow-hidden">
                    <div class="p-4 border-b border-gray-100 flex justify-between items-start">
                        <div>
                            <p class="text-[10px] font-bold text-gray-400 mb-1">{{ $history->created_at->format('d-m-Y') }}</p>
                            <h3 class="font-bold text-gray-800 text-sm">{{ $history->education->user->name }}</h3>
                            <p class="text-xs text-gray-500 font-medium mt-1">Pasien: <span class="font-bold text-blue-700 bg-blue-50 px-1.5 py-0.5 rounded">{{ strtoupper($history->education->patient->patient_code) }}</span></p>
                        </div>
                        <div class="text-right flex flex-col items-end gap-1">
                            <span class="inline-block px-2 py-1 rounded text-[9px] font-bold uppercase tracking-wide border {{ $history->total_score >= 29 ? 'bg-green-50 text-green-700 border-green-200' : ($history->total_score >= 22 ? 'bg-yellow-50 text-yellow-700 border-yellow-200' : 'bg-red-50 text-red-700 border-red-200') }}">
                                {{ $history->evaluation_category }}
                            </span>
                            <span class="text-[10px] font-bold text-gray-500">Skor: {{ $history->total_score }}</span>
                        </div>
                    </div>

                    <div class="p-4 bg-gray-50/50">
                        @if($history->followUps->isNotEmpty())
                            @php $rtl = $history->followUps->first(); @endphp
                            <p class="text-[10px] font-bold text-gray-500 uppercase mb-1">Rencana Tindak Lanjut:</p>
                            <p class="text-sm font-medium text-gray-700 mb-3 line-clamp-2">"{{ $rtl->action_plan }}"</p>
                            
                            <form action="{{ route('supervisor.rtl.update', $rtl->id) }}" method="POST" class="flex items-center justify-between border-t border-gray-200 pt-3 mt-1">
                                @csrf
                                @method('PATCH')
                                <span class="text-[10px] font-bold text-gray-500">Target: {{ \Carbon\Carbon::parse($rtl->target_date)->format('d/m/Y') }}</span>
                                
                                <select name="status" onchange="this.form.submit()" class="text-xs font-bold px-2 py-1.5 rounded border outline-none cursor-pointer {{ $rtl->status == 'Selesai' ? 'bg-green-50 text-green-700 border-green-200' : ($rtl->status == 'Proses' ? 'bg-blue-50 text-blue-700 border-blue-200' : 'bg-yellow-50 text-yellow-700 border-yellow-200') }}">
                                    <option value="Belum" {{ $rtl->status == 'Belum' ? 'selected' : '' }}>⏳ Belum</option>
                                    <option value="Proses" {{ $rtl->status == 'Proses' ? 'selected' : '' }}>🔄 Proses</option>
                                    <option value="Selesai" {{ $rtl->status == 'Selesai' ? 'selected' : '' }}>✅ Selesai</option>
                                </select>
                            </form>
                        @else
                            <p class="text-xs text-gray-400 italic text-center py-2">Tidak ada data RTL</p>
                        @endif
                    </div>
                </div>
            @empty
                <div class="text-center py-16 bg-white border border-gray-200 rounded">
                    <p class="text-gray-400 font-bold text-sm">Belum ada data supervisi.</p>
                </div>
            @endforelse
        </main>
    </div>
</body>
</html>