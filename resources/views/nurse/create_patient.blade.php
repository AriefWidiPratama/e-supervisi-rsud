<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Pasien Baru | E-Supervisi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .glass-card { background: rgba(255, 255, 255, 0.9); backdrop-filter: blur(12px); border: 1px solid rgba(255, 255, 255, 0.4); }
        .bg-gradient-main { background: radial-gradient(circle at top right, #e0e7ff 0%, #f8fafc 50%); }
    </style>
</head>
<body class="bg-gradient-main min-h-screen flex flex-col justify-center py-12 px-6">
    <div class="max-w-md w-full mx-auto">
        
        <div class="text-center mb-8">
            <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Input Pasien Baru</h1>
        </div>

        <div class="glass-card p-8 rounded-[2.5rem] shadow-2xl shadow-blue-900/5 border-t-8 border-t-blue-600">
            <form action="{{ route('perawat.patient.store') }}" method="POST" class="space-y-6">
                @csrf
                
                <div>
                    <label class="block text-xs font-black uppercase tracking-widest text-slate-800 mb-1">Inisial Pasien</label>
                    <p class="text-[10px] text-slate-500 font-bold mb-3 italic">*Gunakan inisial untuk menjaga privasi medis (Contoh: BS)</p>
                    
                    <input type="text" name="patient_code" required class="w-full bg-white border border-slate-200 p-4 rounded-2xl outline-none focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all font-bold text-slate-800 text-sm placeholder:font-medium placeholder:text-slate-300 shadow-sm uppercase" placeholder="Masukkan Inisial...">
                </div>

                <div>
                    <label class="block text-xs font-black uppercase tracking-widest text-slate-800 mb-2">Diagnosis Medis</label>
                    <textarea name="medical_diagnosis" required rows="3" class="w-full bg-white border border-slate-200 p-4 rounded-2xl outline-none focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all font-bold text-slate-800 text-sm resize-none placeholder:font-medium placeholder:text-slate-300 shadow-sm" placeholder="Contoh: Hipertensi Grade II / Penyakit Jantung Koroner..."></textarea>
                </div>

                <button type="submit" class="w-full bg-slate-900 hover:bg-blue-600 text-white font-black py-5 rounded-[2rem] shadow-xl shadow-blue-900/10 transition-all duration-300 text-sm uppercase tracking-[0.2em] mt-2">
                    Simpan Data Pasien
                </button>
                
                <div class="text-center mt-6">
                    <a href="{{ route('perawat.dashboard') }}" class="text-[10px] font-black uppercase tracking-widest text-slate-400 hover:text-red-500 transition-colors flex items-center justify-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
                        Batal & Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>