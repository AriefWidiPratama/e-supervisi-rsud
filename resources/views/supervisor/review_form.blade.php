<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Feedback Supervisi | E-Supervisi Klinik</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Roboto', sans-serif; background-color: #e2e8f0; }
        .header-blue { background: linear-gradient(90deg, #0056b3 0%, #0072ff 100%); }
        /* Style radio button native */
        .radio-score:checked + label { background-color: #0056b3; color: white; border-color: #0056b3; }
    </style>
</head>
<body class="flex justify-center min-h-screen">

    <div class="w-full max-w-md bg-gray-50 min-h-screen shadow-2xl flex flex-col relative">
        
        <header class="header-blue text-white px-4 py-4 flex justify-between items-center shadow-md relative z-20">
            <div class="flex items-center gap-4">
                <a href="{{ route('supervisor.dashboard') }}" class="hover:bg-white/20 p-1 rounded-full transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" /></svg>
                </a>
                <h1 class="text-lg font-bold">Feedback Supervisi</h1>
            </div>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16" /></svg>
        </header>

        <form action="{{ route('supervisor.review.store') }}" method="POST" class="flex-1 flex flex-col overflow-hidden">
            @csrf
            <input type="hidden" name="education_id" value="{{ $education->id }}">

            <main class="flex-1 overflow-y-auto p-5 pb-24 space-y-6">
                
                <div class="bg-white p-4 rounded shadow-sm border border-gray-200">
                    <p class="text-xs text-gray-500 font-bold mb-1">Nama Perawat:</p>
                    <p class="text-sm font-bold text-blue-900 mb-3">{{ $education->user->name }}</p>
                    <p class="text-xs text-gray-500 font-bold mb-1">Pasien & Media:</p>
                    <p class="text-sm font-bold text-gray-800">{{ strtoupper($education->patient->patient_code) }} - {{ $education->used_media }}</p>
                </div>

                <div>
                    <h3 class="font-bold text-blue-900 border-b-2 border-blue-100 pb-2 mb-4">Penilaian Observasi</h3>
                    
                    @php
                    $indikator = [
                        'Persiapan Edukasi' => ['Menyiapkan materi', 'Menggunakan media', 'Menciptakan suasana nyaman'],
                        'Penyampaian' => ['Menjelaskan penyakit', 'Menjelaskan risiko', 'Modifikasi gaya hidup', 'Kepatuhan obat', 'Tanda bahaya']
                    ];
                    $index = 0;
                    @endphp

                    @foreach($indikator as $kategori => $pertanyaan_list)
                    <div class="mb-5">
                        <p class="text-xs font-bold text-gray-500 mb-3 bg-gray-100 px-2 py-1 inline-block rounded">{{ $kategori }}</p>
                        <div class="space-y-3">
                            @foreach($pertanyaan_list as $pertanyaan)
                            <div class="bg-white p-3 rounded border border-gray-200 shadow-sm">
                                <p class="text-sm font-medium text-gray-800 mb-2">{{ $index + 1 }}. {{ $pertanyaan }}</p>
                                <div class="flex gap-2">
                                    @foreach([0, 1, 2] as $nilai)
                                    <div class="flex-1">
                                        <input type="radio" name="scores[{{ $index }}]" id="s_{{ $index }}_{{ $nilai }}" value="{{ $nilai }}" class="radio-score sr-only" required>
                                        <label for="s_{{ $index }}_{{ $nilai }}" class="block text-center border border-gray-300 rounded py-1.5 text-sm font-bold text-gray-500 cursor-pointer transition-colors">{{ $nilai }}</label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @php $index++; @endphp
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                </div>

                <div>
                    <h3 class="font-bold text-blue-900 border-b-2 border-blue-100 pb-2 mb-4">Catatan Kualitatif</h3>
                    
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-1">Kelebihan:</label>
                            <input type="text" name="nurse_strengths" class="w-full border border-gray-300 p-2.5 rounded shadow-sm outline-none focus:border-blue-500 text-sm font-medium" placeholder="Cth: Edukasi sudah jelas">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-1">Kekurangan:</label>
                            <input type="text" name="areas_of_improvement" class="w-full border border-gray-300 p-2.5 rounded shadow-sm outline-none focus:border-blue-500 text-sm font-medium" placeholder="Cth: Kurang cek pemahaman">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-1">Saran / Tindak Lanjut:</label>
                            <input type="text" name="action_plan" class="w-full border border-gray-300 p-2.5 rounded shadow-sm outline-none focus:border-blue-500 text-sm font-medium" required placeholder="Cth: Evaluasi teach-back">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-1">Target Waktu (RTL):</label>
                            <input type="date" name="target_date" class="w-full border border-gray-300 p-2.5 rounded shadow-sm outline-none focus:border-blue-500 text-sm font-medium" required>
                        </div>
                    </div>
                </div>

            </main>

            <div class="bg-white p-4 border-t border-gray-200 sticky bottom-0 z-30 shadow-[0_-4px_10px_rgba(0,0,0,0.05)]">
                <button type="submit" class="w-full bg-[#0056b3] hover:bg-blue-800 text-white font-bold text-lg py-3 rounded shadow transition-colors active:scale-95">
                    SIMPAN
                </button>
            </div>
        </form>

    </div>

</body>
</html>