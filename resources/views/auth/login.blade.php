<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | E-Supervisi RSUD Arifin Ahmad</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .bg-premium-white { 
            background-color: #ffffff;
            background-image: radial-gradient(#e0e7ff 1px, transparent 1px);
            background-size: 24px 24px;
        }
        .bg-accent-gradient {
            background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
        }
    </style>
</head>
<body class="bg-premium-white min-h-screen flex items-center justify-center p-6">

    <div class="bg-white rounded-[2.5rem] shadow-2xl shadow-blue-900/5 border border-slate-100 overflow-hidden max-w-5xl w-full flex flex-col md:flex-row">
        
        <div class="bg-accent-gradient p-10 md:p-16 md:w-5/12 flex flex-col justify-between relative overflow-hidden">
            <div class="absolute top-0 right-0 -mt-16 -mr-16 text-blue-600/5 animate-pulse">
                <svg width="300" height="300" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z"/></svg>
            </div>
            
            <div class="relative z-10 pt-4">
                <h1 class="text-3xl md:text-4xl font-extrabold text-blue-900 leading-tight tracking-tight mb-4">
                    Sistem <br>E-Supervisi <br><span class="text-blue-600">Perawat.</span>
                </h1>
                <p class="text-blue-800/80 text-sm font-medium leading-relaxed">
                    Platform pencatatan dan monitoring evaluasi edukasi pasien untuk pelayanan keperawatan di RSUD Arifin Ahmad.
                </p>
            </div>
            
            <div class="relative z-10 mt-12 flex items-center gap-3 text-xs font-bold text-blue-600/60 uppercase tracking-widest">
                <span>RSUD Arifin Ahmad</span>
                <span class="w-1 h-1 bg-blue-400 rounded-full"></span>
                <span>Pekanbaru</span>
            </div>
        </div>

        <div class="p-10 md:p-16 md:w-7/12 flex flex-col justify-center bg-white">
            <div class="mb-10">
                <h2 class="text-2xl font-extrabold text-slate-900">Selamat Datang</h2>
                <p class="text-slate-500 text-sm mt-2 font-medium">Silakan masuk menggunakan akun yang telah terdaftar.</p>
            </div>

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <div>
                    <label for="email" class="block text-xs font-black uppercase tracking-widest text-slate-500 mb-2">Email Address</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" /></svg>
                        </div>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" 
                            class="w-full pl-12 pr-4 py-4 bg-slate-50 border border-slate-200 rounded-xl outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all font-bold text-slate-800 text-sm placeholder:font-medium placeholder:text-slate-400" 
                            placeholder="nama@rsud.com">
                    </div>
                    @error('email')
                        <p class="text-red-500 text-xs mt-2 font-bold">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mt-4">
                    <label for="password" class="block text-xs font-black uppercase tracking-widest text-slate-500 mb-2">Password</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                        </div>
                        <input id="password" type="password" name="password" required autocomplete="current-password" 
                            class="w-full pl-12 pr-4 py-4 bg-slate-50 border border-slate-200 rounded-xl outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all font-bold text-slate-800 text-sm placeholder:font-medium placeholder:text-slate-400" 
                            placeholder="••••••••">
                    </div>
                    @error('password')
                        <p class="text-red-500 text-xs mt-2 font-bold">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center mt-4">
                    <label for="remember_me" class="inline-flex items-center cursor-pointer">
                        <input id="remember_me" type="checkbox" class="rounded border-slate-300 text-blue-600 shadow-sm focus:ring-blue-500" name="remember">
                        <span class="ml-2 text-sm font-bold text-slate-500">Ingat Saya</span>
                    </label>
                </div>

                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-black py-4 rounded-xl shadow-lg shadow-blue-600/20 transition-all duration-300 text-sm uppercase tracking-[0.2em] hover:-translate-y-0.5 mt-2">
                    LOGIN SISTEM
                </button>
            </form>
        </div>
    </div>

</body>
</html>