<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Digital Lifestyle Card | E-Supervisi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .glass-card { background: rgba(255, 255, 255, 0.8); backdrop-filter: blur(12px); border: 1px solid rgba(255, 255, 255, 0.3); }
        .bg-gradient-edu { background: radial-gradient(circle at top right, #eff6ff 0%, #f8fafc 50%); }
    </style>
</head>
<body class="bg-gradient-edu min-h-screen pb-12">
    <header class="max-w-2xl mx-auto px-6 py-8 flex items-center justify-between">
        <a href="{{ route('perawat.dashboard') }}" class="text-slate-400 hover:text-slate-900 transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor font-bold"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7" /></svg>
        </a>
        <div class="text-right">
            <h1 class="text-[10px] font-black uppercase tracking-[0.3em] text-blue-600">Research Instrument</h1>
            <p class="text-lg font-extrabold text-slate-900 leading-tight">Digital Lifestyle Card</p>
        </div>
    </header>

    <main class="max-w-2xl mx-auto px-6">
        <div class="glass-card p-6 rounded-[2rem] shadow-xl shadow-blue-900/5 mb-8 border-l-8 border-l-blue-600">
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Subject Identity</p>
            <h2 class="text-xl font-black text-slate-900 tracking-tight">ID: {{ $patient->patient_code }}</h2>
            <p class="text-sm text-slate-500 font-medium mt-1">Dx: {{ $patient->medical_diagnosis }}</p>
        </div>

        <form action="{{ route('perawat.education.store') }}" method="POST">
            @csrf
            <input type="hidden" name="patient_id" value="{{ $patient->id }}">

            <div class="space-y-6">
                <div class="glass-card p-8 rounded-[2.5rem] shadow-lg shadow-slate-200/50">
                    <div class="mb-6">
                        <h3 class="font-black text-slate-900 text-sm uppercase tracking-wide">Topik Edukasi Lifestyle</h3>
                        <p class="text-[10px] text-slate-400 font-bold uppercase">Centang materi yang telah dijelaskan ke pasien</p>
                    </div>

                    <div class="space-y-3">
                        <label class="flex items-center p-4 rounded-2xl border-2 border-slate-100 hover:border-blue-200 cursor-pointer transition-all has-[:checked]:bg-blue-50 has-[:checked]:border-blue-500">
                            <input type="checkbox" name="topic_diet" class="w-5 h-5 text-blue-600 rounded">
                            <span class="ml-3 font-bold text-slate-700 text-sm">🥗 Pola Makan Sehat (Rendah Garam & Lemak)</span>
                        </label>
                        <label class="flex items-center p-4 rounded-2xl border-2 border-slate-100 hover:border-blue-200 cursor-pointer transition-all has-[:checked]:bg-blue-50 has-[:checked]:border-blue-500">
                            <input type="checkbox" name="topic_activity" class="w-5 h-5 text-blue-600 rounded">
                            <span class="ml-3 font-bold text-slate-700 text-sm">🏃‍♂️ Aktivitas Fisik (Sesuai Kemampuan)</span>
                        </label>
                        <label class="flex items-center p-4 rounded-2xl border-2 border-slate-100 hover:border-blue-200 cursor-pointer transition-all has-[:checked]:bg-blue-50 has-[:checked]:border-blue-500">
                            <input type="checkbox" name="topic_smoking" class="w-5 h-5 text-blue-600 rounded">
                            <span class="ml-3 font-bold text-slate-700 text-sm">🚭 Hindari Rokok & Asap Rokok</span>
                        </label>
                        <label class="flex items-center p-4 rounded-2xl border-2 border-slate-100 hover:border-blue-200 cursor-pointer transition-all has-[:checked]:bg-blue-50 has-[:checked]:border-blue-500">
                            <input type="checkbox" name="topic_medication" class="w-5 h-5 text-blue-600 rounded">
                            <span class="ml-3 font-bold text-slate-700 text-sm">💊 Kepatuhan Minum Obat</span>
                        </label>
                        <label class="flex items-center p-4 rounded-2xl border-2 border-slate-100 hover:border-blue-200 cursor-pointer transition-all has-[:checked]:bg-blue-50 has-[:checked]:border-blue-500">
                            <input type="checkbox" name="topic_stress" class="w-5 h-5 text-blue-600 rounded">
                            <span class="ml-3 font-bold text-slate-700 text-sm">😌 Manajemen Stres & Istirahat</span>
                        </label>
                        <label class="flex items-center p-4 rounded-2xl border-2 border-slate-100 hover:border-blue-200 cursor-pointer transition-all has-[:checked]:bg-blue-50 has-[:checked]:border-blue-500">
                            <input type="checkbox" name="topic_warning_signs" class="w-5 h-5 text-blue-600 rounded">
                            <span class="ml-3 font-bold text-slate-700 text-sm">⚠️ Pengenalan Tanda Bahaya (Nyeri Dada, dll)</span>
                        </label>
                    </div>
                </div>

                <div class="glass-card p-8 rounded-[2.5rem] shadow-lg shadow-slate-200/50">
                    <div class="mb-4">
                        <h3 class="font-black text-slate-900 text-sm uppercase tracking-wide">Media Edukasi</h3>
                    </div>
                    <div class="grid grid-cols-1 gap-3">
                        <label class="flex items-center p-4 rounded-2xl border-2 border-slate-100 cursor-pointer has-[:checked]:bg-blue-50 has-[:checked]:border-blue-500">
                            <input type="radio" name="used_media" value="Digital Card" class="hidden" required>
                            <span class="font-bold text-slate-700 text-sm">📱 Kartu Lifestyle Digital</span>
                        </label>
                        <label class="flex items-center p-4 rounded-2xl border-2 border-slate-100 cursor-pointer has-[:checked]:bg-blue-50 has-[:checked]:border-blue-500">
                            <input type="radio" name="used_media" value="Printed Card" class="hidden">
                            <span class="font-bold text-slate-700 text-sm">📄 Kartu Lifestyle Cetak</span>
                        </label>
                        <label class="flex items-center p-4 rounded-2xl border-2 border-slate-100 cursor-pointer has-[:checked]:bg-blue-50 has-[:checked]:border-blue-500">
                            <input type="radio" name="used_media" value="Combination" class="hidden">
                            <span class="font-bold text-slate-700 text-sm">🔄 Kombinasi (Cetak & Digital)</span>
                        </label>
                    </div>
                </div>

                <button type="submit" class="w-full bg-slate-900 hover:bg-blue-600 text-white font-black py-5 rounded-[2rem] shadow-2xl transition-all duration-300 text-sm uppercase tracking-[0.2em]">
                    Simpan Edukasi
                </button>
            </div>
        </form>
    </main>
</body>
</html>