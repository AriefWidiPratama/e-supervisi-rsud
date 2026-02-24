<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kartu Lifestyle Digital | Sistem E-Supervisi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f8fafc; }
        .glass-card { background: #ffffff; border: 1px solid #e2e8f0; }
    </style>
</head>
<body class="min-h-screen pb-20">
    <header class="max-w-2xl mx-auto px-6 py-8 flex items-center justify-between">
        <a href="{{ route('perawat.dashboard') }}" class="w-10 h-10 bg-white border border-slate-200 rounded-full flex items-center justify-center text-slate-400 hover:text-rose-600 hover:border-rose-200 shadow-sm transition-all">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" /></svg>
        </a>
        <div class="text-right">
            <h1 class="text-[10px] font-black uppercase tracking-[0.3em] text-rose-500">Modul Edukasi</h1>
            <p class="text-lg font-extrabold text-slate-900 leading-tight">Kartu Lifestyle Digital</p>
        </div>
    </header>

    <main class="max-w-2xl mx-auto px-6">
        <div class="glass-card p-6 rounded-[2rem] shadow-sm mb-8 flex justify-between items-center border-l-4 border-l-rose-500">
            <div class="flex-1 pr-4">
                <div class="flex items-center gap-2 mb-1">
                    <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Inisial Pasien:</span>
                    <h2 class="text-xl font-black text-slate-900 tracking-tight">{{ strtoupper($patient->patient_code) }}</h2>
                </div>
                <div class="mt-2 p-3 bg-slate-50 rounded-xl border border-slate-100">
                    <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-1">Diagnosa Penyakit:</p>
                    <p class="text-xs text-slate-700 font-bold leading-relaxed">{{ $patient->medical_diagnosis }}</p>
                </div>
            </div>
            <div class="bg-rose-50 p-4 rounded-2xl text-rose-500 hidden md:flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" /></svg>
            </div>
        </div>

        @php
            $details = isset($education) && is_array($education->detailed_checklists) ? $education->detailed_checklists : [];
        @endphp

        <form action="{{ route('perawat.education.store') }}" method="POST" class="space-y-5">
            @csrf
            <input type="hidden" name="patient_id" value="{{ $patient->id }}">

            <details class="group glass-card rounded-3xl shadow-sm overflow-hidden" {{ (isset($education) && $education->topic_diet) ? '' : 'open' }}>
                <summary class="flex justify-between items-center font-black cursor-pointer list-none p-6 text-slate-800 hover:bg-slate-50 transition-colors">
                    <div class="flex items-center gap-4">
                        <span class="text-2xl bg-slate-50 p-2 rounded-xl">🥗</span>
                        <div>
                            <h3 class="text-[10px] font-black uppercase tracking-[0.2em] text-rose-500 mb-1">Submenu 1</h3>
                            <span class="text-base text-slate-900">Pola Makan Sehat</span>
                        </div>
                    </div>
                    <span class="transition group-open:rotate-180 text-slate-400"><svg fill="none" height="24" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" width="24"><path d="M6 9l6 6 6-6"></path></svg></span>
                </summary>
                <div class="p-6 pt-0 border-t border-slate-100">
                    <div class="space-y-3 mb-6 mt-4">
                        <label class="flex items-center p-4 rounded-2xl border-2 border-slate-100 hover:border-rose-200 cursor-pointer has-[:checked]:bg-rose-50 has-[:checked]:border-rose-500 transition-all">
                            <input type="checkbox" name="details[]" value="Kurangi garam" class="w-5 h-5 text-rose-600 rounded focus:ring-rose-500" {{ in_array('Kurangi garam', $details) ? 'checked' : '' }}>
                            <span class="ml-3 font-bold text-sm text-slate-700">Kurangi garam</span>
                        </label>
                        <label class="flex items-center p-4 rounded-2xl border-2 border-slate-100 hover:border-rose-200 cursor-pointer has-[:checked]:bg-rose-50 has-[:checked]:border-rose-500 transition-all">
                            <input type="checkbox" name="details[]" value="Batasi gorengan" class="w-5 h-5 text-rose-600 rounded focus:ring-rose-500" {{ in_array('Batasi gorengan', $details) ? 'checked' : '' }}>
                            <span class="ml-3 font-bold text-sm text-slate-700">Batasi gorengan</span>
                        </label>
                        <label class="flex items-center p-4 rounded-2xl border-2 border-slate-100 hover:border-rose-200 cursor-pointer has-[:checked]:bg-rose-50 has-[:checked]:border-rose-500 transition-all">
                            <input type="checkbox" name="details[]" value="Perbanyak sayur & buah" class="w-5 h-5 text-rose-600 rounded focus:ring-rose-500" {{ in_array('Perbanyak sayur & buah', $details) ? 'checked' : '' }}>
                            <span class="ml-3 font-bold text-sm text-slate-700">Perbanyak sayur & buah</span>
                        </label>
                    </div>
                    <label class="flex justify-center w-full p-4 bg-slate-100 text-slate-500 rounded-2xl border border-slate-200 cursor-pointer hover:bg-slate-900 hover:text-white transition-all has-[:checked]:bg-emerald-500 has-[:checked]:border-emerald-500 has-[:checked]:text-white">
                        <input type="checkbox" name="topic_diet" class="hidden mark-done-btn" {{ (isset($education) && $education->topic_diet) ? 'checked' : '' }}>
                        <span class="font-black uppercase tracking-[0.2em] text-xs flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" /></svg>
                            Topik Selesai
                        </span>
                    </label>
                </div>
            </details>

            <details class="group glass-card rounded-3xl shadow-sm overflow-hidden">
                <summary class="flex justify-between items-center font-black cursor-pointer list-none p-6 text-slate-800 hover:bg-slate-50 transition-colors">
                    <div class="flex items-center gap-4">
                        <span class="text-2xl bg-slate-50 p-2 rounded-xl">🏃</span>
                        <div>
                            <h3 class="text-[10px] font-black uppercase tracking-[0.2em] text-rose-500 mb-1">Submenu 2</h3>
                            <span class="text-base text-slate-900">Aktivitas Fisik</span>
                        </div>
                    </div>
                    <span class="transition group-open:rotate-180 text-slate-400"><svg fill="none" height="24" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" width="24"><path d="M6 9l6 6 6-6"></path></svg></span>
                </summary>
                <div class="p-6 pt-0 border-t border-slate-100">
                    <div class="space-y-3 mb-6 mt-4">
                        <label class="flex items-center p-4 rounded-2xl border-2 border-slate-100 hover:border-rose-200 cursor-pointer has-[:checked]:bg-rose-50 has-[:checked]:border-rose-500 transition-all">
                            <input type="checkbox" name="details[]" value="Anjuran aktivitas" class="w-5 h-5 text-rose-600 rounded focus:ring-rose-500" {{ in_array('Anjuran aktivitas', $details) ? 'checked' : '' }}>
                            <span class="ml-3 font-bold text-sm text-slate-700">Anjuran aktivitas</span>
                        </label>
                        <label class="flex items-center p-4 rounded-2xl border-2 border-slate-100 hover:border-rose-200 cursor-pointer has-[:checked]:bg-rose-50 has-[:checked]:border-rose-500 transition-all">
                            <input type="checkbox" name="details[]" value="Batas aman aktivitas" class="w-5 h-5 text-rose-600 rounded focus:ring-rose-500" {{ in_array('Batas aman aktivitas', $details) ? 'checked' : '' }}>
                            <span class="ml-3 font-bold text-sm text-slate-700">Batas aman aktivitas</span>
                        </label>
                    </div>
                    <label class="flex justify-center w-full p-4 bg-slate-100 text-slate-500 rounded-2xl border border-slate-200 cursor-pointer hover:bg-slate-900 hover:text-white transition-all has-[:checked]:bg-emerald-500 has-[:checked]:border-emerald-500 has-[:checked]:text-white">
                        <input type="checkbox" name="topic_activity" class="hidden mark-done-btn" {{ (isset($education) && $education->topic_activity) ? 'checked' : '' }}>
                        <span class="font-black uppercase tracking-[0.2em] text-xs flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" /></svg>
                            Topik Selesai
                        </span>
                    </label>
                </div>
            </details>

            <details class="group glass-card rounded-3xl shadow-sm overflow-hidden">
                <summary class="flex justify-between items-center font-black cursor-pointer list-none p-6 text-slate-800 hover:bg-slate-50 transition-colors">
                    <div class="flex items-center gap-4">
                        <span class="text-2xl bg-slate-50 p-2 rounded-xl">🚭</span>
                        <div>
                            <h3 class="text-[10px] font-black uppercase tracking-[0.2em] text-rose-500 mb-1">Submenu 3</h3>
                            <span class="text-base text-slate-900">Berhenti Merokok</span>
                        </div>
                    </div>
                    <span class="transition group-open:rotate-180 text-slate-400"><svg fill="none" height="24" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" width="24"><path d="M6 9l6 6 6-6"></path></svg></span>
                </summary>
                <div class="p-6 pt-0 border-t border-slate-100">
                    <div class="space-y-3 mb-6 mt-4">
                        <label class="flex items-center p-4 rounded-2xl border-2 border-slate-100 hover:border-rose-200 cursor-pointer has-[:checked]:bg-rose-50 has-[:checked]:border-rose-500 transition-all">
                            <input type="checkbox" name="details[]" value="Edukasi berhenti merokok" class="w-5 h-5 text-rose-600 rounded focus:ring-rose-500" {{ in_array('Edukasi berhenti merokok', $details) ? 'checked' : '' }}>
                            <span class="ml-3 font-bold text-sm text-slate-700">Edukasi berhenti merokok</span>
                        </label>
                        <label class="flex items-center p-4 rounded-2xl border-2 border-slate-100 hover:border-rose-200 cursor-pointer has-[:checked]:bg-rose-50 has-[:checked]:border-rose-500 transition-all">
                            <input type="checkbox" name="details[]" value="Edukasi hindari asap rokok" class="w-5 h-5 text-rose-600 rounded focus:ring-rose-500" {{ in_array('Edukasi hindari asap rokok', $details) ? 'checked' : '' }}>
                            <span class="ml-3 font-bold text-sm text-slate-700">Edukasi hindari asap rokok</span>
                        </label>
                    </div>
                    <label class="flex justify-center w-full p-4 bg-slate-100 text-slate-500 rounded-2xl border border-slate-200 cursor-pointer hover:bg-slate-900 hover:text-white transition-all has-[:checked]:bg-emerald-500 has-[:checked]:border-emerald-500 has-[:checked]:text-white">
                        <input type="checkbox" name="topic_smoking" class="hidden mark-done-btn" {{ (isset($education) && $education->topic_smoking) ? 'checked' : '' }}>
                        <span class="font-black uppercase tracking-[0.2em] text-xs flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" /></svg>
                            Topik Selesai
                        </span>
                    </label>
                </div>
            </details>

            <details class="group glass-card rounded-3xl shadow-sm overflow-hidden">
                <summary class="flex justify-between items-center font-black cursor-pointer list-none p-6 text-slate-800 hover:bg-slate-50 transition-colors">
                    <div class="flex items-center gap-4">
                        <span class="text-2xl bg-slate-50 p-2 rounded-xl">💊</span>
                        <div>
                            <h3 class="text-[10px] font-black uppercase tracking-[0.2em] text-rose-500 mb-1">Submenu 4</h3>
                            <span class="text-base text-slate-900">Kepatuhan Minum Obat</span>
                        </div>
                    </div>
                    <span class="transition group-open:rotate-180 text-slate-400"><svg fill="none" height="24" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" width="24"><path d="M6 9l6 6 6-6"></path></svg></span>
                </summary>
                <div class="p-6 pt-0 border-t border-slate-100">
                    <div class="space-y-3 mb-6 mt-4">
                        <label class="flex items-center p-4 rounded-2xl border-2 border-slate-100 hover:border-rose-200 cursor-pointer has-[:checked]:bg-rose-50 has-[:checked]:border-rose-500 transition-all">
                            <input type="checkbox" name="details[]" value="Waktu minum obat" class="w-5 h-5 text-rose-600 rounded focus:ring-rose-500" {{ in_array('Waktu minum obat', $details) ? 'checked' : '' }}>
                            <span class="ml-3 font-bold text-sm text-slate-700">Waktu minum obat</span>
                        </label>
                        <label class="flex items-center p-4 rounded-2xl border-2 border-slate-100 hover:border-rose-200 cursor-pointer has-[:checked]:bg-rose-50 has-[:checked]:border-rose-500 transition-all">
                            <input type="checkbox" name="details[]" value="Kepatuhan obat" class="w-5 h-5 text-rose-600 rounded focus:ring-rose-500" {{ in_array('Kepatuhan obat', $details) ? 'checked' : '' }}>
                            <span class="ml-3 font-bold text-sm text-slate-700">Kepatuhan obat</span>
                        </label>
                    </div>
                    <label class="flex justify-center w-full p-4 bg-slate-100 text-slate-500 rounded-2xl border border-slate-200 cursor-pointer hover:bg-slate-900 hover:text-white transition-all has-[:checked]:bg-emerald-500 has-[:checked]:border-emerald-500 has-[:checked]:text-white">
                        <input type="checkbox" name="topic_medication" class="hidden mark-done-btn" {{ (isset($education) && $education->topic_medication) ? 'checked' : '' }}>
                        <span class="font-black uppercase tracking-[0.2em] text-xs flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" /></svg>
                            Topik Selesai
                        </span>
                    </label>
                </div>
            </details>

            <details class="group glass-card rounded-3xl shadow-sm overflow-hidden">
                <summary class="flex justify-between items-center font-black cursor-pointer list-none p-6 text-slate-800 hover:bg-slate-50 transition-colors">
                    <div class="flex items-center gap-4">
                        <span class="text-2xl bg-slate-50 p-2 rounded-xl">😌</span>
                        <div>
                            <h3 class="text-[10px] font-black uppercase tracking-[0.2em] text-rose-500 mb-1">Submenu 5</h3>
                            <span class="text-base text-slate-900">Manajemen Stres</span>
                        </div>
                    </div>
                    <span class="transition group-open:rotate-180 text-slate-400"><svg fill="none" height="24" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" width="24"><path d="M6 9l6 6 6-6"></path></svg></span>
                </summary>
                <div class="p-6 pt-0 border-t border-slate-100">
                    <div class="space-y-3 mb-6 mt-4">
                        <label class="flex items-center p-4 rounded-2xl border-2 border-slate-100 hover:border-rose-200 cursor-pointer has-[:checked]:bg-rose-50 has-[:checked]:border-rose-500 transition-all">
                            <input type="checkbox" name="details[]" value="Istirahat cukup" class="w-5 h-5 text-rose-600 rounded focus:ring-rose-500" {{ in_array('Istirahat cukup', $details) ? 'checked' : '' }}>
                            <span class="ml-3 font-bold text-sm text-slate-700">Istirahat cukup</span>
                        </label>
                        <label class="flex items-center p-4 rounded-2xl border-2 border-slate-100 hover:border-rose-200 cursor-pointer has-[:checked]:bg-rose-50 has-[:checked]:border-rose-500 transition-all">
                            <input type="checkbox" name="details[]" value="Relaksasi/ibadah" class="w-5 h-5 text-rose-600 rounded focus:ring-rose-500" {{ in_array('Relaksasi/ibadah', $details) ? 'checked' : '' }}>
                            <span class="ml-3 font-bold text-sm text-slate-700">Relaksasi/ibadah</span>
                        </label>
                    </div>
                    <label class="flex justify-center w-full p-4 bg-slate-100 text-slate-500 rounded-2xl border border-slate-200 cursor-pointer hover:bg-slate-900 hover:text-white transition-all has-[:checked]:bg-emerald-500 has-[:checked]:border-emerald-500 has-[:checked]:text-white">
                        <input type="checkbox" name="topic_stress" class="hidden mark-done-btn" {{ (isset($education) && $education->topic_stress) ? 'checked' : '' }}>
                        <span class="font-black uppercase tracking-[0.2em] text-xs flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" /></svg>
                            Topik Selesai
                        </span>
                    </label>
                </div>
            </details>

            <details class="group glass-card rounded-3xl shadow-sm overflow-hidden">
                <summary class="flex justify-between items-center font-black cursor-pointer list-none p-6 text-slate-800 hover:bg-slate-50 transition-colors">
                    <div class="flex items-center gap-4">
                        <span class="text-2xl bg-slate-50 p-2 rounded-xl">⚠️</span>
                        <div>
                            <h3 class="text-[10px] font-black uppercase tracking-[0.2em] text-rose-500 mb-1">Submenu 6</h3>
                            <span class="text-base text-slate-900">Tanda Bahaya</span>
                        </div>
                    </div>
                    <span class="transition group-open:rotate-180 text-slate-400"><svg fill="none" height="24" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" width="24"><path d="M6 9l6 6 6-6"></path></svg></span>
                </summary>
                <div class="p-6 pt-0 border-t border-slate-100">
                    <div class="space-y-3 mb-6 mt-4">
                        <label class="flex items-center p-4 rounded-2xl border-2 border-slate-100 hover:border-red-200 cursor-pointer has-[:checked]:bg-red-50 has-[:checked]:border-red-500 transition-all">
                            <input type="checkbox" name="details[]" value="Nyeri dada" class="w-5 h-5 text-red-600 rounded focus:ring-red-500" {{ in_array('Nyeri dada', $details) ? 'checked' : '' }}>
                            <span class="ml-3 font-bold text-sm text-red-700">🚨 Nyeri dada</span>
                        </label>
                        <label class="flex items-center p-4 rounded-2xl border-2 border-slate-100 hover:border-red-200 cursor-pointer has-[:checked]:bg-red-50 has-[:checked]:border-red-500 transition-all">
                            <input type="checkbox" name="details[]" value="Sesak napas" class="w-5 h-5 text-red-600 rounded focus:ring-red-500" {{ in_array('Sesak napas', $details) ? 'checked' : '' }}>
                            <span class="ml-3 font-bold text-sm text-red-700">🚨 Sesak napas</span>
                        </label>
                        <label class="flex items-center p-4 rounded-2xl border-2 border-slate-100 hover:border-red-200 cursor-pointer has-[:checked]:bg-red-50 has-[:checked]:border-red-500 transition-all">
                            <input type="checkbox" name="details[]" value="Pusing berat" class="w-5 h-5 text-red-600 rounded focus:ring-red-500" {{ in_array('Pusing berat', $details) ? 'checked' : '' }}>
                            <span class="ml-3 font-bold text-sm text-red-700">🚨 Pusing berat</span>
                        </label>
                    </div>
                    <label class="flex justify-center w-full p-4 bg-slate-100 text-slate-500 rounded-2xl border border-slate-200 cursor-pointer hover:bg-slate-900 hover:text-white transition-all has-[:checked]:bg-emerald-500 has-[:checked]:border-emerald-500 has-[:checked]:text-white">
                        <input type="checkbox" name="topic_warning_signs" class="hidden mark-done-btn" {{ (isset($education) && $education->topic_warning_signs) ? 'checked' : '' }}>
                        <span class="font-black uppercase tracking-[0.2em] text-xs flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" /></svg>
                            Pasien Sudah Paham
                        </span>
                    </label>
                </div>
            </details>

            <div class="glass-card p-6 rounded-[2rem] shadow-sm mt-8 border-t-4 border-t-rose-500">
                <div class="mb-4 text-center">
                    <h3 class="font-black text-slate-900 text-sm uppercase tracking-widest">Media Edukasi</h3>
                    <p class="text-[10px] font-bold text-slate-400 uppercase mt-1">Pilih media yang digunakan saat edukasi</p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-3 mb-8">
                    <label class="flex items-center p-4 rounded-2xl border-2 border-slate-100 cursor-pointer hover:border-rose-200 has-[:checked]:bg-rose-50 has-[:checked]:border-rose-500 transition-all">
                        <input type="radio" name="used_media" value="Digital Card" class="hidden" required {{ (isset($education) && $education->used_media == 'Digital Card') ? 'checked' : '' }}>
                        <span class="font-bold text-slate-700 text-sm text-center w-full">📱 Kartu Digital</span>
                    </label>
                    <label class="flex items-center p-4 rounded-2xl border-2 border-slate-100 cursor-pointer hover:border-rose-200 has-[:checked]:bg-rose-50 has-[:checked]:border-rose-500 transition-all">
                        <input type="radio" name="used_media" value="Printed Card" class="hidden" {{ (isset($education) && $education->used_media == 'Printed Card') ? 'checked' : '' }}>
                        <span class="font-bold text-slate-700 text-sm text-center w-full">📄 Kartu Cetak</span>
                    </label>
                    <label class="flex items-center p-4 rounded-2xl border-2 border-slate-100 cursor-pointer hover:border-rose-200 has-[:checked]:bg-rose-50 has-[:checked]:border-rose-500 transition-all">
                        <input type="radio" name="used_media" value="Combination" class="hidden" {{ (isset($education) && $education->used_media == 'Combination') ? 'checked' : '' }}>
                        <span class="font-bold text-slate-700 text-sm text-center w-full">🔄 Kombinasi</span>
                    </label>
                </div>

                <button type="submit" class="w-full bg-slate-900 hover:bg-rose-600 text-white font-black py-5 rounded-2xl shadow-md transition-all duration-300 text-sm uppercase tracking-[0.2em] flex items-center justify-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" /></svg>
                    {{ isset($education) ? 'Update Data Edukasi' : 'Simpan Data Edukasi' }}
                </button>
            </div>
        </form>
    </main>

    <script>
        document.querySelectorAll('.mark-done-btn').forEach(btn => {
            btn.addEventListener('change', function() {
                if(this.checked) {
                    let currentDetails = this.closest('details');
                    let nextDetails = currentDetails.nextElementSibling;
                    setTimeout(() => {
                        currentDetails.removeAttribute('open');
                        if(nextDetails && nextDetails.tagName === 'DETAILS') {
                            nextDetails.setAttribute('open', 'open');
                        }
                    }, 400); 
                }
            });
        });
    </script>
</body>
</html>