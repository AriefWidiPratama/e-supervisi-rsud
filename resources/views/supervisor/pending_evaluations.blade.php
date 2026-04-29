<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Antrean Supervisi | E-Supervisi Klinik</title>
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
        
        <header class="header-blue text-white px-4 py-4 flex items-center gap-4 shadow-md relative z-20">
            <a href="{{ route('supervisor.dashboard') }}" class="hover:bg-white/20 p-1 rounded-full transition-colors active:scale-90">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" /></svg>
            </a>
            <h1 class="text-lg font-bold">Antrean Observasi</h1>
        </header>

        <main class="flex-1 overflow-y-auto p-4 space-y-4">
            
            <div class="bg-blue-50 border border-blue-100 p-3 rounded text-sm text-blue-800 font-medium mb-2">
                Pilih perawat di bawah ini untuk memulai evaluasi kinerja edukasi.
            </div>

            <div class="space-y-3">
                @forelse($pendingEducations ?? [] as $edu)
                    <div class="bg-white p-4 rounded-lg border border-gray-200 shadow-sm flex justify-between items-center">
                        <div>
                            <h4 class="font-bold text-gray-900 text-sm">{{ $edu->user->name }}</h4>
                            <p class="text-[10px] font-bold text-gray-500 mt-1 uppercase">Pasien: <span class="text-blue-700 bg-blue-50 px-1.5 py-0.5 rounded">{{ strtoupper($edu->patient->patient_code) }}</span></p>
                        </div>
                        <a href="{{ route('supervisor.review', $edu->id) }}" class="bg-[#0056b3] hover:bg-blue-800 text-white text-xs font-bold px-4 py-2.5 rounded shadow active:scale-90 transition-transform">
                            EVALUASI
                        </a>
                    </div>
                @empty
                    <div class="text-center py-20 bg-white rounded-lg border border-gray-200">
                        <div class="text-4xl mb-3">🎉</div>
                        <h3 class="font-bold text-gray-700">Tidak ada antrean!</h3>
                        <p class="text-xs text-gray-400 mt-1 font-medium">Semua form edukasi sudah dievaluasi.</p>
                    </div>
                @endforelse
            </div>

        </main>
    </div>
</body>
</html>