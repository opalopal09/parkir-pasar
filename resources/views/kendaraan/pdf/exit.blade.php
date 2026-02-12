<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Karcis Parkir Keluar</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            font-size: 12px;
            padding: 20px;
        }
        
        .receipt {
            border: 3px solid #000;
            padding: 15px;
            max-width: 400px;
            margin: 0 auto;
        }
        
        .header {
            text-align: center;
            border-bottom: 2px dashed #000;
            padding-bottom: 10px;
            margin-bottom: 15px;
        }
        
        .title {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 3px;
        }
        
        .subtitle {
            font-size: 14px;
            color: #666;
            margin-bottom: 5px;
        }
        
        .section-title {
            font-weight: bold;
            font-size: 13px;
            margin-top: 10px;
            margin-bottom: 8px;
            border-bottom: 1px solid #ccc;
            padding-bottom: 3px;
        }
        
        .info-row {
            display: table;
            width: 100%;
            margin-bottom: 5px;
        }
        
        .label {
            display: table-cell;
            font-weight: bold;
            width: 45%;
        }
        
        .value {
            display: table-cell;
            width: 55%;
        }
        
        .divider {
            border-top: 1px dashed #000;
            margin: 12px 0;
        }
        
        .total-box {
            background-color: #000;
            color: #fff;
            padding: 12px;
            margin: 15px 0;
            text-align: center;
            font-weight: bold;
            font-size: 18px;
        }
        
        .fee-row {
            display: table;
            width: 100%;
            margin-bottom: 5px;
            font-size: 13px;
        }
        
        .fee-label {
            display: table-cell;
            width: 60%;
        }
        
        .fee-value {
            display: table-cell;
            width: 40%;
            text-align: right;
            font-weight: bold;
        }
        
        .footer {
            text-align: center;
            font-size: 10px;
            color: #666;
            margin-top: 15px;
            padding-top: 10px;
            border-top: 2px dashed #000;
        }
        
        .barcode {
            text-align: center;
            font-family: 'Courier New', monospace;
            font-size: 16px;
            letter-spacing: 2px;
            margin: 10px 0;
        }
    </style>
</head>
<body>
    <div class="receipt">
        <div class="header">
            <div class="title">KARCIS PARKIR KELUAR</div>
            <div class="subtitle">BUKTI PEMBAYARAN</div>
            <div class="barcode">{{ str_replace([' ', '-'], '', $kendaraan->plat_nomor) }}</div>
        </div>

        <div class="section-title">INFORMASI KENDARAAN</div>
        <div class="info-row">
            <div class="label">Plat Nomor:</div>
            <div class="value">{{ $kendaraan->plat_nomor }}</div>
        </div>
        <div class="info-row">
            <div class="label">Jenis:</div>
            <div class="value">{{ $kendaraan->jenis }}</div>
        </div>
        <div class="info-row">
            <div class="label">Warna:</div>
            <div class="value">{{ $kendaraan->warna }}</div>
        </div>
        <div class="info-row">
            <div class="label">Pemilik:</div>
            <div class="value">{{ $kendaraan->pemilik }}</div>
        </div>

        <div class="divider"></div>

        <div class="section-title">DETAIL PARKIR</div>
        <div class="info-row">
            <div class="label">Area:</div>
            <div class="value">{{ $kendaraan->area->nama_area ?? '-' }}</div>
        </div>
        <div class="info-row">
            <div class="label">Waktu Masuk:</div>
            <div class="value">{{ $kendaraan->created_at->format('d/m/Y H:i') }}</div>
        </div>
        <div class="info-row">
            <div class="label">Waktu Keluar:</div>
            <div class="value">{{ \Carbon\Carbon::parse($kendaraan->waktu_keluar)->format('d/m/Y H:i') }}</div>
        </div>
        <div class="info-row">
            <div class="label">Durasi Parkir:</div>
            <div class="value">{{ $durasiJam }} Jam</div>
        </div>

        <div class="divider"></div>

        <div class="section-title">RINCIAN BIAYA</div>
        <div class="fee-row">
            <div class="fee-label">Tarif per Jam:</div>
            <div class="fee-value">Rp {{ number_format($kendaraan->tarif->tarif_per_jam ?? 0, 0, ',', '.') }}</div>
        </div>
        <div class="fee-row">
            <div class="fee-label">Durasi ({{ $durasiJam }} Jam):</div>
            <div class="fee-value">Rp {{ number_format(($kendaraan->tarif->tarif_per_jam ?? 0) * $durasiJam, 0, ',', '.') }}</div>
        </div>

        <div class="total-box">
            TOTAL BAYAR: Rp {{ number_format($kendaraan->total_biaya, 0, ',', '.') }}
        </div>

        <div class="footer">
            <div>Petugas: {{ auth()->user()->nama_lengkap ?? auth()->user()->username }}</div>
            <div>Dicetak: {{ now()->format('d/m/Y H:i:s') }}</div>
            <div style="margin-top: 8px; font-weight: bold;">LUNAS - Terima Kasih</div>
        </div>
    </div>
</body>
</html>
