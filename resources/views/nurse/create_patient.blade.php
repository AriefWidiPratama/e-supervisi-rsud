<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Data Pasien | E-Supervisi Klinik</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Roboto', sans-serif; background-color: #e2e8f0; }
        /* Warna Hijau khas Poster RSUD */
        .header-green { background: #1e503e; }
        .bg-app { background-color: #f4f7f6; }
    </style>
</head>
<body class="flex justify-center min-h-screen">

    <div class="w-full max-w-md bg-app min-h-screen shadow-2xl flex flex-col relative overflow-hidden">
        
        <!-- Header -->
        <header class="header-green text-white px-4 py-4 flex items-center gap-4 shadow-md relative z-20 rounded-b-xl">
            <a href="{{ route('perawat.dashboard') }}" class="hover:bg-white/20 p-2 rounded-full transition-colors active:scale-90">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" /></svg>
            </a>
            <h1 class="text-lg font-bold">Data Pasien Baru</h1>
        </header>

        <!-- Main Content -->
        <main class="flex-1 p-5 relative z-10 mt-2">
            
            <div class="mb-4 ml-1">
                <p class="text-sm font-bold text-gray-500">Silakan masukkan data pasien yang akan diberikan edukasi.</p>
            </div>

            <!-- Kartu Form -->
            <form action="{{ route('perawat.patient.store') }}" method="POST" class="bg-white p-5 rounded-2xl shadow-sm border border-emerald-100 space-y-5 relative overflow-hidden">
                <!-- Aksen garis hijau di kiri form -->
                <div class="absolute left-0 top-0 bottom-0 w-1 bg-[#1e503e]"></div>

                @csrf
                
                <div>
                    <label class="block text-sm font-bold text-[#1e503e] mb-1">Inisial Pasien:</label>
                    <input type="text" name="patient_code" required class="w-full bg-gray-50 border border-gray-300 p-3 rounded-lg outline-none focus:bg-white focus:border-[#1e503e] focus:ring-1 focus:ring-[#1e503e] uppercase text-gray-900 font-bold transition-colors" placeholder="Cth: AWP">
                </div>

                <div>
                    <label class="block text-sm font-bold text-[#1e503e] mb-1">Diagnosa Medis:</label>
                    <textarea name="medical_diagnosis" required rows="3" class="w-full bg-gray-50 border border-gray-300 p-3 rounded-lg outline-none focus:bg-white focus:border-[#1e503e] focus:ring-1 focus:ring-[#1e503e] text-gray-900 font-bold transition-colors" placeholder="Cth: Hipertensi Grade II..."></textarea>
                </div>

                <div class="pt-4">
                    <!-- Tombol Lanjut menggunakan warna Oranye Poster -->
                    <button type="submit" class="w-full bg-[#d96b1e] hover:bg-[#b85a18] text-white font-bold text-lg py-3.5 rounded-xl shadow-md transition-colors active:scale-95 flex justify-center items-center gap-2">
                        LANJUT
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
                    </button>
                </div>
            </form>
        </main>
        
        <!-- Hiasan Geometris Bawah (Warna Hijau Transparan) -->
        <svg class="absolute bottom-0 w-full opacity-10 pointer-events-none" viewBox="0 0 1440 320" fill="#1e503e"><path d="M0,256L120,229.3C240,203,480,149,720,154.7C960,160,1200,224,1320,256L1440,288L1440,320L1320,320C1200,320,960,320,720,320C480,320,240,320,120,320L0,320Z"></path></svg>
    </div>

</body>
</html>