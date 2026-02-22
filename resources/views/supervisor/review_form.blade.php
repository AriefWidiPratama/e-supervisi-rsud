<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clinical Review | E-Supervisi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .glass-card { background: rgba(255, 255, 255, 0.9); backdrop-filter: blur(16px); border: 1px solid rgba(255, 255, 255, 0.4); }
        .bg-gradient-review { background: radial-gradient(circle at top right, #eef2ff 0%, #f8fafc 100%); }
        /* Kustomisasi Radio Button agar terlihat seperti tombol kotak */
        .score-radio:checked + label {
            background-color: #4f46e5; /* Indigo 600 */
            color: white;
            border-color: #4f46e5;
            box-shadow: 0 4px 14px 0 rgba(79, 70, 229, 0.39);
        }
    </style>
</head>
<body class="bg-gradient-review min-h-screen pb-20 p-4 md:p-8">
    <main class="max-w-4xl mx-auto">
        <header class="mb-8 flex justify-between items-end">
            <div>
                <a href="{{ route('supervisor.dashboard') }}" class="inline-flex items-center gap-2 text-slate-400 hover:text-indigo-600 transition-colors mb-3 font-bold text-xs uppercase tracking-widest">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
                    Back to Panel
                </a>
                <h1 class="text-3xl font-black text-slate-900 leading-tight tracking-tight">Observasi Edukasi</h1>
                <p class="text-sm text-slate-500 font-medium mt-1">Instrumen Penilaian Kinerja Perawat Berbasis Praktik Bukti</p>
            </div>
            <div class="text-right hidden md:block">
                <p class="text-[10px] font-black uppercase tracking-[0.3em] text-indigo-600 bg-indigo-50 px-3 py-1 rounded-full border border-indigo-100">FORM 02-OBS</p>
            </div>
        </header>

        <div class="glass-card p-6 md:p-8 rounded-[2rem] shadow-xl shadow-indigo-900/5 mb-8 border-l-8 border-l-indigo-600">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Perawat Pelaksana</p>
                    <p class="text-xl font-extrabold text-slate-800">{{ $education->user->name }}</p>
                    <div class="mt-4 flex gap-4">
                        <div>
                            <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Pasien ID</p>
                            <p class="font-bold text-slate-700">{{ $education->patient->patient_code }}</p>
                        </div>
                        <div>
                            <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Media Edukasi</p>
                            <p class="font-bold text-indigo-600">{{ $education->used_media }}</p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-slate-50 p-4 rounded-2xl border border-slate-100">
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Materi yang Disampaikan (Self-Report)</p>
                    <div class="flex flex-wrap gap-2">
                        @if($education->topic_diet) <span class="text-[10px] font-bold bg-white px-2 py-1 rounded border shadow-sm">🥗 Diet</span> @endif
                        @if($education->topic_activity) <span class="text-[10px] font-bold bg-white px-2 py-1 rounded border shadow-sm">🏃 Aktivitas</span> @endif
                        @if($education->topic_smoking) <span class="text-[10px] font-bold bg-white px-2 py-1 rounded border shadow-sm">🚭 Rokok</span> @endif
                        @if($education->topic_medication) <span class="text-[10px] font-bold bg-white px-2 py-1 rounded border shadow-sm">💊 Obat</span> @endif
                        @if($education->topic_stress) <span class="text-[10px] font-bold bg-white px-2 py-1 rounded border shadow-sm">😌 Stres</span> @endif
                        @if($education->topic_warning_signs) <span class="text-[10px] font-bold bg-white px-2 py-1 rounded border shadow-sm">⚠️ Bahaya</span> @endif
                    </div>
                </div>
            </div>
        </div>

        <form action="{{ route('supervisor.review.store') }}" method="POST" class="space-y-8">
            @csrf
            <input type="hidden" name="education_id" value="{{ $education->id }}">

            <div class="glass-card p-6 md:p-8 rounded-[2rem] shadow-lg shadow-slate-200/50">
                <div class="mb-6 border-b border-slate-100 pb-4">
                    <h2 class="text-xl font-black text-slate-900 tracking-tight">A. Penilaian Observasi</h2>
                    <p class="text-xs text-slate-500 font-medium mt-1">Pilih skor: <span class="font-bold text-slate-700">0</span> (Tidak), <span class="font-bold text-slate-700">1</span> (Sebagian/Kurang Tepat), <span class="font-bold text-slate-700">2</span> (Baik & Benar)</p>
                </div>

                @php
                // Array Instrumen dari Proposal Penelitian Poltekkes Riau
                $indikator_observasi = [
                    '1. Persiapan Edukasi' => [
                        'Perawat menyiapkan materi edukasi sesuai kondisi pasien',
                        'Perawat menggunakan media edukasi (kartu lifestyle/aplikasi)',
                        'Perawat menciptakan suasana nyaman (privasi & waktu)'
                    ],
                    '2. Proses Penyampaian Edukasi' => [
                        'Menjelaskan penyakit jantung secara sederhana & jelas',
                        'Menjelaskan faktor risiko & penyebab penyakit',
                        'Menjelaskan modifikasi gaya hidup (diet, aktivitas, stres)',
                        'Menjelaskan kepatuhan minum obat',
                        'Menjelaskan tanda dan gejala bahaya'
                    ],
                    '3. Interaksi & Komunikasi' => [
                        'Bahasa yang digunakan mudah dipahami pasien',
                        'Memberi kesempatan pasien/keluarga bertanya',
                        'Menjawab pertanyaan pasien dengan tepat',
                        'Menggunakan pendekatan empatik & sopan'
                    ],
                    '4. Evaluasi Pemahaman Pasien' => [
                        'Meminta pasien mengulang informasi penting',
                        'Mengklarifikasi pemahaman pasien',
                        'Memberikan penguatan ulang bila pasien belum paham'
                    ],
                    '5. Penutup & Dokumentasi' => [
                        'Menyimpulkan poin utama edukasi',
                        'Menganjurkan penerapan edukasi setelah pulang',
                        'Mendokumentasikan edukasi dalam catatan keperawatan'
                    ]
                ];
                $index = 0;
                @endphp

                <div class="space-y-8">
                    @foreach($indikator_observasi as $fase => $pertanyaan_list)
                    <div>
                        <h3 class="text-sm font-black text-indigo-600 uppercase tracking-widest bg-indigo-50 inline-block px-3 py-1 rounded-md mb-4">{{ $fase }}</h3>
                        <div class="space-y-4">
                            @foreach($pertanyaan_list as $pertanyaan)
                            <div class="flex flex-col md:flex-row md:items-center justify-between p-4 bg-white rounded-2xl border border-slate-100 hover:border-indigo-200 transition-colors gap-4">
                                <p class="text-sm font-bold text-slate-700 flex-1">{{ $index + 1 }}. {{ $pertanyaan }}</p>
                                <div class="flex gap-2 shrink-0">
                                    @foreach([0, 1, 2] as $nilai)
                                    <div class="relative">
                                        <input type="radio" name="scores[{{ $index }}]" id="q_{{ $index }}_v_{{ $nilai }}" value="{{ $nilai }}" class="score-radio peer sr-only" required>
                                        <label for="q_{{ $index }}_v_{{ $nilai }}" class="flex items-center justify-center w-10 h-10 rounded-xl border-2 border-slate-200 text-slate-500 font-black cursor-pointer transition-all hover:bg-slate-50">
                                            {{ $nilai }}
                                        </label>
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
            </div>

            <div class="glass-card p-6 md:p-8 rounded-[2rem] shadow-lg shadow-slate-200/50">
                <div class="mb-6 border-b border-slate-100 pb-4">
                    <h2 class="text-xl font-black text-slate-900 tracking-tight">B. Umpan Balik Kualitatif</h2>
                    <p class="text-xs text-slate-500 font-medium mt-1">Catatan pembinaan berdasarkan observasi</p>
                </div>

                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-xs font-black uppercase tracking-widest text-emerald-600 mb-2">Kekuatan Perawat</label>
                        <textarea name="nurse_strengths" rows="3" class="w-full bg-white/50 border border-emerald-200 p-4 rounded-2xl outline-none focus:ring-4 focus:ring-emerald-100 focus:border-emerald-500 transition-all font-bold text-slate-700 text-sm resize-none placeholder:font-medium placeholder:text-slate-400" placeholder="Contoh: Sangat empatik, bahasa mudah dipahami..."></textarea>
                    </div>
                    <div>
                        <label class="block text-xs font-black uppercase tracking-widest text-amber-600 mb-2">Area yang Perlu Ditingkatkan</label>
                        <textarea name="areas_of_improvement" rows="3" class="w-full bg-white/50 border border-amber-200 p-4 rounded-2xl outline-none focus:ring-4 focus:ring-amber-100 focus:border-amber-500 transition-all font-bold text-slate-700 text-sm resize-none placeholder:font-medium placeholder:text-slate-400" placeholder="Contoh: Lupa menggunakan kartu lifestyle saat awal edukasi..."></textarea>
                    </div>
                </div>
            </div>

            <div class="glass-card p-6 md:p-8 rounded-[2rem] shadow-lg shadow-slate-200/50 border-t-8 border-t-blue-500">
                <div class="mb-6">
                    <h2 class="text-xl font-black text-slate-900 tracking-tight">C. Rencana Tindak Lanjut (RTL)</h2>
                    <p class="text-xs text-slate-500 font-medium mt-1">Kesepakatan perbaikan kompetensi edukasi</p>
                </div>

                <div class="grid md:grid-cols-3 gap-6">
                    <div class="md:col-span-2">
                        <label class="block text-xs font-black uppercase tracking-widest text-slate-500 mb-2">Aksi / Tindak Lanjut</label>
                        <input type="text" name="action_plan" class="w-full bg-white/50 border border-slate-200 p-4 rounded-2xl outline-none focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all font-bold text-slate-700 text-sm" placeholder="Contoh: Mengulang simulasi edukasi diet dengan media..." required>
                    </div>
                    <div>
                        <label class="block text-xs font-black uppercase tracking-widest text-slate-500 mb-2">Target Waktu</label>
                        <input type="date" name="target_date" class="w-full bg-white/50 border border-slate-200 p-4 rounded-2xl outline-none focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all font-bold text-slate-700 text-sm" required>
                    </div>
                </div>
            </div>

            <button type="submit" class="w-full bg-indigo-600 hover:bg-slate-900 text-white font-black py-6 rounded-[2rem] shadow-2xl shadow-indigo-200 hover:shadow-slate-300 transition-all duration-300 text-sm md:text-base uppercase tracking-[0.2em]">
                Finalisasi & Simpan Penilaian
            </button>
        </form>
    </main>
</body>
</html>