<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pemeriksaan Gigi Anak Sekolah - {{ $schoolChildDentalCheckup->pasien->nama }}</title>
    <link rel="stylesheet" href="{{ public_path('app/print.css') }}" media="all">
</head>
<body>
    <div class="header">
        <h1>Laporan Pemeriksaan Gigi Anak Sekolah</h1>
        <p>Informasi lengkap pemeriksaan kesehatan gigi dan mulut</p>
    </div>

    <!-- Patient Information -->
    <div class="section">
        <div class="section-title">Data Pasien</div>
        <div class="patient-info">
            <div>
                <div class="info-group">
                    <span class="info-label">Nama:</span>
                    <span>{{ $schoolChildDentalCheckup->pasien->nama }}</span>
                </div>
                <div class="info-group">
                    <span class="info-label">Umur:</span>
                    <span>{{ $schoolChildDentalCheckup->pasien->umur }} Tahun</span>
                </div>
                @if($schoolChildDentalCheckup->pasien->jenis_kelamin)
                <div class="info-group">
                    <span class="info-label">Jenis Kelamin:</span>
                    <span>{{ $schoolChildDentalCheckup->pasien->jenis_kelamin }}</span>
                </div>
                @endif
            </div>
            <div>
                @if($schoolChildDentalCheckup->pasien->nik)
                <div class="info-group">
                    <span class="info-label">NIK:</span>
                    <span>{{ $schoolChildDentalCheckup->pasien->nik }}</span>
                </div>
                @endif
                @if($schoolChildDentalCheckup->pasien->no_wa)
                <div class="info-group">
                    <span class="info-label">No. WhatsApp:</span>
                    <span>{{ $schoolChildDentalCheckup->pasien->no_wa }}</span>
                </div>
                @endif
                @if($schoolChildDentalCheckup->pasien->alamat)
                <div class="info-group">
                    <span class="info-label">Alamat:</span>
                    <span>{{ $schoolChildDentalCheckup->pasien->alamat }}</span>
                </div>
                @endif
            </div>
        </div>
        @if($schoolChildDentalCheckup->pasien->tanggal_lahir)
        <div class="info-group">
            <span class="info-label">Tanggal Lahir:</span>
            <span>{{ $schoolChildDentalCheckup->pasien->tempat_lahir }}, {{ \Carbon\Carbon::parse($schoolChildDentalCheckup->pasien->tanggal_lahir)->translatedFormat('d F Y') }}</span>
        </div>
        @endif
        <div class="info-group">
            <span class="info-label">Tanggal Pemeriksaan:</span>
            <span>{{ $schoolChildDentalCheckup->created_at->format('d F Y H:i') }}</span>
        </div>
    </div>

    <!-- Kondisi Gigi Section -->
    <div class="section">
        <div class="section-title">Kondisi Gigi</div>
        <div class="grid-2">
            @php
                $kondisiFields = [
                    'kondisi_karies' => 'Karies',
                    'kondisi_karang_gigi' => 'Karang Gigi',
                    'kondisi_gigi_goyang' => 'Gigi Goyang',
                    'kondisi_sisa_akar' => 'Sisa Akar'
                ];
            @endphp

            @foreach($kondisiFields as $field => $label)
            <div class="condition-item">
                <span>{{ $label }}</span>
                @if($schoolChildDentalCheckup->$field)
                    <span class="badge badge-yes">Ada</span>
                @else
                    <span class="badge badge-no">Tidak Ada</span>
                @endif
            </div>
            @endforeach

            <div class="condition-item">
                <span>Jumlah Gigi</span>
                <span>{{ ucfirst($schoolChildDentalCheckup->jumlah_gigi) }}</span>
            </div>
        </div>
    </div>

    <!-- Saran dan Catatan Section -->
    <div class="section">
        <div class="section-title">Saran dan Catatan</div>

        @if($schoolChildDentalCheckup->saran_konsultasi == 'Ya')
        <div class="advice-box advice-konsultasi">
            <strong>Saran Konsultasi:</strong> Disarankan untuk melakukan konsultasi dan perawatan ke dokter gigi
        </div>
        @endif

        @if($schoolChildDentalCheckup->saran_kontrol_rutin == 'Ya')
        <div class="advice-box advice-kontrol">
            <strong>Saran Kontrol Rutin:</strong> Disarankan untuk melakukan kontrol rutin
        </div>
        @endif

        @if($schoolChildDentalCheckup->catatan)
        <div class="notes">
            <strong>Catatan Tambahan:</strong><br>
            {{ $schoolChildDentalCheckup->catatan }}
        </div>
        @endif

        @if($schoolChildDentalCheckup->saran_konsultasi != 'Ya' && $schoolChildDentalCheckup->saran_kontrol_rutin != 'Ya' && !$schoolChildDentalCheckup->catatan)
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
