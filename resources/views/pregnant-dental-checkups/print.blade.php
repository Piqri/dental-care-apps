<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pemeriksaan Gigi Ibu Hamil - {{ $pregnantDentalCheckup->pasien->nama }}</title>
    <link rel="stylesheet" href="{{ asset('css/print.css') }}" media="all">
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 12px;
            color: #333;
            line-height: 1.4;
        }
        
        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #3b82f6;
            padding-bottom: 10px;
        }
        
        .header h1 {
            font-size: 18px;
            margin: 0;
            color: #1e40af;
        }
        
        .header p {
            font-size: 14px;
            margin: 5px 0 0;
            color: #6b7280;
        }
        
        .section {
            margin-bottom: 15px;
            page-break-inside: avoid;
        }
        
        .section-title {
            background-color: #eff6ff;
            padding: 8px 12px;
            font-weight: bold;
            border-left: 4px solid #3b82f6;
            margin-bottom: 10px;
            font-size: 14px;
        }
        
        /* === Data Pasien === */
        .patient-info {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 12px 20px;
            margin-bottom: 15px;
        }
        
        .info-group {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 6px 8px;
            background-color: #f9fafb;
            border: 1px solid #e5e7eb;
            border-radius: 4px;
            font-size: 12px;
        }
        
        .info-label {
            font-weight: bold;
            color: #374151;
        }
        
        /* === Keluhan & Kondisi === */
        .grid-2 {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 10px;
        }
        
        .condition-item {
            display: flex;
            justify-content: space-between;
            padding: 6px 8px;
            background-color: #f9fafb;
            border: 1px solid #e5e7eb;
            border-radius: 4px;
            margin-bottom: 5px;
            font-size: 12px;
        }
        
        .badge {
            padding: 2px 8px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: 500;
        }
        
        .badge-yes {
            background-color: #fee2e2;
            color: #dc2626;
        }
        
        .badge-no {
            background-color: #d1fae5;
            color: #059669;
        }
        
        /* === Saran & Catatan === */
        .advice-box {
            padding: 10px;
            border-radius: 6px;
            margin-bottom: 10px;
            font-size: 12px;
        }
        
        .advice-konsultasi {
            background-color: #fef3c7;
            border: 1px solid #f59e0b;
        }
        
        .advice-kontrol {
            background-color: #d1fae5;
            border: 1px solid #10b981;
        }
        
        .notes {
            background-color: #eff6ff;
            border: 1px solid #3b82f6;
            padding: 10px;
            border-radius: 6px;
            font-size: 12px;
        }
        
        /* === Footer === */
        .footer {
            margin-top: 30px;
            text-align: right;
            font-size: 11px;
            color: #6b7280;
        }
        
        /* === Table (kalau dipakai di laporan lain) === */
        table {
            width: 100%;
            border-collapse: collapse;
        }
        
        table, th, td {
            border: 1px solid #e5e7eb;
        }
        
        th, td {
            padding: 8px;
            text-align: left;
        }
        
        th {
            background-color: #f3f4f6;
        }
        
        @page {
            margin: 20px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Laporan Pemeriksaan Gigi Ibu Hamil</h1>
        <p>Informasi lengkap pemeriksaan kesehatan gigi dan mulut untuk ibu hamil</p>
    </div>

    <!-- Data Pasien -->
    <div class="section">
        <div class="section-title">Data Pasien</div>
        <table class="patient-info">
            <div class="info-group">
                <span class="info-label">Nama</span>
                <span>{{ $pregnantDentalCheckup->pasien->nama }}</span>
            </div>
            <div class="info-group">
                <span class="info-label">Umur</span>
                <span>{{ $pregnantDentalCheckup->pasien->umur }} Tahun</span>
            </div>
            <div class="info-group">
                <span class="info-label">No. WhatsApp</span>
                <span>{{ $pregnantDentalCheckup->pasien->no_wa }}</span>
            </div>
            <div class="info-group">
                <span class="info-label">Alamat</span>
                <span>{{ $pregnantDentalCheckup->pasien->alamat }}</span>
            </div>
            <div class="info-group">
                <span class="info-label">Tanggal Pemeriksaan</span>
                <span>{{ $pregnantDentalCheckup->created_at->format('d F Y H:i') }}</span>
            </div>
        </table>
    </div>

    <!-- Keluhan Pasien -->
    <div class="section">
        <div class="section-title">Keluhan Pasien</div>
        <div class="grid-2">
            @php
                $keluhanFields = [
                    'gigi_berdarah' => 'Gigi Berdarah',
                    'gusi_bengkak' => 'Gusi Bengkak',
                    'dikomentari_bau_mulut' => 'Dikomentari Bau Mulut',
                    'gigi_goyang' => 'Gigi Goyang',
                    'sulit_mengunyah' => 'Sulit Mengunyah',
                    'makanan_terselip' => 'Makanan Terselip',
                    'gusi_sakit' => 'Gusi Sakit',
                    'gigi_sakit' => 'Gigi Sakit'
                ];
            @endphp

            @foreach($keluhanFields as $field => $label)
            <div class="condition-item">
                <span>{{ $label }}</span>
                <span class="badge {{ $pregnantDentalCheckup->$field == 'Ya' ? 'badge-yes' : 'badge-no' }}">
                    {{ $pregnantDentalCheckup->$field == 'Ya' ? 'Ya' : 'Tidak' }}
                </span>
            </div>
            @endforeach
        </div>

        @if($pregnantDentalCheckup->keluhan_lain)
        <div class="notes">
            <strong>Keluhan Lain:</strong><br>
            {{ $pregnantDentalCheckup->keluhan_lain }}
        </div>
        @endif
    </div>

    <!-- Kondisi Gigi -->
    <div class="section">
        <div class="section-title">Kondisi Gigi</div>
        <div class="grid-2">
            @php
                $kondisiFields = [
                    'kondisi_karies' => 'Karies',
                    'kondisi_sisa_akar' => 'Sisa Akar',
                    'kondisi_karang_gigi' => 'Karang Gigi',
                    'kondisi_gusi_bengkak' => 'Gusi Bengkak',
                    'kondisi_gigi_goyang' => 'Gigi Goyang',
                    'kondisi_pendarahan' => 'Pendarahan'
                ];
            @endphp

            @foreach($kondisiFields as $field => $label)
            <div class="condition-item">
                <span>{{ $label }}</span>
                @if($pregnantDentalCheckup->$field)
                    <span class="badge badge-yes">Ada</span>
                @else
                    <span class="badge badge-no">Tidak Ada</span>
                @endif
            </div>
            @endforeach
        </div>
    </div>

    <!-- Saran & Catatan -->
    <div class="section">
        <div class="section-title">Saran dan Catatan</div>

        @if($pregnantDentalCheckup->saran_konsultasi == 'Ya')
        <div class="advice-box advice-konsultasi">
            <strong>Saran Konsultasi:</strong> Disarankan untuk melakukan konsultasi ke dokter gigi
        </div>
        @endif

        @if($pregnantDentalCheckup->saran_kontrol_rutin == 'Ya')
        <div class="advice-box advice-kontrol">
            <strong>Saran Kontrol Rutin:</strong> Disarankan untuk kontrol rutin setiap 6 bulan sekali
        </div>
        @endif

        @if($pregnantDentalCheckup->catatan)
        <div class="notes">
            <strong>Catatan Tambahan:</strong><br>
            {{ $pregnantDentalCheckup->catatan }}
        </div>
        @endif

        @if($pregnantDentalCheckup->saran_konsultasi != 'Ya' && $pregnantDentalCheckup->saran_kontrol_rutin != 'Ya' && !$pregnantDentalCheckup->catatan)
        <div style="text-align: center; color: #6b7280; font-style: italic;">
            Tidak ada saran atau catatan
        </div>
        @endif
    </div>

    <!-- Footer -->
    <div class="footer">
        Dokumen dicetak pada: {{ now()->format('d F Y H:i') }}
    </div>
</body>
</html>
