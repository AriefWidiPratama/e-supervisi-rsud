<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kartu Digital Lifestyle | {{ strtoupper($education->patient->patient_code) }}</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@600;700;800&display=swap');
        
        * { box-sizing: border-box; margin: 0; padding: 0; }
        
        body { 
            background-color: #e2e8f0; 
            display: flex; 
            flex-direction: column; 
            align-items: center; 
            padding: 20px; 
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        /* Banner Identitas Pasien di Layar */
        .patient-banner {
            background-color: #1e503e; /* Hijau RSUD */
            color: white;
            padding: 15px 30px;
            border-radius: 20px;
            margin-bottom: 25px;
            font-weight: 800;
            box-shadow: 0 10px 20px rgba(30, 80, 62, 0.2);
            width: 100%;
            max-width: 148mm; /* Lebar sama dengan kertas A5 */
            display: flex;
            justify-content: space-between;
            align-items: center;
            border: 2px solid #2a6b54;
        }

        .patient-info span {
            font-size: 11px; 
            font-weight: 800; 
            color: #a7f3d0; 
            display: block; 
            text-transform: uppercase; 
            letter-spacing: 1px;
            margin-bottom: 2px;
        }
        
        .patient-info h2 {
            font-size: 20px;
            margin: 0;
            line-height: 1.2;
        }

        /* Tombol Cetak/Simpan (Warna Oranye) */
        .print-btn { 
            background-color: #d96b1e; 
            color: white; 
            border: none; 
            padding: 12px 20px; 
            font-weight: 800; 
            font-size: 12px;
            border-radius: 12px; 
            cursor: pointer; 
            transition: all 0.3s;
            box-shadow: 0 4px 10px rgba(217, 107, 30, 0.3);
            text-transform: uppercase;
        }
        .print-btn:hover { background-color: #b85a18; transform: translateY(-2px); }

        /* Kanvas Kertas A5 */
        .a5-page { 
            width: 148mm; 
            height: 210mm; 
            background-color: #ffffff; 
            margin-bottom: 20px; 
            box-shadow: 0 15px 35px rgba(0,0,0,0.15);
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
            border-radius: 12px;
        }

        .a5-page img {
            width: 100%;
            height: 100%;
            object-fit: cover; 
            object-position: center;
        }

        /* Responsive agar enak dilihat di HP pasien */
        @media (max-width: 600px) {
            .a5-page {
                width: 100%;
                height: auto;
                aspect-ratio: 148 / 210;
            }
            .patient-banner {
                flex-direction: column;
                text-align: center;
                gap: 15px;
            }
        }

        /* PENGATURAN CETAK / SIMPAN PDF */
        @page { size: A5; margin: 0; }
        
        @media print { 
            body { background-color: transparent; padding: 0; display: block; } 
            
            /* Sembunyikan banner dan tombol saat dicetak */
            .patient-banner, .print-btn { display: none !important; } 
            
            .a5-page { 
                margin: 0; 
                box-shadow: none; 
                border-radius: 0; 
                page-break-after: always; 
            }
            .a5-page:last-child { page-break-after: auto; }
            * { -webkit-print-color-adjust: exact !important; color-adjust: exact !important; } 
        }
    </style>
</head>
<body>

    <!-- Banner Identitas (Hanya tampil di layar HP/PC) -->
    <div class="patient-banner">
        <div class="patient-info">
            <span>📱 Kartu Digital Pasien</span>
            <h2>{{ strtoupper($education->patient->patient_code) }}</h2>
        </div>
        <button class="print-btn" onclick="window.print()">🖨️ Cetak / PDF</button>
    </div>

    <!-- Halaman 1: Gambar Depan -->
    <div class="a5-page">
        <!-- Sesuaikan dengan format gambar yang sukses sebelumnya (png atau jpg) -->
        <img src="{{ asset('Depan.png') }}" alt="Kartu Edukasi Depan">
    </div>

    <!-- Halaman 2: Gambar Belakang -->
    <div class="a5-page">
        <!-- Sesuaikan dengan format gambar yang sukses sebelumnya (png atau jpg) -->
        <img src="{{ asset('belakang.png') }}" alt="Kartu Edukasi Belakang">
    </div>

</body>
</html>