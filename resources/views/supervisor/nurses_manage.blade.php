<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Data Perawat | E-Supervisi Klinik</title>
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
            <a href="{{ route('supervisor.dashboard') }}" class="hover:bg-white/20 p-1 rounded-full transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" /></svg>
            </a>
            <h1 class="text-lg font-bold">Data Perawat</h1>
        </header>

        <main class="flex-1 overflow-y-auto p-4 space-y-6 pb-10">

            @if(session('success'))
                <div class="bg-green-50 border border-green-200 text-green-700 text-sm font-bold p-3 rounded shadow-sm">
                    ✓ {{ session('success') }}
                </div>
            @endif

            <div class="bg-white rounded border border-gray-200 p-4 shadow-sm">
                <h2 class="text-sm font-bold text-blue-900 mb-4 flex items-center gap-2 border-b border-gray-100 pb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" /></svg>
                    Tambah Akun Perawat
                </h2>
                
                <form action="{{ route('supervisor.nurses.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <input type="text" name="name" required class="w-full bg-gray-50 border border-gray-300 p-3 rounded outline-none focus:border-blue-500 text-sm font-medium text-gray-800" placeholder="Nama Lengkap & Gelar">
                    </div>
                    <div>
                        <input type="email" name="email" required class="w-full bg-gray-50 border border-gray-300 p-3 rounded outline-none focus:border-blue-500 text-sm font-medium text-gray-800" placeholder="Email Login (Cth: siti@rsud.com)">
                    </div>
                    <div>
                        <input type="password" name="password" required class="w-full bg-gray-50 border border-gray-300 p-3 rounded outline-none focus:border-blue-500 text-sm font-medium text-gray-800" placeholder="Password (Min. 8 karakter)">
                    </div>
                    <button type="submit" class="w-full bg-[#0056b3] hover:bg-blue-800 text-white font-bold text-sm py-3 rounded shadow transition-colors active:scale-95">
                        SIMPAN PERAWAT
                    </button>
                </form>
            </div>

            <div>
                <h2 class="text-sm font-bold text-gray-500 uppercase tracking-widest mb-3 ml-1">Daftar Terdaftar</h2>
                <div class="space-y-3">
                    @forelse($nurses as $nurse)
                        <div class="flex items-center justify-between p-3 bg-white border border-gray-200 rounded shadow-sm">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-blue-50 text-blue-600 border border-blue-100 rounded-full flex items-center justify-center font-black text-lg">
                                    {{ substr($nurse->name, 0, 1) }}
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-800 text-sm">{{ $nurse->name }}</h4>
                                    <p class="text-xs font-medium text-gray-500">{{ $nurse->email }}</p>
                                </div>
                            </div>
                            <span class="text-[10px] font-bold bg-green-100 text-green-700 px-2 py-1 rounded">Aktif</span>
                        </div>
                    @empty
                        <div class="text-center py-8 bg-white rounded border border-gray-200">
                            <p class="text-gray-400 font-bold text-sm">Belum ada perawat.</p>
                        </div>
                    @endforelse
                </div>
            </div>

        </main>
    </div>
</body>
</html>