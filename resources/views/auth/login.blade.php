<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Secure Portal | E-Supervisi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .bg-premium {
            background: linear-gradient(135deg, #0f172a 0%, #1e3a8a 100%);
        }
        .glass-panel {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(24px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        .input-glass {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: white;
        }
        .input-glass::placeholder { color: rgba(255, 255, 255, 0.3); }
        .input-glass:focus {
            background: rgba(255, 255, 255, 0.1);
            border-color: #60a5fa;
            outline: none;
            box-shadow: 0 0 0 4px rgba(96, 165, 250, 0.15);
        }
    </style>
</head>
<body class="bg-premium min-h-screen flex items-center justify-center p-6 relative overflow-hidden">
    
    <div class="absolute top-0 left-0 w-full h-full overflow-hidden z-0 pointer-events-none">
        <div class="absolute -top-[20%] -right-[10%] w-[50%] h-[50%] rounded-full bg-blue-500/20 blur-[120px]"></div>
        <div class="absolute bottom-[10%] -left-[10%] w-[40%] h-[40%] rounded-full bg-indigo-500/20 blur-[100px]"></div>
    </div>

    <div class="relative z-10 w-full max-w-5xl grid md:grid-cols-2 gap-0 overflow-hidden rounded-[3rem] shadow-[0_0_50px_rgba(0,0,0,0.5)] border border-white/10 glass-panel">
        
        <div class="hidden md:flex flex-col justify-between p-16 bg-gradient-to-br from-blue-600/10 to-indigo-900/30 border-r border-white/5 relative">
            <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-blue-400 to-indigo-500"></div>
            <div>
                <div class="inline-block px-4 py-1.5 rounded-full border border-blue-400/30 bg-blue-400/10 text-[10px] font-black uppercase tracking-[0.3em] text-blue-300 mb-6">
                    System v2.0
                </div>
                <h1 class="text-5xl font-black text-white leading-tight tracking-tight mb-4">
                    Clinical <br>
                    Supervision <br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-indigo-300">Platform.</span>
                </h1>
                <p class="text-slate-400 text-sm font-medium leading-relaxed max-w-xs mt-6">
                    Gerbang otentikasi aman untuk Terminal Perawat dan Panel Eksekutif Supervisor.
                </p>
            </div>
            
            <div class="flex items-center gap-4 text-xs text-slate-500 font-bold uppercase tracking-widest">
                <span>Poltekkes Riau</span>
                <div class="w-1.5 h-1.5 rounded-full bg-slate-600"></div>
                <span>Research Data</span>
            </div>
        </div>

        <div class="p-10 md:p-16 flex flex-col justify-center bg-white/5">
            <div class="mb-10 md:hidden">
                <h1 class="text-3xl font-black text-white tracking-tight">E-Supervisi</h1>
                <p class="text-blue-300 text-xs font-bold uppercase tracking-widest mt-1">Poltekkes Riau</p>
            </div>

            <div class="mb-10">
                <h2 class="text-2xl font-black text-white mb-2">Welcome Back</h2>
                <p class="text-slate-400 text-sm font-medium">Please enter your credentials to access the system.</p>
            </div>

            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <div>
                    <label for="email" class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2 ml-1">Email Address</label>
                    <input id="email" class="block w-full input-glass p-4 rounded-2xl font-bold transition-all" 
                           type="email" name="email" :value="old('email')" required autofocus autocomplete="username" 
                           placeholder="e.g. perawat@rsud.com">
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-400 text-[10px] font-bold uppercase ml-1" />
                </div>

                <div>
                    <label for="password" class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2 ml-1">Password</label>
                    <input id="password" class="block w-full input-glass p-4 rounded-2xl font-bold transition-all"
                           type="password" name="password" required autocomplete="current-password"
                           placeholder="••••••••">
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-400 text-[10px] font-bold uppercase ml-1" />
                </div>

                <div class="flex items-center justify-between mt-4">
                    <label for="remember_me" class="inline-flex items-center group cursor-pointer">
                        <input id="remember_me" type="checkbox" class="rounded bg-white/10 border-white/20 text-blue-500 focus:ring-blue-500/50" name="remember">
                        <span class="ms-2 text-xs font-bold text-slate-400 group-hover:text-slate-200 transition-colors uppercase tracking-wider">Remember me</span>
                    </label>
                </div>

                <div class="pt-4">
                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-500 text-white font-black py-5 rounded-2xl shadow-[0_0_30px_rgba(37,99,235,0.2)] hover:shadow-[0_0_40px_rgba(37,99,235,0.4)] hover:-translate-y-1 transition-all duration-300 text-sm uppercase tracking-[0.2em]">
                        Authenticate
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>