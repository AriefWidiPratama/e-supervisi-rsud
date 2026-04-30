<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Kartu Lifestyle | E-Supervisi</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@700&display=swap');
        
        * { box-sizing: border-box; margin: 0; padding: 0; }
        
        body { 
            background-color: #525659; 
            display: flex; 
            flex-direction: column; 
            align-items: center; 
            padding: 20px; 
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .print-btn { 
            background-color: #1e503e; 
            color: white; 
            border: none; 
            padding: 12px 24px; 
            font-weight: 700; 
            font-size: 14px;
            border-radius: 8px; 
            cursor: pointer; 
            margin-bottom: 20px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.3);
            transition: background 0.3s;
        }
        .print-btn:hover { background-color: #153a2d; }

        .a5-page { 
            width: 148mm; 
            height: 210mm; 
            background-color: #ffffff; 
            margin-bottom: 20px; 
            box-shadow: 0 10px 20px rgba(0,0,0,0.5);
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
            position: relative;
        }

        .a5-page img {
            width: 100%;
            height: 100%;
            object-fit: cover; 
            object-position: center;
        }

        @page { 
            size: A5; 
            margin: 0; 
        }
        
        @media print { 
            body { 
                background-color: transparent; 
                padding: 0; 
                display: block; 
            } 
            .print-btn { display: none; } 
            
            .a5-page { 
                margin: 0; 
                box-shadow: none; 
                page-break-after: always; 
            }
            
            .a5-page:last-child {
                page-break-after: auto;
            }
            
            * { -webkit-print-color-adjust: exact !important; color-adjust: exact !important; } 
        }
    </style>
</head>
<body>

    <button class="print-btn" onclick="window.print()">🖨️ CETAK KARTU (UKURAN A5)</button>

    <!-- Halaman 1: Bagian Depan -->
    <div class="a5-page">
        <img src="{{ asset('Depan.png') }}" alt="Kartu Edukasi Depan">
    </div>

    <!-- Halaman 2: Bagian Belakang -->
    <div class="a5-page">
        <img src="{{ asset('belakang.png') }}" alt="Kartu Edukasi Belakang">
    </div>

</body>
</html>