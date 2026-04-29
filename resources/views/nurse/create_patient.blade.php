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
        .header-blue { background: linear-gradient(90deg, #0056b3 0%, #0072ff 100%); }
        .bg-wave-bottom { background: linear-gradient(180deg, #ffffff 0%, #e6f0fa 100%); }
    </style>
</head>
<body class="flex justify-center min-h-screen">

    <div class="w-full max-w-md bg-wave-bottom min-h-screen shadow-2xl flex flex-col relative overflow-hidden">
        
        <header class="header-blue text-white px-4 py-4 flex items-center gap-4 shadow-md relative z-20">
            <a href="{{ route('perawat.dashboard') }}" class="hover:bg-white/20 p-1 rounded-full transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" /></svg>
            </a>
            <h1 class="text-lg font-bold">Data Pasien Baru</h1>
        </header>

        <main class="flex-1 p-6 relative z-10">
            <form action="{{ route('perawat.patient.store') }}" method="POST" class="space-y-5">
                @csrf
                
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1">Inisial Pasien:</label>
                    <input type="text" name="patient_code" required class="w-full border border-gray-300 p-3 rounded shadow-sm outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 uppercase text-gray-800 font-medium" placeholder="Cth: AWP">
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1">Diagnosa Medis:</label>
                    <textarea name="medical_diagnosis" required rows="3" class="w-full border border-gray-300 p-3 rounded shadow-sm outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 text-gray-800 font-medium" placeholder="Cth: Hipertensi Grade II..."></textarea>
                </div>

                <div class="pt-6">
                    <button type="submit" class="w-full bg-[#0056b3] hover:bg-blue-800 text-white font-bold text-lg py-3.5 rounded shadow-lg transition-colors active:scale-95">
                        LANJUT
                    </button>
                </div>
            </form>
        </main>
        
        <svg class="absolute bottom-0 w-full opacity-20 pointer-events-none" viewBox="0 0 1440 320" fill="#0056b3"><path d="M0,256L120,229.3C240,203,480,149,720,154.7C960,160,1200,224,1320,256L1440,288L1440,320L1320,320C1200,320,960,320,720,320C480,320,240,320,120,320L0,320Z"></path></svg>
    </div>

</body>
</html>