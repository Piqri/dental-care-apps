<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pemeriksaan Gigi Ibu Hamil - {{ $pregnantDentalCheckup->pasien->nama }}</title>
    <link rel="stylesheet" href="{{ public_path('app/print.css') }}" media="all">
</head>
<body>
    <div class="header">
        <h1>Laporan Pemeriksaan Gigi Ibu Hamil</h1>
        <p>Informasi lengkap pemeriksaan kesehatan gigi dan mulut untuk ibu hamil</p>
    </div>

    <!-- Data Pasien -->
    <div class="section">
        <div class="section-title">Data Pasien</div>
        <div class="patient-info">
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
        </div>
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
