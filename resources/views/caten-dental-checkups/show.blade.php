<x-app-layout>
    <div class="py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
            <!-- Header Section -->
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">Detail Pemeriksaan Gigi Caten</h1>
                    <p class="text-gray-600 mt-1">Informasi lengkap pemeriksaan kesehatan gigi dan mulut</p>
                </div>
                <div class="flex space-x-2">
                    <!-- Tombol WhatsApp -->
                    <button onclick="sendToWhatsApp(
                        '{{ $catenDentalCheckup->pasien->nama }}',
                        '{{ $catenDentalCheckup->pasien->no_wa }}',
                        {
                            kondisi_karies: {{ $catenDentalCheckup->kondisi_karies ? 'true' : 'false' }},
                            kondisi_sisa_akar: {{ $catenDentalCheckup->kondisi_sisa_akar ? 'true' : 'false' }},
                            kondisi_karang_gigi: {{ $catenDentalCheckup->kondisi_karang_gigi ? 'true' : 'false' }},
                            kondisi_gusi_bengkak: {{ $catenDentalCheckup->kondisi_gusi_bengkak ? 'true' : 'false' }},
                            kondisi_gigi_goyang: {{ $catenDentalCheckup->kondisi_gigi_goyang ? 'true' : 'false' }},
                            kondisi_pendarahan: {{ $catenDentalCheckup->kondisi_pendarahan ? 'true' : 'false' }},
                        },
                        '{{ $catenDentalCheckup->saran_konsultasi }}',
                        '{{ $catenDentalCheckup->saran_kontrol_rutin }}'
                    )"
                    class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition">
                        <svg class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                        </svg>
                        Kirim ke WA
                    </button>
                    <!-- Tombol Print PDF (Baru ditambahkan) -->
                    <a href="{{ route('caten-dental-checkups.print', $catenDentalCheckup->id) }}" target="_blank"
                       class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2z" />
                        </svg>
                        Cetak PDF
                    </a>
                    <a href="{{ route('caten-dental-checkups.edit', $catenDentalCheckup->id) }}"
                       class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        Edit
                    </a>
                    <a href="{{ route('caten-dental-checkups.index') }}"
                       class="inline-flex items-center px-4 py-2 bg-gray-100 border border-gray-300 rounded-md font-medium text-gray-700 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Kembali
                    </a>
                </div>
            </div>

            <!-- Patient Profile Card -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="bg-gray-50 px-6 py-6 border-b border-gray-200">
                    <div class="flex items-center space-x-6">
                        <!-- Profile Icon -->
                        <div class="flex-shrink-0">
                            <div class="bg-blue-100 p-4 rounded-full">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                        </div>
                        <!-- Patient Info -->
                        <div class="flex-1">
                            <h2 class="text-xl font-bold text-gray-900 leading-tight mb-2">{{ $catenDentalCheckup->pasien->nama }}</h2>
                            <div class="flex flex-wrap items-center gap-4 text-gray-600 text-sm">
                                <div class="flex items-center gap-1">
                                    <span class="inline-flex items-center justify-center bg-gray-200 text-gray-700 rounded-full h-6 w-6 mr-1">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </span>
                                    <span>{{ $catenDentalCheckup->pasien->umur }} Tahun</span>
                                </div>
                                <div class="flex items-center gap-1">
                                    <span class="inline-flex items-center justify-center bg-gray-200 text-gray-700 rounded-full h-6 w-6 mr-1">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                        </svg>
                                    </span>
                                    <a href="https://wa.me/{{ $catenDentalCheckup->pasien->no_wa }}" target="_blank" class="hover:underline flex items-center gap-1">
                                        {{ $catenDentalCheckup->pasien->no_wa }}
                                        <svg class="h-3 w-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                        </svg>
                                    </a>
                                </div>
                                <div class="flex items-center gap-1">
                                    <span class="inline-flex items-center justify-center bg-gray-200 text-gray-700 rounded-full h-6 w-6 mr-1">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                    </span>
                                    <span>{{ $catenDentalCheckup->pasien->alamat }}</span>
                                </div>
                                <div>
                                    <span class="px-3 py-1 text-xs font-medium rounded-full bg-gray-100 text-gray-800">
                                        {{ ucfirst(str_replace('_', ' ', $catenDentalCheckup->pasien->jenis_pasien)) }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Patient Details -->
                <div class="px-6 py-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Informasi Umum</h3>
                        <div class="space-y-4 text-sm">
                            <div class="space-y-1">
                                <p class="text-xs text-gray-500 uppercase">Jenis Kelamin</p>
                                <p class="font-medium text-gray-800">{{ $catenDentalCheckup->pasien->jenis_kelamin }}</p>
                            </div>
                            <div class="space-y-1">
                                <p class="text-xs text-gray-500 uppercase">Tanggal Lahir</p>
                                <p class="font-medium text-gray-800">
                                    {{ $catenDentalCheckup->pasien->tempat_lahir }}, {{ \Carbon\Carbon::parse($catenDentalCheckup->pasien->tanggal_lahir)->translatedFormat('d F Y') }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div>
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Informasi Identitas</h3>
                        <div class="space-y-4 text-sm">
                            <div class="space-y-1">
                                <p class="text-xs text-gray-500 uppercase">NIK</p>
                                <p class="font-medium text-gray-800">{{ $catenDentalCheckup->pasien->nik }}</p>
                            </div>
                            <div class="space-y-1">
                                <p class="text-xs text-gray-500 uppercase">Tanggal Pemeriksaan</p>
                                <p class="font-medium text-gray-800">{{ $catenDentalCheckup->created_at->format('d F Y H:i') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Keluhan Section -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 bg-blue-50">
                    <h3 class="text-lg font-semibold text-gray-800 flex items-center">
                        <svg class="h-5 w-5 mr-2 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        Keluhan Pasien
                    </h3>
                </div>
                <div class="px-6 py-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
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
                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg border border-gray-200">
                            <span class="text-sm font-medium text-gray-700">{{ $label }}</span>
                            <span class="px-3 py-1 rounded-full text-xs font-medium {{ $catenDentalCheckup->$field == 'Ya' ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800' }}">
                                {{ $catenDentalCheckup->$field == 'Ya' ? 'Ya' : 'Tidak' }}
                            </span>
                        </div>
                        @endforeach

                        @if($catenDentalCheckup->terakhir_sakit_gigi)
                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg border border-gray-200">
                            <span class="text-sm font-medium text-gray-700">Terakhir Sakit Gigi</span>
                            <span class="px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                {{ \Carbon\Carbon::parse($catenDentalCheckup->terakhir_sakit_gigi)->translatedFormat('d F Y') }}
                            </span>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Kondisi Gigi Section -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 bg-blue-50">
                    <h3 class="text-lg font-semibold text-gray-800 flex items-center">
                        <svg class="h-5 w-5 mr-2 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Kondisi Gigi
                    </h3>
                </div>
                <div class="px-6 py-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
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
                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg border border-gray-200">
                            <span class="text-sm font-medium text-gray-700">{{ $label }}</span>
                            @if($catenDentalCheckup->$field)
                                <span class="px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">Ada</span>
                            @else
                                <span class="px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">Tidak Ada</span>
                            @endif
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Saran dan Catatan Section -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 bg-blue-50">
                    <h3 class="text-lg font-semibold text-gray-800 flex items-center">
                        <svg class="h-5 w-5 mr-2 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                        Saran dan Catatan
                    </h3>
                </div>
                <div class="px-6 py-6">
                    <div class="space-y-6">
                        @if($catenDentalCheckup->saran_konsultasi == 'Ya')
                        <div class="flex items-start p-4 bg-yellow-50 rounded-lg border border-yellow-200">
                            <svg class="h-6 w-6 text-yellow-600 mr-3 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                            <div>
                                <p class="font-medium text-yellow-800">Saran Konsultasi</p>
                                <p class="text-yellow-700">Disarankan untuk melakukan konsultasi dan perawatan ke dokter gigi</p>
                            </div>
                        </div>
                        @endif

                        @if($catenDentalCheckup->saran_kontrol_rutin == 'Ya')
                        <div class="flex items-start p-4 bg-green-50 rounded-lg border border-green-200">
                            <svg class="h-6 w-6 text-green-600 mr-3 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                            <div>
                                <p class="font-medium text-green-800">Saran Kontrol Rutin</p>
                                <p class="text-green-700">Disarankan untuk melakukan kontrol rutin</p>
                            </div>
                        </div>
                        @endif

                        @if($catenDentalCheckup->catatan)
                        <div class="p-4 bg-blue-50 rounded-lg border border-blue-200">
                            <p class="text-sm font-medium text-blue-800 mb-2">Catatan Tambahan:</p>
                            <p class="text-blue-900 whitespace-pre-wrap">{{ $catenDentalCheckup->catatan }}</p>
                        </div>
                        @endif

                        @if($catenDentalCheckup->saran_konsultasi != 'Ya' && $catenDentalCheckup->saran_kontrol_rutin != 'Ya' && !$catenDentalCheckup->catatan)
                        <div class="p-4 bg-gray-50 rounded-lg border border-gray-200 text-center">
                            <p class="text-gray-500 italic">Tidak ada</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Metadata Section -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                    <h3 class="text-lg font-semibold text-gray-800">Informasi Pemeriksaan</h3>
                </div>
                <div class="px-6 py-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-sm">
                        <div class="space-y-1">
                            <p class="text-xs text-gray-500 uppercase">Dibuat pada</p>
                            <p class="font-medium text-gray-800">{{ $catenDentalCheckup->created_at->format('d F Y H:i') }}</p>
                        </div>
                        <div class="space-y-1">
                            <p class="text-xs text-gray-500 uppercase">Diperbarui pada</p>
                            <p class="font-medium text-gray-800">{{ $catenDentalCheckup->updated_at->format('d F Y H:i') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('app/sendToWhatsApp.js') }}"></script>
</x-app-layout>
