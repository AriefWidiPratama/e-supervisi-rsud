<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Edukasi | E-Supervisi Klinik</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Roboto', sans-serif; background-color: #e2e8f0; }
        /* Tema Warna Baru */
        .header-green { background: #1e503e; }
        .bg-app { background-color: #f4f7f6; }
        ::-webkit-scrollbar { width: 0px; background: transparent; }
    </style>
</head>
<body class="flex justify-center min-h-screen">

    <div class="w-full max-w-md bg-app min-h-screen shadow-2xl flex flex-col relative overflow-hidden">
        
        <!-- Header -->
        <header class="header-green text-white px-5 py-4 flex items-center justify-between shadow-md relative z-20 rounded-b-xl">
            <div class="flex items-center gap-4">
                <a href="{{ route('perawat.dashboard') }}" class="hover:bg-white/20 p-2 rounded-full transition-colors active:scale-90">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" /></svg>
                </a>
                <h1 class="text-lg font-bold">Observasi Edukasi</h1>
            </div>
            <div class="bg-white/20 p-2 rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" /></svg>
            </div>
        </header>

        <form action="{{ route('perawat.education.store') }}" method="POST" class="flex-1 flex flex-col overflow-hidden">
            @csrf
            <input type="hidden" name="patient_id" value="{{ $patient->id }}">

            <main class="flex-1 overflow-y-auto p-4 pb-24 space-y-4">
                
                <!-- Info Pasien -->
                <div class="bg-white p-4 rounded-2xl shadow-sm border border-emerald-100 flex justify-between items-center relative overflow-hidden">
                    <div class="absolute left-0 top-0 bottom-0 w-1 bg-[#1e503e]"></div>
                    <div class="pl-2">
                        <p class="text-[10px] text-gray-500 font-bold uppercase tracking-wider mb-1">Inisial Pasien</p>
                        <p class="text-base font-black text-[#1e503e]">{{ strtoupper($patient->patient_code) }}</p>
                    </div>
                    <div class="text-right">
                        <p class="text-[10px] text-gray-500 font-bold uppercase tracking-wider mb-1">Tanggal</p>
                        <p class="text-sm font-bold text-gray-800">{{ date('d-m-Y') }}</p>
                    </div>
                </div>

                @php $details = isset($education) && is_array($education->detailed_checklists) ? $education->detailed_checklists : []; @endphp

                @php
                    $menus = [
                        ['icon' => '🥗', 'title' => 'Pola Makan Sehat', 'name' => 'topic_diet', 'items' => ['Kurangi garam', 'Batasi gorengan', 'Perbanyak sayur & buah']],
                        ['icon' => '🏃', 'title' => 'Aktivitas Fisik', 'name' => 'topic_activity', 'items' => ['Anjuran aktivitas', 'Batas aman aktivitas']],
                        ['icon' => '🚭', 'title' => 'Berhenti Merokok', 'name' => 'topic_smoking', 'items' => ['Edukasi berhenti merokok', 'Edukasi hindari asap rokok']],
                        ['icon' => '💊', 'title' => 'Kepatuhan Obat', 'name' => 'topic_medication', 'items' => ['Waktu minum obat', 'Kepatuhan obat']],
                        ['icon' => '😌', 'title' => 'Manajemen Stres', 'name' => 'topic_stress', 'items' => ['Istirahat cukup', 'Relaksasi/ibadah']],
                        ['icon' => '⚠️', 'title' => 'Tanda Bahaya', 'name' => 'topic_warning_signs', 'items' => ['Nyeri dada', 'Sesak napas', 'Pusing berat']]
                    ];
                @endphp

                <!-- Accordion Menu Edukasi -->
                @foreach($menus as $menu)
                <details class="bg-white rounded-2xl shadow-sm border border-emerald-100 overflow-hidden group">
                    <summary class="p-4 font-bold text-gray-800 flex items-center justify-between cursor-pointer list-none">
                        <div class="flex items-center gap-3">
                            <span class="text-xl">{{ $menu['icon'] }}</span>
                            {{ $menu['title'] }}
                        </div>
                        <span class="text-[#1e503e] group-open:rotate-180 transition-transform">▼</span>
                    </summary>
                    <div class="p-4 pt-0 border-t border-emerald-50 bg-gray-50/50">
                        <div class="space-y-3 mt-3 mb-4">
                            @foreach($menu['items'] as $item)
                            <label class="flex items-center bg-white p-3 rounded-xl border border-gray-200 active:bg-emerald-50 transition-colors cursor-pointer">
                                <input type="checkbox" name="details[]" value="{{ $item }}" class="w-5 h-5 text-[#1e503e] rounded focus:ring-[#1e503e]" {{ in_array($item, $details) ? 'checked' : '' }}>
                                <span class="ml-3 text-sm font-medium text-gray-700">{{ $item }}</span>
                            </label>
                            @endforeach
                        </div>
                        
                        <!-- Tombol Tandai Selesai -->
                        <label class="flex items-center justify-center w-full p-3 bg-emerald-50 text-emerald-800 rounded-xl font-bold text-sm cursor-pointer has-[:checked]:bg-[#1e503e] has-[:checked]:text-white transition-all shadow-sm border border-emerald-100 has-[:checked]:border-[#1e503e]">
                            <input type="checkbox" name="{{ $menu['name'] }}" class="hidden" {{ (isset($education) && $education->{$menu['name']}) ? 'checked' : '' }}>
                            ✓ TANDAI SELESAI
                        </label>
                    </div>
                </details>
                @endforeach

                <!-- Media Edukasi -->
                <div class="bg-white p-4 rounded-2xl shadow-sm border border-emerald-100 mt-4 relative overflow-hidden">
                    <div class="absolute left-0 top-0 bottom-0 w-1 bg-[#d96b1e]"></div>
                    <div class="pl-2">
                        <p class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-3">Media Edukasi</p>
                        <div class="flex flex-col gap-3">
                            <label class="flex items-center p-3 rounded-xl border border-gray-200 has-[:checked]:border-[#1e503e] has-[:checked]:bg-emerald-50 transition-colors cursor-pointer shadow-sm">
                                <input type="radio" name="used_media" value="Digital Card" class="w-5 h-5 text-[#1e503e] focus:ring-[#1e503e]" required {{ (isset($education) && $education->used_media == 'Digital Card') ? 'checked' : '' }}>
                                <span class="ml-3 text-sm font-bold text-gray-800">📱 Kartu Digital</span>
                            </label>
                            <label class="flex items-center p-3 rounded-xl border border-gray-200 has-[:checked]:border-[#1e503e] has-[:checked]:bg-emerald-50 transition-colors cursor-pointer shadow-sm">
                                <input type="radio" name="used_media" value="Printed Card" class="w-5 h-5 text-[#1e503e] focus:ring-[#1e503e]" {{ (isset($education) && $education->used_media == 'Printed Card') ? 'checked' : '' }}>
                                <span class="ml-3 text-sm font-bold text-gray-800">📄 Kartu Cetak Fisik</span>
                            </label>
                            <label class="flex items-center p-3 rounded-xl border border-gray-200 has-[:checked]:border-[#1e503e] has-[:checked]:bg-emerald-50 transition-colors cursor-pointer shadow-sm">
                                <input type="radio" name="used_media" value="Combination" class="w-5 h-5 text-[#1e503e] focus:ring-[#1e503e]" {{ (isset($education) && $education->used_media == 'Combination') ? 'checked' : '' }}>
                                <span class="ml-3 text-sm font-bold text-gray-800">🔄 Kombinasi Keduanya</span>
                            </label>
                        </div>
                    </div>
                </div>

            </main>

            <!-- Sticky Bottom Button (Warna Oranye) -->
            <div class="bg-white p-4 border-t border-gray-200 sticky bottom-0 z-30 shadow-[0_-4px_10px_rgba(0,0,0,0.05)]">
                <button type="submit" class="w-full bg-[#d96b1e] hover:bg-[#b85a18] text-white font-bold text-lg py-3.5 rounded-xl shadow-md transition-colors active:scale-95 flex justify-center items-center gap-2">
                    UPDATE DATA EDUKASI
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" /></svg>
                </button>
            </div>
        </form>
    </div>

</body>
</html>