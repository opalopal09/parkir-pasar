<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Karcis Parkir - {{ $kendaraan->plat_nomor }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @media print {
            .no-print {
                display: none;
            }
            body {
                margin: 0;
                padding: 20px;
            }
        }
        
        .receipt-container {
            max-width: 400px;
            margin: 20px auto;
            border: 2px solid #000;
            padding: 20px;
            font-family: 'Courier New', monospace;
        }
        
        .receipt-header {
            text-align: center;
            border-bottom: 2px dashed #000;
            padding-bottom: 15px;
            margin-bottom: 15px;
        }
        
        .receipt-title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 5px;
        }
        
        .receipt-subtitle {
            font-size: 14px;
            color: #666;
        }
        
        .receipt-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
            font-size: 14px;
        }
        
        .receipt-label {
            font-weight: bold;
        }
        
        .receipt-divider {
            border-top: 1px dashed #000;
            margin: 15px 0;
        }
        
        .receipt-total {
            font-size: 18px;
            font-weight: bold;
            text-align: center;
            padding: 10px;
            background-color: #f8f9fa;
            border: 2px solid #000;
            margin: 15px 0;
        }
        
        .receipt-footer {
            text-align: center;
            font-size: 12px;
            color: #666;
            margin-top: 15px;
            padding-top: 15px;
            border-top: 2px dashed #000;
        }
    </style>
</head>
<body>
    <div class="receipt-container">
        <div class="receipt-header">
            <div class="receipt-title">KARCIS PARKIR</div>
            <div class="receipt-subtitle">PASAR</div>
        </div>

        <div class="receipt-section">
            <h6 style="font-weight: bold; margin-bottom: 10px;">INFORMASI KENDARAAN</h6>
            <div class="receipt-row">
                <span class="receipt-label">Plat Nomor:</span>
                <span>{{ $kendaraan->plat_nomor }}</span>
            </div>
            <div class="receipt-row">
                <span class="receipt-label">Jenis:</span>
                <span>{{ $kendaraan->jenis }}</span>
            </div>
            <div class="receipt-row">
                <span class="receipt-label">Warna:</span>
                <span>{{ $kendaraan->warna }}</span>
            </div>
            <div class="receipt-row">
                <span class="receipt-label">Pemilik:</span>
                <span>{{ $kendaraan->pemilik }}</span>
            </div>
        </div>

        <div class="receipt-divider"></div>

        <div class="receipt-section">
            <h6 style="font-weight: bold; margin-bottom: 10px;">DETAIL PARKIR</h6>
            <div class="receipt-row">
                <span class="receipt-label">Area:</span>
                <span>{{ $kendaraan->area->nama_area ?? '-' }}</span>
            </div>
            <div class="receipt-row">
                <span class="receipt-label">Waktu Masuk:</span>
                <span>{{ $kendaraan->created_at->format('d/m/Y H:i') }}</span>
            </div>
            <div class="receipt-row">
                <span class="receipt-label">Waktu Keluar:</span>
                <span>{{ \Carbon\Carbon::parse($kendaraan->waktu_keluar)->format('d/m/Y H:i') }}</span>
            </div>
            <div class="receipt-row">
                <span class="receipt-label">Durasi:</span>
                <span>
                    @php
                        $waktuMasuk = \Carbon\Carbon::parse($kendaraan->created_at);
                        $waktuKeluar = \Carbon\Carbon::parse($kendaraan->waktu_keluar);
                        $durasiJam = $waktuMasuk->diffInHours($waktuKeluar);
                        if ($waktuMasuk->diffInMinutes($waktuKeluar) % 60 > 0) {
                            $durasiJam += 1;
                        }
                        if ($durasiJam < 1) {
                            $durasiJam = 1;
                        }
                    @endphp
                    {{ $durasiJam }} Jam
                </span>
            </div>
        </div>

        <div class="receipt-divider"></div>

        <div class="receipt-section">
            <h6 style="font-weight: bold; margin-bottom: 10px;">RINCIAN BIAYA</h6>
            <div class="receipt-row">
                <span class="receipt-label">Tarif/Jam:</span>
                <span>Rp {{ number_format($kendaraan->tarif->tarif_per_jam ?? 0, 0, ',', '.') }}</span>
            </div>
            <div class="receipt-row">
                <span class="receipt-label">Durasi:</span>
                <span>{{ $durasiJam }} Jam</span>
            </div>
        </div>

        <div class="receipt-total">
            TOTAL: Rp {{ number_format($kendaraan->total_biaya, 0, ',', '.') }}
        </div>

        <div class="receipt-footer">
            <div>Petugas: {{ auth()->user()->nama_lengkap ?? auth()->user()->username }}</div>
            <div>{{ now()->format('d/m/Y H:i:s') }}</div>
            <div style="margin-top: 10px;">Terima kasih atas kunjungan Anda!</div>
        </div>
    </div>

    <div class="text-center mt-4 no-print">
        <button onclick="window.print()" class="btn btn-primary btn-lg me-2">
            🖨️ Cetak Karcis
        </button>
        <a href="/kendaraan" class="btn btn-secondary btn-lg">
            ← Kembali
        </a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
