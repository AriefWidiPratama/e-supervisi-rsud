<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Poster Lifestyle Pasien | E-Supervisi</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;800;900&display=swap');
        
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            background-color: #f1f5f9; 
            display: flex; flex-direction: column; align-items: center; padding: 20px; 
        }
        
        /* Tombol Cetak */
        .print-btn { 
            background-color: #e11d48; color: white; border: none; 
            padding: 15px 30px; font-weight: 800; font-size: 14px; border-radius: 50px; 
            cursor: pointer; margin-bottom: 20px; box-shadow: 0 4px 15px rgba(225, 29, 72, 0.4); 
            transition: all 0.3s; display: flex; align-items: center; gap: 10px;
        }
        .print-btn:hover { background-color: #be123c; transform: translateY(-3px); }

        /* Kertas A4 & Canvas Poster */
        .a4-paper { 
            background-color: #ffffff; width: 210mm; min-height: 297mm; 
            margin: 0 auto; overflow: hidden; position: relative;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            /* Latar belakang pattern halus untuk kesan premium */
            background-image: radial-gradient(#f1f5f9 1px, transparent 1px);
            background-size: 20px 20px;
        }

        /* Banner Atas */
        .poster-header {
            background: linear-gradient(135deg, #e11d48 0%, #be123c 100%);
            color: white; padding: 40px 30px; text-align: center;
            border-bottom-left-radius: 40px; border-bottom-right-radius: 40px;
            box-shadow: 0 10px 20px rgba(225, 29, 72, 0.15);
        }
        .poster-header h1 { font-size: 32px; font-weight: 900; letter-spacing: 1px; margin-bottom: 10px; line-height: 1.2; text-transform: uppercase;}
        .poster-header p { font-size: 14px; font-weight: 600; opacity: 0.9; letter-spacing: 2px; text-transform: uppercase; }

        /* Kartu Sapaan Pasien */
        .greeting-card {
            background: white; border-radius: 20px; padding: 20px 30px;
            margin: -30px 40px 30px 40px; position: relative; z-index: 10;
            box-shadow: 0 10px 25px rgba(0,0,0,0.05);
            display: flex; justify-content: space-between; align-items: center;
            border: 2px solid #fff1f2;
        }
        .greeting-text h2 { font-size: 20px; color: #1e293b; font-weight: 800; }
        .greeting-text p { font-size: 12px; color: #64748b; font-weight: 600; margin-top: 4px; }
        .hospital-badge { background: #fff1f2; color: #e11d48; padding: 8px 16px; border-radius: 50px; font-size: 10px; font-weight: 900; letter-spacing: 1px; }

        /* Grid Infografis */
        .infographic-grid {
            display: grid; grid-template-columns: 1fr 1fr; gap: 25px; padding: 10px 40px 40px 40px;
        }

        /* Desain Blok Kategori (Warna Warni Menarik) */
        .info-block {
            border-radius: 24px; padding: 25px; position: relative; overflow: hidden;
            box-shadow: 0 4px 15px rgba(0,0,0,0.03); border: 2px solid transparent;
        }
        
        /* Variasi Warna Blok */
        .block-diet { background-color: #f0fdf4; border-color: #dcfce7; }
        .block-activity { background-color: #eff6ff; border-color: #dbeafe; }
        .block-smoke { background-color: #fff7ed; border-color: #ffedd5; }
        .block-meds { background-color: #faf5ff; border-color: #f3e8ff; }
        .block-stress { background-color: #f0fdfa; border-color: #ccfbf1; }
        .block-danger { background-color: #fff1f2; border-color: #ffe4e6; }

        .block-icon {
            font-size: 35px; margin-bottom: 15px; display: inline-block;
            background: white; width: 60px; height: 60px; line-height: 60px; text-align: center;
            border-radius: 16px; box-shadow: 0 4px 10px rgba(0,0,0,0.05);
        }

        .block-title { font-size: 16px; font-weight: 800; color: #0f172a; margin-bottom: 15px; }

        /* List Gaya Baru (Poin Lucu, bukan Checkbox) */
        .advice-list { list-style: none; }
        .advice-list li {
            position: relative; padding-left: 28px; margin-bottom: 12px;
            font-size: 13px; font-weight: 600; color: #334155; line-height: 1.5;
        }
        .advice-list li::before {
            content: '✨'; position: absolute; left: 0; top: -2px; font-size: 14px;
        }
        
        /* Khusus list bahaya pakai icon alert */
        .block-danger .advice-list li::before { content: '🚨'; }
        .block-danger .block-title { color: #e11d48; }

        /* Footer Poster */
        .poster-footer {
            text-align: center; padding: 30px; margin-top: auto;
            background-color: #f8fafc; border-top: 2px dashed #cbd5e1;
        }
        .poster-footer h3 { font-size: 18px; color: #e11d48; font-weight: 900; margin-bottom: 5px;}
        .poster-footer p { font-size: 12px; color: #64748b; font-weight: 600;}

        @page { size: A4; margin: 0; }
        @media print { 
            body { background-color: white; padding: 0; } 
            .a4-paper { box-shadow: none; margin: 0; width: 100%; min-height: 297mm; } 
            .print-btn { display: none; } 
            * { -webkit-print-color-adjust: exact !important; color-adjust: exact !important; } 
        }
    </style>
</head>
<body>
    <button class="print-btn" onclick="window.print()">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" /></svg>
        CETAK POSTER PASIEN
    </button>

    <div class="a4-paper">
        
        <div class="poster-header">
            <h1>Panduan Hidup Sehat</h1>
            <p>Perawatan Hipertensi & Jantung Koroner</p>
        </div>

        <div class="greeting-card">
            <div class="greeting-text">
                <h2>Halo, {{ strtoupper($education->patient->patient_code) }} 👋</h2>
                <p>Mari jaga kesehatan jantung Anda dengan panduan ini.</p>
            </div>
            <div class="hospital-badge">
                🏥 RSUD ARIFIN ACHMAD
            </div>
        </div>

        @php
            // Mengambil rincian edukasi yang disampaikan
            $details = is_array($education->detailed_checklists) ? $education->detailed_checklists : [];
            
            // Fungsi untuk menampilkan poin hanya jika diedukasi (membantu poster tetap relevan)
            // Jika ingin mencetak SEMUA poin sebagai pengingat umum, hapus pengecekan in_array.
            // Di sini kita tampilkan semua poin edukasi standar sebagai poster pengingat lengkap.
        @endphp

        <div class="infographic-grid">
            
            <div class="info-block block-diet">
                <div class="block-icon">🥗</div>
                <h3 class="block-title">Pola Makan Sehat</h3>
                <ul class="advice-list">
                    <li>Kendalikan tensi dengan <strong>mengurangi konsumsi garam</strong> harian.</li>
                    <li><strong>Batasi makanan berlemak</strong> atau gorengan agar kolesterol terjaga.</li>
                    <li>Perbanyak porsi <strong>sayur dan buah segar</strong> setiap kali makan.</li>
                </ul>
            </div>

            <div class="info-block block-activity">
                <div class="block-icon">🏃</div>
                <h3 class="block-title">Aktivitas Fisik</h3>
                <ul class="advice-list">
                    <li>Rutin lakukan <strong>olahraga ringan</strong> (misal: jalan kaki pagi 30 menit).</li>
                    <li>Ketahui batas tubuh, <strong>hindari aktivitas fisik berat</strong> yang menguras tenaga.</li>
                </ul>
            </div>

            <div class="info-block block-smoke">
                <div class="block-icon">🚭</div>
                <h3 class="block-title">Udara Bersih</h3>
                <ul class="advice-list">
                    <li>Sayangi jantung dengan <strong>berhenti merokok sepenuhnya</strong>.</li>
                    <li>Jauhi lingkungan penuh asap rokok <strong>(hindari menjadi perokok pasif)</strong>.</li>
                </ul>
            </div>

            <div class="info-block block-meds">
                <div class="block-icon">💊</div>
                <h3 class="block-title">Disiplin Pengobatan</h3>
                <ul class="advice-list">
                    <li>Minum obat secara rutin <strong>sesuai jadwal & dosis</strong> dari dokter.</li>
                    <li><strong>Jangan pernah menghentikan obat</strong> sendiri meski merasa sudah sehat.</li>
                </ul>
            </div>

            <div class="info-block block-stress">
                <div class="block-icon">😌</div>
                <h3 class="block-title">Pikiran Tenang</h3>
                <ul class="advice-list">
                    <li>Pastikan Anda mendapat <strong>istirahat & tidur yang cukup</strong> (7-8 Jam).</li>
                    <li>Lakukan relaksasi, jalani hobi, atau <strong>perbanyak ibadah</strong> agar pikiran rileks.</li>
                </ul>
            </div>

            <div class="info-block block-danger">
                <div class="block-icon">⚠️</div>
                <h3 class="block-title">Waspada Tanda Bahaya</h3>
                <ul class="advice-list">
                    <li><strong>Nyeri dada kiri</strong> (seperti tertindih/tembus ke punggung).</li>
                    <li>Mengalami <strong>sesak napas</strong> secara tiba-tiba.</li>
                    <li>Merasa <strong>pusing berat</strong> disertai keringat dingin berlebih.</li>
                </ul>
            </div>

        </div>

        <div class="poster-footer">
            <h3>❤️ Salam Sehat, Jantung Kuat!</h3>
            <p>Silakan tempel panduan ini di rumah (misal: di pintu kulkas) sebagai pengingat harian Anda.</p>
        </div>

    </div>
</body>
</html>