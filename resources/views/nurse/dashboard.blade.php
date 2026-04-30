<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Terminal Perawat | E-Supervisi Klinik</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Roboto', sans-serif; background-color: #e2e8f0; }
        /* Warna Hijau khas Poster RSUD */
        .header-green { background: #1e503e; }
        /* Latar belakang abu-abu sangat muda agar kartu putih menonjol */
        .bg-app { background-color: #f4f7f6; }
        ::-webkit-scrollbar { width: 0px; background: transparent; }
    </style>
</head>
<body class="flex justify-center min-h-screen">

    <!-- Pembungkus Layar Smartphone -->
    <div class="w-full max-w-md bg-app min-h-screen shadow-2xl flex flex-col relative overflow-hidden">
        
        <!-- App Header -->
        <header class="header-green text-white px-5 py-4 flex justify-between items-center shadow-md relative z-20 rounded-b-xl">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-white text-[#1e503e] flex items-center justify-center font-black text-lg shadow-inner">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
                <div>
                    <h1 class="text-sm font-bold leading-tight">{{ Auth::user()->name }}</h1>
                    <p class="text-[10px] text-emerald-100 uppercase tracking-widest font-bold">Terminal Perawat</p>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="hover:text-emerald-200 active:scale-90 transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" /></svg>
                </button>
            </form>
        </header>

        <!-- Main Content -->
        <!-- pb-6 digunakan karena navigasi bawah sudah dihapus -->
        <main class="flex-1 overflow-y-auto p-4 pb-6 relative z-10 space-y-4">
            
            <div class="flex justify-between items-end mb-3 mt-2">
                <h3 class="text-sm font-bold text-[#1e503e] uppercase tracking-widest">Pasien Aktif</h3>
                <a href="{{ route('perawat.printBlank') }}" target="_blank" class="bg-white text-[#1e503e] border-2 border-[#1e503e] hover:bg-emerald-50 px-3 py-1.5 rounded-lg flex items-center gap-1 shadow-sm text-xs font-bold transition-colors active:scale-95">
                    🖨️ Kartu Digital
                </a>
            </div>

            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            @if(session('success'))
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        Swal.fire({
                            icon: 'success', title: 'Berhasil!', text: "{{ session('success') }}",
                            showConfirmButton: false, timer: 2000, customClass: { popup: 'rounded-2xl shadow-xl', title: 'font-bold text-xl text-[#1e503e]' }
                        });
                    });
                </script>
            @endif

            @forelse($patients ?? [] as $patient)
                @php
                    $latestEdu = $patient->educations->sortByDesc('created_at')->first();
                    $displayInitial = strtoupper($patient->patient_code);
                @endphp
                <div class="bg-white rounded-2xl p-4 shadow-sm border border-emerald-100 relative overflow-hidden">
                    <!-- Aksen Hijau di pinggir kartu -->
                    <div class="absolute left-0 top-0 bottom-0 w-1 bg-[#1e503e]"></div>

                    <div class="flex justify-between items-start mb-3 pl-2">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-emerald-50 text-[#1e503e] border border-emerald-100 flex items-center justify-center font-black">
                                {{ substr($displayInitial, 0, 1) }}
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-900">{{ $displayInitial }}</h4>
                                <p class="text-[10px] font-bold text-gray-500 uppercase truncate w-32">{{ $patient->medical_diagnosis }}</p>
                            </div>
                        </div>
                        <div>
                            @if(!$latestEdu)
                                <span class="text-[9px] font-bold text-red-600 bg-red-50 px-2 py-1 rounded border border-red-100">BELUM</span>
                            @elseif(!$latestEdu->supervision)
                                <span class="text-[9px] font-bold text-yellow-600 bg-yellow-50 px-2 py-1 rounded border border-yellow-100">REVIEW</span>
                            @else
                                <span class="text-[9px] font-bold text-emerald-700 bg-emerald-50 px-2 py-1 rounded border border-emerald-200">SELESAI</span>
                            @endif
                        </div>
                    </div>

                    <div class="flex gap-2 mt-4 pt-3 border-t border-gray-100 pl-2">
                        @if(!$latestEdu || !$latestEdu->supervision)
                            <!-- Tombol Action menggunakan warna Oranye dari Poster -->
                            <a href="{{ route('perawat.education.create', $patient->id) }}" class="flex-1 bg-[#d96b1e] text-white font-bold py-2 rounded-lg text-xs text-center shadow-md active:scale-95 transition-transform">
                                ✍️ {{ $latestEdu ? 'Edit Form' : 'Isi Edukasi' }}
                            </a>
                        @else
                            <button disabled class="flex-1 bg-gray-100 text-gray-400 font-bold py-2 rounded-lg text-xs text-center border border-gray-200">
                                🔒 Terkunci
                            </button>
                        @endif

                        @if($latestEdu)
                            <a href="{{ route('perawat.education.print', $latestEdu->id) }}" target="_blank" class="w-10 h-10 bg-emerald-50 text-[#1e503e] hover:bg-[#1e503e] hover:text-white rounded-lg border border-[#1e503e] flex items-center justify-center active:scale-95 transition-colors">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" /></svg>
                            </a>
                        @endif

                        @if(!$latestEdu || !$latestEdu->supervision)
                            <form action="{{ route('perawat.patient.destroy', $patient->id) }}" method="POST" onsubmit="return confirm('Hapus pasien?');" class="inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="w-10 h-10 bg-white text-gray-400 hover:text-red-500 rounded-lg border border-gray-200 flex items-center justify-center active:scale-95 transition-colors shadow-sm">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            @empty
                <div class="text-center py-20 bg-white border border-emerald-100 rounded-2xl shadow-sm">
                    <div class="text-4xl mb-3 opacity-50">📋</div>
                    <p class="text-[#1e503e] font-bold text-sm">Data pasien kosong.</p>
                </div>
            @endforelse
        </main>

        <!-- Floating Action Button (FAB) Khas Android - Posisi disesuaikan ke bawah karena nav hilang -->
        <a href="{{ route('perawat.patient.add') }}" class="absolute bottom-6 right-5 w-14 h-14 bg-[#1e503e] text-white rounded-full flex items-center justify-center shadow-lg shadow-emerald-900/30 active:scale-90 transition-transform z-50">
            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" /></svg>
        </a>

        <!-- Catatan: Menu Navigasi Bawah (Bottom Nav) Telah Dihapus Sesuai Permintaan -->

    </div>
</body>
</html>