<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Pasien Baru | Sistem E-Supervisi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f8fafc; }
        .glass-card { background: #ffffff; border: 1px solid #e2e8f0; }
    </style>
</head>
<body class="min-h-screen flex flex-col justify-center py-12 px-6">
    <div class="max-w-md w-full mx-auto">
        
        <div class="text-center mb-8">
            <div class="w-12 h-12 bg-rose-100 text-rose-600 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" /></svg>
            </div>
            <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">Input Pasien Baru</h1>
            <p class="text-xs text-slate-500 font-medium mt-1">Registrasi subjek riset Hipertensi & Jantung</p>
        </div>

        <div class="glass-card p-8 rounded-[2rem] shadow-sm border-t-4 border-t-rose-500">
            <form action="{{ route('perawat.patient.store') }}" method="POST" class="space-y-6">
                @csrf
                
                <div>
                    <label class="block text-xs font-black uppercase tracking-widest text-slate-800 mb-1">Inisial Pasien</label>
                    <p class="text-[10px] text-slate-500 font-bold mb-3 italic">*Gunakan inisial untuk menjaga privasi (Contoh: AWP)</p>
                    
                    <input type="text" name="patient_code" required class="w-full bg-slate-50 border border-slate-200 p-4 rounded-2xl outline-none focus:ring-2 focus:ring-rose-200 focus:border-rose-500 transition-all font-bold text-slate-800 text-sm placeholder:font-medium placeholder:text-slate-400 uppercase" placeholder="Masukkan Inisial...">
                </div>

                <div>
                    <label class="block text-xs font-black uppercase tracking-widest text-slate-800 mb-2">Diagnosa Penyakit</label>
                    <textarea name="medical_diagnosis" required rows="3" class="w-full bg-slate-50 border border-slate-200 p-4 rounded-2xl outline-none focus:ring-2 focus:ring-rose-200 focus:border-rose-500 transition-all font-bold text-slate-800 text-sm resize-none placeholder:font-medium placeholder:text-slate-400" placeholder="Contoh: Hipertensi Grade II / Penyakit Jantung Koroner / STEMI..."></textarea>
                </div>

                <button type="submit" class="w-full bg-slate-900 hover:bg-rose-600 text-white font-black py-5 rounded-2xl shadow-md transition-all duration-300 text-sm uppercase tracking-[0.2em] mt-2 flex justify-center items-center gap-2">
                    Simpan Data Pasien
                </button>
                
                <div class="text-center mt-4">
                    <a href="{{ route('perawat.dashboard') }}" class="inline-flex items-center justify-center gap-2 text-[10px] font-black uppercase tracking-widest text-slate-400 hover:text-slate-700 transition-colors p-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
                        Batal & Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>