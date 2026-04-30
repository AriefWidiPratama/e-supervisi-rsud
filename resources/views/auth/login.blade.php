<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Login | E-Supervisi Klinik</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Roboto', sans-serif; background-color: #f4f7f6; } /* Latar seragam dengan aplikasi */
        
        /* Gradasi Hijau Medis */
        .bg-wave {
            background: linear-gradient(180deg, #2a6b54 0%, #1e503e 100%);
        }
        
        /* Gradasi Tombol Oranye */
        .btn-gradient {
            background: linear-gradient(180deg, #d96b1e 0%, #b85a18 100%);
        }
        
        /* Hilangkan scrollbar */
        ::-webkit-scrollbar { width: 0px; background: transparent; }
    </style>
</head>
<body class="flex justify-center min-h-screen">

    <div class="w-full max-w-md bg-white min-h-screen shadow-2xl flex flex-col relative overflow-hidden">
        
        <div class="bg-wave pt-20 pb-16 relative">
            <!-- Ikon Plus Medis sebagai Logo Aplikasi -->
            <div class="flex justify-center mb-6 relative z-10">
                <div class="w-16 h-16 bg-white rounded-2xl flex items-center justify-center shadow-lg transform rotate-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-[#1e503e]" fill="currentColor" viewBox="0 0 24 24"><path d="M19 10.5h-5.5V5h-3v5.5H5v3h5.5V19h3v-5.5H19v-3z"/></svg>
                </div>
            </div>

            <h1 class="text-3xl font-black text-white text-center leading-snug tracking-wide relative z-10 px-6 drop-shadow-md">
                APLIKASI<br>SUPERVISI KLINIK<br>PERAWAT
            </h1>
            
            <!-- Ombak bawah warna putih -->
            <svg class="absolute bottom-0 w-full text-white" viewBox="0 0 1440 320" fill="currentColor" preserveAspectRatio="none" style="height: 60px;">
                <path d="M0,160L80,170.7C160,181,320,203,480,192C640,181,800,139,960,133.3C1120,128,1280,160,1360,176L1440,192L1440,320L1360,320C1280,320,1120,320,960,320C800,320,640,320,480,320C320,320,160,320,80,320L0,320Z"></path>
            </svg>
        </div>

        <div class="px-8 pt-4 flex-1 bg-white relative z-10">
            <div class="text-center mb-6">
                <p class="text-xs font-bold text-gray-400 uppercase tracking-widest">Silakan Masuk</p>
            </div>

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <div>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                        class="w-full bg-gray-50 border border-gray-200 p-4 rounded-xl outline-none focus:bg-white focus:border-[#1e503e] focus:ring-1 focus:ring-[#1e503e] transition-colors text-gray-900 font-bold" 
                        placeholder="Username / Email">
                    @error('email')
                        <p class="text-red-500 text-xs mt-1 font-bold">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <input id="password" type="password" name="password" required 
                        class="w-full bg-gray-50 border border-gray-200 p-4 rounded-xl outline-none focus:bg-white focus:border-[#1e503e] focus:ring-1 focus:ring-[#1e503e] transition-colors text-gray-900 font-bold" 
                        placeholder="Password">
                    @error('password')
                        <p class="text-red-500 text-xs mt-1 font-bold">{{ $message }}</p>
                    @enderror
                </div>

                <div class="pt-6">
                    <button type="submit" class="w-full btn-gradient text-white font-bold text-lg py-4 rounded-xl shadow-[0_8px_20px_rgba(217,107,30,0.3)] hover:scale-[0.98] active:scale-95 transition-transform flex justify-center items-center gap-2">
                        LOGIN
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M3 3a1 1 0 011 1v12a1 1 0 11-2 0V4a1 1 0 011-1zm7.707 3.293a1 1 0 010 1.414L6.414 9H17a1 1 0 110 2H6.414l4.293 4.293a1 1 0 01-1.414 1.414l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 0z" clip-rule="evenodd" transform="rotate(180 10 10)"/></svg>
                    </button>
                </div>
            </form>
        </div>
        
        <!-- Hiasan ombak tipis di bawah dengan warna hijau medis -->
        <div class="absolute bottom-0 w-full opacity-10 pointer-events-none">
             <svg viewBox="0 0 1440 320" fill="#1e503e"><path d="M0,256L120,229.3C240,203,480,149,720,154.7C960,160,1200,224,1320,256L1440,288L1440,320L1320,320C1200,320,960,320,720,320C480,320,240,320,120,320L0,320Z"></path></svg>
        </div>

    </div>

</body>
</html>