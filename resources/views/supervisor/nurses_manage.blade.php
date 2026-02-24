<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Perawat | E-Supervisi Kardiologi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f8fafc; }
        .glass-card { background: #ffffff; border: 1px solid #e2e8f0; }
    </style>
</head>
<body class="min-h-screen p-6">
    <main class="max-w-6xl mx-auto">
        <div class="flex justify-between items-center mb-8">
            <div>
                <a href="{{ route('supervisor.dashboard') }}" class="flex items-center gap-2 text-slate-400 hover:text-rose-600 transition-colors mb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
                    <span class="text-xs font-bold uppercase tracking-widest">Kembali ke Panel</span>
                </a>
                <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Manajemen Akses Perawat</h1>
                <p class="text-sm text-slate-500 font-medium mt-1">Buat dan kelola akun perawat pelaksana (Tim Riset)</p>
            </div>
        </div>

        @if(session('success'))
            <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 text-sm font-bold rounded-2xl flex items-center gap-3">
                <div class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse"></div>
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="glass-card p-8 rounded-[2rem] shadow-sm border-t-4 border-t-rose-500 h-fit">
                <h2 class="text-lg font-black text-slate-900 mb-6 tracking-tight">Buat Akun Baru</h2>
                <form action="{{ route('supervisor.nurses.store') }}" method="POST" class="space-y-5">
                    @csrf
                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-widest text-slate-500 mb-2">Nama Lengkap & Gelar</label>
                        <input type="text" name="name" required class="w-full bg-slate-50 border border-slate-200 p-4 rounded-xl outline-none focus:ring-2 focus:ring-rose-500 text-sm font-bold text-slate-800" placeholder="Ns. Budi Santoso, S.Kep">
                    </div>
                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-widest text-slate-500 mb-2">Email Login</label>
                        <input type="email" name="email" required class="w-full bg-slate-50 border border-slate-200 p-4 rounded-xl outline-none focus:ring-2 focus:ring-rose-500 text-sm font-bold text-slate-800" placeholder="budi@rsud.com">
                    </div>
                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-widest text-slate-500 mb-2">Password</label>
                        <input type="password" name="password" required class="w-full bg-slate-50 border border-slate-200 p-4 rounded-xl outline-none focus:ring-2 focus:ring-rose-500 text-sm font-bold text-slate-800" placeholder="Minimal 8 karakter">
                    </div>
                    <button type="submit" class="w-full bg-slate-900 hover:bg-rose-600 text-white font-black py-4 rounded-xl shadow-md transition-all text-xs uppercase tracking-widest mt-2 flex justify-center items-center gap-2">
                        Daftarkan Perawat
                    </button>
                </form>
            </div>

            <div class="md:col-span-2 glass-card p-8 rounded-[2rem] shadow-sm">
                <h2 class="text-lg font-black text-slate-900 mb-6 tracking-tight">Daftar Perawat Terdaftar</h2>
                <div class="space-y-4">
                    @forelse($nurses as $nurse)
                        <div class="flex items-center justify-between p-4 bg-slate-50 border border-slate-100 rounded-2xl shadow-sm">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 bg-white text-rose-600 border border-rose-100 rounded-full flex items-center justify-center font-black text-lg">
                                    {{ substr($nurse->name, 0, 1) }}
                                </div>
                                <div>
                                    <h4 class="font-extrabold text-slate-800 text-sm">{{ $nurse->name }}</h4>
                                    <p class="text-xs font-bold text-slate-400">{{ $nurse->email }}</p>
                                </div>
                            </div>
                            <span class="text-[9px] font-black bg-emerald-100 text-emerald-700 px-3 py-1 rounded-full uppercase tracking-widest">Active</span>
                        </div>
                    @empty
                        <div class="text-center py-10 bg-slate-50 rounded-2xl border border-dashed border-slate-200">
                            <p class="text-slate-400 font-bold text-sm">Belum ada akun perawat yang dibuat.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </main>
</body>
</html>