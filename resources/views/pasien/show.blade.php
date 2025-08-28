<x-app-layout>
    <div class="py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
            <!-- Header Section -->
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">Detail Data Pasien</h1>
                    <p class="text-gray-600 mt-1">Informasi lengkap pasien dan riwayat pemeriksaan gigi</p>
                </div>
                <div class="flex space-x-2">
                    <a href="{{ route('pasien.edit', $pasien->id) }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        Edit
                    </a>
                    <a href="{{ route('pasien.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-100 border border-gray-300 rounded-md font-medium text-gray-700 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition">
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
                            <h2 class="text-xl font-bold text-gray-900 leading-tight mb-2">{{ $pasien->nama }}</h2>
                            <div class="flex flex-wrap items-center gap-4 text-gray-600 text-sm">
                                <div class="flex items-center gap-1">
                                    <span class="inline-flex items-center justify-center bg-gray-200 text-gray-700 rounded-full h-6 w-6 mr-1">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </span>
                                    <span>{{ \Carbon\Carbon::parse($pasien->tanggal_lahir)->age }} Tahun</span>
                                </div>
                                <div class="flex items-center gap-1">
                                    <span class="inline-flex items-center justify-center bg-gray-200 text-gray-700 rounded-full h-6 w-6 mr-1">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                        </svg>
                                    </span>
                                    <a href="https://wa.me/{{ $pasien->no_wa }}" target="_blank" class="hover:underline flex items-center gap-1">
                                        {{ $pasien->no_wa }}
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
                                    <span>{{ $pasien->alamat }}</span>
                                </div>
                                <div class="flex items-center gap-1">
                                    <span class="inline-flex items-center justify-center bg-gray-200 text-gray-700 rounded-full h-6 w-6 mr-1">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                    </span>
                                    @php
                                        $badgeClasses = [
                                            'ibu_hamil'    => 'bg-pink-100 text-pink-800 border-pink-200',
                                            'anak_sekolah' => 'bg-blue-100 text-blue-800 border-blue-200',
                                            'caten'        => 'bg-purple-100 text-purple-800 border-purple-200',
                                        ];
                                    @endphp

                                    <span class="inline-flex px-2 py-1 text-xs font-medium rounded-full border {{ $badgeClasses[$pasien->jenis_pasien] ?? 'bg-gray-100 text-gray-800 border-gray-200' }}">
                                        {{ $pasien->jenis_pasien == 'caten' ? 'CATEN' : ucfirst(str_replace('_', ' ', $pasien->jenis_pasien)) }}
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
                                <p class="font-medium text-gray-800">{{ $pasien->jenis_kelamin }}</p>
                            </div>
                            <div class="space-y-1">
                                <p class="text-xs text-gray-500 uppercase">Tanggal Lahir</p>
                                <p class="font-medium text-gray-800">
                                    {{ $pasien->tempat_lahir }}, {{ \Carbon\Carbon::parse($pasien->tanggal_lahir)->translatedFormat('d F Y') }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Additional Info Based on Patient Type -->
                    @if($pasien->jenis_pasien == 'ibu_hamil' || $pasien->jenis_pasien == 'caten')
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Informasi Identitas</h3>
                        <div class="space-y-4 text-sm">
                            <div class="space-y-1">
                                <p class="text-xs text-gray-500 uppercase">NIK</p>
                                <p class="font-medium text-gray-800">{{ $pasien->nik }}</p>
                            </div>
                        </div>
                    </div>
                    @endif

                    @if($pasien->jenis_pasien == 'anak_sekolah')
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Informasi Orang Tua</h3>
                        <div class="space-y-4 text-sm">
                            <div class="space-y-1">
                                <p class="text-xs text-gray-500 uppercase">Nama Orang Tua</p>
                                <p class="font-medium text-gray-800">{{ $pasien->nama_orang_tua }}</p>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Dental Checkups Section -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                    <h2 class="text-xl font-bold text-gray-800">Riwayat Pemeriksaan Gigi</h2>

                    @if($pasien->jenis_pasien == 'ibu_hamil')
                        <a href="{{ route('pregnant-dental-checkups.create.withPasien', $pasien->id) }}"
                        class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg shadow hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            + Tambah Pemeriksaan
                        </a>
                    @elseif($pasien->jenis_pasien == 'caten')
                        <a href="{{ route('caten-dental-checkups.create.withPasien', $pasien->id) }}"
                        class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg shadow hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            + Tambah Pemeriksaan
                        </a>
                    @elseif($pasien->jenis_pasien == 'anak_sekolah')
                        <a href="{{ route('school-child-dental-checkups.create.withPasien', $pasien->id) }}"
                        class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg shadow hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            + Tambah Pemeriksaan
                        </a>
                    @endif
                </div>

                <div class="p-6">
                    @php
                        $checkups = [];
                        if ($pasien->jenis_pasien == 'ibu_hamil') {
                            $checkups = $pasien->pregnantDentalCheckups->sortByDesc('created_at');
                        } elseif ($pasien->jenis_pasien == 'caten') {
                            $checkups = $pasien->catenDentalCheckups->sortByDesc('created_at');
                        } elseif ($pasien->jenis_pasien == 'anak_sekolah') {
                            $checkups = $pasien->schoolChildDentalCheckups->sortByDesc('created_at');
                        }
                    @endphp

                    @if(count($checkups) > 0)
                        <div class="space-y-4">
                            @foreach($checkups as $index => $checkup)
                            <div class="bg-gradient-to-r from-gray-50 to-white border border-gray-200 rounded-lg hover:shadow-md transition-shadow duration-200">
                                <div class="p-5">
                                    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-start gap-4">
                                        <!-- Left Side - Checkup Info -->
                                        <div class="flex-1">
                                            <div class="flex items-center gap-3 mb-3">
                                                <div class="flex-shrink-0">
                                                    <div class="bg-blue-100 p-2 rounded-lg">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                        </svg>
                                                    </div>
                                                </div>
                                                <div>
                                                    <h3 class="text-lg font-semibold text-gray-900">
                                                        Pemeriksaan #{{ $index + 1 }}
                                                    </h3>
                                                    <div class="flex items-center gap-2 text-sm text-gray-600 mt-1">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                        </svg>
                                                        {{ \Carbon\Carbon::parse($checkup->created_at)->translatedFormat('d F Y') }}
                                                        <span class="text-gray-400">•</span>
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                        </svg>
                                                        {{ \Carbon\Carbon::parse($checkup->created_at)->translatedFormat('H:i') }}
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Patient Type Badge -->
                                            <div class="mb-4">
                                                @php
                                                    $badgeClasses = [
                                                        'ibu_hamil'    => 'bg-pink-100 text-pink-800',
                                                        'anak_sekolah' => 'bg-blue-100 text-blue-800',
                                                        'caten'        => 'bg-purple-100 text-purple-800',
                                                    ];
                                                @endphp

                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium {{ $badgeClasses[$pasien->jenis_pasien] ?? 'bg-gray-100 text-gray-800' }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                                                    </svg>
                                                    {{ $pasien->jenis_pasien == 'caten' ? 'CATEN' : ucfirst(str_replace('_', ' ', $pasien->jenis_pasien)) }}
                                                </span>
                                            </div>
                                        </div>

                                        <!-- Right Side - Action Button -->
                                        <div class="flex-shrink-0">
                                            @if($pasien->jenis_pasien == 'ibu_hamil')
                                                <a href="{{ route('pregnant-dental-checkups.show', $checkup->id) }}"
                                                   class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg shadow-sm hover:shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                    </svg>
                                                    Lihat Detail
                                                </a>
                                            @elseif($pasien->jenis_pasien == 'caten')
                                                <a href="{{ route('caten-dental-checkups.show', $checkup->id) }}"
                                                   class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg shadow-sm hover:shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                    </svg>
                                                    Lihat Detail
                                                </a>
                                            @elseif($pasien->jenis_pasien == 'anak_sekolah')
                                                <a href="{{ route('school-child-dental-checkups.show', $checkup->id) }}"
                                                   class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg shadow-sm hover:shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                    </svg>
                                                    Lihat Detail
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-12">
                            <div class="flex flex-col items-center">
                                <div class="bg-gray-100 p-6 rounded-full mb-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                </div>
                                <h3 class="text-lg font-medium text-gray-900 mb-2">Belum Ada Pemeriksaan</h3>
                                <p class="text-gray-500 mb-4">Pasien ini belum memiliki riwayat pemeriksaan gigi</p>
                                <div class="text-sm text-gray-400">
                                    Klik tombol "Tambah Pemeriksaan" di atas untuk membuat pemeriksaan baru
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
