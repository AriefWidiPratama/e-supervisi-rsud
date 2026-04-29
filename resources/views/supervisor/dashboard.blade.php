<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Menu | E-Supervisi Klinik</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Roboto', sans-serif; background-color: #e2e8f0; }
        .header-blue { background-color: #0056b3; }
        .bg-wave-bottom { background: linear-gradient(180deg, #f4f7fb 0%, #dbeafe 100%); }
        .menu-card { box-shadow: 0 4px 15px rgba(0,0,0,0.08); }
        ::-webkit-scrollbar { width: 0px; background: transparent; }
    </style>
</head>
<body class="flex justify-center min-h-screen">

    <div class="w-full max-w-md bg-wave-bottom min-h-screen shadow-2xl flex flex-col relative overflow-hidden">
        
        <header class="header-blue text-white px-4 py-4 flex justify-between items-center shadow-md relative z-20">
            <div class="flex items-center gap-2 font-bold text-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" /></svg>
                Menu Supervisor
            </div>
            
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="hover:text-gray-300 active:scale-90 transition-transform">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" /></svg>
                </button>
            </form>
        </header>

        <svg class="absolute bottom-16 w-full opacity-40 z-0 text-blue-200" viewBox="0 0 1440 320" fill="currentColor">
            <path d="M0,160L80,170.7C160,181,320,203,480,192C640,181,800,139,960,133.3C1120,128,1280,160,1360,176L1440,192L1440,320L1360,320C1280,320,1120,320,960,320C800,320,640,320,480,320C320,320,160,320,80,320L0,320Z"></path>
        </svg>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        @if(session('success'))
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'success', title: 'Berhasil!', text: "{{ session('success') }}",
                        showConfirmButton: false, timer: 2000
                    });
                });
            </script>
        @endif

        <main class="flex-1 p-6 relative z-10 pb-24">
            
            <div class="mb-6 text-center">
                <p class="text-sm font-bold text-gray-500">Selamat Datang,</p>
                <h2 class="text-xl font-black text-blue-900">{{ Auth::user()->name }}</h2>
            </div>

            <div class="grid grid-cols-2 gap-5">
                <a href="{{ route('supervisor.nurses') }}" class="menu-card bg-white rounded-2xl p-4 flex flex-col items-center justify-center gap-3 active:scale-95 transition-transform">
                    <div class="w-16 h-16 bg-blue-50 border border-blue-100 rounded-2xl flex items-center justify-center text-4xl shadow-inner">👨‍⚕️</div>
                    <span class="text-sm font-bold text-gray-700 text-center">Data Perawat</span>
                </a>

                <a href="{{ route('supervisor.pending') }}" class="menu-card bg-white rounded-2xl p-4 flex flex-col items-center justify-center gap-3 active:scale-95 transition-transform relative">
                    @if(count($pendingEducations ?? []) > 0)
                        <div class="absolute -top-2 -right-2 bg-red-500 text-white w-6 h-6 rounded-full flex items-center justify-center font-bold text-xs shadow-md">
                            {{ count($pendingEducations ?? []) }}
                        </div>
                    @endif
                    <div class="w-16 h-16 bg-blue-50 border border-blue-100 rounded-2xl flex items-center justify-center text-4xl shadow-inner">📋</div>
                    <span class="text-sm font-bold text-gray-700 text-center">Form Supervisi</span>
                </a>

                <a href="{{ route('supervisor.history') }}" class="menu-card bg-white rounded-2xl p-4 flex flex-col items-center justify-center gap-3 active:scale-95 transition-transform">
                    <div class="w-16 h-16 bg-blue-50 border border-blue-100 rounded-2xl flex items-center justify-center text-4xl shadow-inner">📊</div>
                    <span class="text-sm font-bold text-gray-700 text-center">Rekap Hasil</span>
                </a>

                <a href="{{ route('supervisor.export') }}" class="menu-card bg-white rounded-2xl p-4 flex flex-col items-center justify-center gap-3 active:scale-95 transition-transform">
                    <div class="w-16 h-16 bg-blue-50 border border-blue-100 rounded-2xl flex items-center justify-center text-4xl shadow-inner">💾</div>
                    <span class="text-sm font-bold text-gray-700 text-center">Export Data</span>
                </a>
            </div>

        </main>

        <nav class="header-blue text-white flex justify-around items-center px-2 py-3 absolute bottom-0 w-full z-20 shadow-[0_-4px_10px_rgba(0,0,0,0.1)]">
            <a href="#" class="flex flex-col items-center gap-1 opacity-50"><svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" /></svg></a>
            <a href="#" class="flex flex-col items-center gap-1"><svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" /></svg></a>
            <a href="#" class="flex flex-col items-center gap-1 opacity-50"><svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" /></svg></a>
        </nav>

    </div>
</body>
</html>