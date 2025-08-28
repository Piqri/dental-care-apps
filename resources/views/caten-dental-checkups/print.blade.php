<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pemeriksaan Gigi Caten - {{ $catenDentalCheckup->pasien->nama }}</title>
    <link rel="stylesheet" href="{{ public_path('app/print.css') }}" media="all">
</head>
<body>
    <div class="header">
        <h1>Laporan Pemeriksaan Gigi Caten</h1>
        <p>Informasi lengkap pemeriksaan kesehatan gigi dan mulut</p>
    </div>

    <!-- Patient Information -->
    <div class="section">
        <div class="section-title">Data Pasien</div>
        <div class="patient-info">
            <div>
                <div class="info-group">
                    <span class="info-label">Nama:</span>
                    <span>{{ $catenDentalCheckup->pasien->nama }}</span>
                </div>
                <div class="info-group">
                    <span class="info-label">Umur:</span>
                    <span>{{ $catenDentalCheckup->pasien->umur }} Tahun</span>
                </div>
                <div class="info-group">
                    <span class="info-label">Jenis Kelamin:</span>
                    <span>{{ $catenDentalCheckup->pasien->jenis_kelamin }}</span>
                </div>
            </div>
            <div>
                <div class="info-group">
                    <span class="info-label">NIK:</span>
                    <span>{{ $catenDentalCheckup->pasien->nik }}</span>
                </div>
                <div class="info-group">
                    <span class="info-label">No. WhatsApp:</span>
                    <span>{{ $catenDentalCheckup->pasien->no_wa }}</span>
                </div>
                <div class="info-group">
                    <span class="info-label">Alamat:</span>
                    <span>{{ $catenDentalCheckup->pasien->alamat }}</span>
                </div>
            </div>
        </div>
        <div class="info-group">
            <span class="info-label">Tanggal Pemeriksaan:</span>
            <span>{{ $catenDentalCheckup->created_at->format('d F Y H:i') }}</span>
        </div>
    </div>

    <!-- Keluhan Section -->
    <div class="section">
        <div class="section-title">Keluhan Pasien</div>
        <div class="grid-2">
            @php
                $keluhanFields = [
                    'gigi_berlubang' => 'Gigi Berlubang',
                    'riwayat_sakit_gigi' => 'Riwayat Sakit Gigi',
                    'gusi_bengkak' => 'Gusi Bengkak',
                    'sisa_akar' => 'Sisa Akar',
                    'gusi_berdarah' => 'Gusi Berdarah',
                    'gigi_goyang' => 'Gigi Goyang',
                    'sariawan' => 'Sariawan'
                ];
            @endphp

            @foreach($keluhanFields as $field => $label)
            <div class="condition-item">
                <span>{{ $label }}</span>
                <span class="badge {{ $catenDentalCheckup->$field == 'Ya' ? 'badge-yes' : 'badge-no' }}">
                    {{ $catenDentalCheckup->$field == 'Ya' ? 'Ya' : 'Tidak' }}
                </span>
            </div>
            @endforeach

            @if($catenDentalCheckup->terakhir_sakit_gigi)
            <div class="condition-item">
                <span>Terakhir Sakit Gigi</span>
                <span>{{ \Carbon\Carbon::parse($catenDentalCheckup->terakhir_sakit_gigi)->translatedFormat('d F Y') }}</span>
            </div>
            @endif
        </div>
    </div>

    <!-- Kondisi Gigi Section -->
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
                @if($catenDentalCheckup->$field)
                    <span class="badge badge-yes">Ada</span>
                @else
                    <span class="badge badge-no">Tidak Ada</span>
                @endif
            </div>
            @endforeach
        </div>
    </div>

    <!-- Saran dan Catatan Section -->
    <div class="section">
        <div class="section-title">Saran dan Catatan</div>

        @if($catenDentalCheckup->saran_konsultasi == 'Ya')
        <div class="advice-box advice-konsultasi">
            <strong>Saran Konsultasi:</strong> Disarankan untuk melakukan konsultasi dan perawatan ke dokter gigi
        </div>
        @endif

        @if($catenDentalCheckup->saran_kontrol_rutin == 'Ya')
        <div class="advice-box advice-kontrol">
            <strong>Saran Kontrol Rutin:</strong> Disarankan untuk melakukan kontrol rutin
        </div>
        @endif

        @if($catenDentalCheckup->catatan)
        <div class="notes">
            <strong>Catatan Tambahan:</strong><br>
            {{ $catenDentalCheckup->catatan }}
        </div>
        @endif

        @if($catenDentalCheckup->saran_konsultasi != 'Ya' && $catenDentalCheckup->saran_kontrol_rutin != 'Ya' && !$catenDentalCheckup->catatan)
        <div style="text-align: center; color: #6b7280; font-style: italic;">
            Tidak ada saran atau catatan
        </div>
        @endif
    </div>

    <div class="footer">
        Dokumen dicetak pada: {{ now()->format('d F Y H:i') }}
    </div>
</body>
</html>
