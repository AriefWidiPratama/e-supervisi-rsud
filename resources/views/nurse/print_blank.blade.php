<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Blanko Lifestyle | E-Supervisi</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;800&display=swap');
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f1f5f9; display: flex; flex-direction: column; align-items: center; padding: 20px; }
        .print-btn { background-color: #e11d48; color: white; border: none; padding: 12px 24px; font-weight: 800; border-radius: 50px; cursor: pointer; margin-bottom: 20px; }
        .a4-paper { background-color: #ffffff; width: 210mm; min-height: 297mm; padding: 15mm 20mm; margin: 0 auto; }
        .header { text-align: center; border-bottom: 4px solid #e11d48; padding-bottom: 15px; margin-bottom: 20px; }
        .header h1 { font-size: 26px; font-weight: 800; color: #e11d48; }
        .patient-info { background-color: #fff1f2; border: 1px solid #fda4af; padding: 20px; border-radius: 12px; margin-bottom: 25px; display: flex; justify-content: space-between; gap: 20px; }
        .info-block { flex: 1; }
        .info-block span { font-size: 10px; color: #e11d48; font-weight: 800; }
        .blank-line { border-bottom: 1px dashed #e11d48; height: 20px; width: 100%; }
        .checklist-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
        .category-box { border: 1px solid #e2e8f0; border-radius: 12px; padding: 15px; }
        .category-title { font-size: 14px; font-weight: 800; border-bottom: 2px solid #f1f5f9; padding-bottom: 8px; margin-bottom: 12px; }
        .check-item { display: flex; align-items: center; gap: 12px; margin-bottom: 10px; font-size: 13px; font-weight: 600; color: #475569;}
        .box { width: 20px; height: 20px; border: 2px solid #94a3b8; border-radius: 4px; }
        .signature-area { display: flex; justify-content: space-between; margin-top: 40px; padding: 0 30px;}
        .signature-box { text-align: center; width: 220px; }
        .sign-line { border-bottom: 1px solid #1e293b; margin: 60px 0 5px 0; }
        @page { size: A4; margin: 0; }
        @media print { body { background-color: white; padding: 0; } .a4-paper { padding: 15mm; width: 100%; } .print-btn { display: none; } * { -webkit-print-color-adjust: exact !important; color-adjust: exact !important; } }
    </style>
</head>
<body>
    <button class="print-btn" onclick="window.print()">🖨️ CETAK BLANKO (KOSONG)</button>
    <div class="a4-paper">
        <div class="header">
            <h1>KARTU EDUKASI LIFESTYLE</h1>
            <p>RSUD Arifin Achmad Pekanbaru - Fokus: Hipertensi & Jantung Koroner</p>
        </div>
        <div class="patient-info">
            <div class="info-block"><span>Inisial Pasien:</span><div class="blank-line"></div></div>
            <div class="info-block"><span>Diagnosa Medis:</span><div class="blank-line"></div></div>
            <div class="info-block"><span>Tanggal Edukasi:</span><div class="blank-line"></div></div>
        </div>
        <div class="checklist-grid">
            <div class="category-box"><div class="category-title">🥗 Pola Makan Sehat</div><div class="check-item"><div class="box"></div> Kurangi garam</div><div class="check-item"><div class="box"></div> Batasi gorengan</div><div class="check-item"><div class="box"></div> Perbanyak buah</div></div>
            <div class="category-box"><div class="category-title">🏃 Aktivitas Fisik</div><div class="check-item"><div class="box"></div> Rutin olahraga</div><div class="check-item"><div class="box"></div> Hindari aktivitas berat</div></div>
            <div class="category-box"><div class="category-title">🚭 Kebiasaan Merokok</div><div class="check-item"><div class="box"></div> Berhenti merokok</div><div class="check-item"><div class="box"></div> Hindari asap rokok</div></div>
            <div class="category-box"><div class="category-title">💊 Kepatuhan Obat</div><div class="check-item"><div class="box"></div> Minum sesuai jadwal</div><div class="check-item"><div class="box"></div> Jangan hentikan obat</div></div>
            <div class="category-box"><div class="category-title">😌 Manajemen Stres</div><div class="check-item"><div class="box"></div> Istirahat cukup</div><div class="check-item"><div class="box"></div> Relaksasi/Ibadah</div></div>
            <div class="category-box" style="border-color: #fda4af; background-color: #fff1f2;"><div class="category-title" style="color: #e11d48;">⚠️ Tanda Bahaya (IGD)</div><div class="check-item"><div class="box"></div> Nyeri dada</div><div class="check-item"><div class="box"></div> Sesak napas</div><div class="check-item"><div class="box"></div> Pusing berat</div></div>
        </div>
        <div class="signature-area">
            <div class="signature-box"><p>Pasien / Keluarga</p><div class="sign-line"></div></div>
            <div class="signature-box"><p>Perawat Edukator</p><div class="sign-line"></div></div>
        </div>
    </div>
</body>
</html>