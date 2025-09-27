<x-app-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Header Section -->
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
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

            {{-- Success Message --}}
            @if (session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-lg shadow-sm" role="alert">
                    <div class="flex items-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <p class="font-medium">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            {{-- Patient Profile Card --}}
            <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-200 mb-6">
                {{-- Header dengan nama pasien --}}
                <div class="bg-gradient-to-r from-blue-50 to-blue-100 border-b border-blue-200 px-6 py-4">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-4">
                            @php
                                $avatarColors = [
                                    'ibu_hamil'    => 'bg-pink-100 text-pink-600',
                                    'anak_sekolah' => 'bg-blue-100 text-blue-600',
                                    'caten'        => 'bg-purple-100 text-purple-600',
                                ];
                            @endphp
                            <div class="h-12 w-12 {{ $avatarColors[$pasien->jenis_pasien] ?? 'bg-gray-100 text-gray-600' }} rounded-full flex items-center justify-center shadow-sm">
                                <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <div>
                                <h1 class="text-2xl font-bold text-gray-900">{{ strtoupper($pasien->nama) }}</h1>
                                <div class="flex items-center gap-4 mt-1">
                                    <span class="text-sm text-gray-700 flex items-center gap-1">
                                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        {{ \Carbon\Carbon::parse($pasien->tanggal_lahir)->age }} tahun
                                    </span>
                                    <span class="text-sm text-gray-700 flex items-center gap-1">
                                        <svg class="h-4 w-4 text-green-500" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.570-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.890-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.309"/>
                                        </svg>
                                        {{ $pasien->no_wa }}
                                    </span>
                                    @php
                                        $badgeClasses = [
                                            'ibu_hamil'    => 'bg-pink-100 text-pink-800 border-pink-200',
                                            'anak_sekolah' => 'bg-blue-100 text-blue-800 border-blue-200',
                                            'caten'        => 'bg-purple-100 text-purple-800 border-purple-200',
                                        ];
                                    @endphp
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium border {{ $badgeClasses[$pasien->jenis_pasien] ?? 'bg-gray-100 text-gray-800 border-gray-200' }}">
                                        {{ $pasien->jenis_pasien == 'caten' ? 'CATEN' : ucfirst(str_replace('_', ' ', $pasien->jenis_pasien)) }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Patient Details --}}
                <div class="p-6">
                    {{-- Informasi Umum Section --}}
                    <div class="mb-8">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4 border-b border-gray-200 pb-2">Informasi Umum</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-4">
                                <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                    <span class="text-sm font-medium text-gray-600">Jenis Kelamin</span>
                                    <span class="text-sm text-gray-800 font-semibold">{{ $pasien->jenis_kelamin }}</span>
                                </div>
                                <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                    <span class="text-sm font-medium text-gray-600">Tanggal Lahir</span>
                                    <span class="text-sm text-gray-800 font-semibold">
                                        {{ $pasien->tempat_lahir }}, {{ \Carbon\Carbon::parse($pasien->tanggal_lahir)->translatedFormat('d F Y') }}
                                    </span>
                                </div>
                            </div>
                            <div class="space-y-4">
                                @if($pasien->jenis_pasien == 'anak_sekolah')
                                    <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                        <span class="text-sm font-medium text-gray-600">Nama Orang Tua</span>
                                        <span class="text-sm text-gray-800 font-semibold">{{ $pasien->nama_orang_tua ?: '-' }}</span>
                                    </div>
                                @endif
                                <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                    <span class="text-sm font-medium text-gray-600">Tanggal Didaftarkan</span>
                                    <span class="text-sm text-gray-800 font-semibold">
                                        {{ \Carbon\Carbon::parse($pasien->created_at)->translatedFormat('d F Y') }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Informasi Tambahan Berdasarkan Jenis Pasien --}}
                    @if($pasien->jenis_pasien == 'ibu_hamil' || $pasien->jenis_pasien == 'caten')
                    <div class="mb-8">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4 border-b border-gray-200 pb-2">Informasi Identitas</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-4">
                                <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                    <span class="text-sm font-medium text-gray-600">NIK</span>
                                    <span class="text-sm text-gray-800 font-semibold">{{ $pasien->nik ?: '-' }}</span>
                                </div>
                                @if($pasien->jenis_pasien == 'ibu_hamil' && isset($pasien->trimester))
                                <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                    <span class="text-sm font-medium text-gray-600">Trimester</span>
                                    <span class="text-sm text-gray-800 font-semibold">{{ $pasien->trimester }}</span>
                                </div>
                                @endif
                            </div>
                            <div class="space-y-4">
                                {{-- Additional fields can be added here --}}
                            </div>
                        </div>
                    </div>
                    @endif

                    {{-- Alamat Section --}}
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800 mb-4 border-b border-gray-200 pb-2">Alamat</h3>
                        <div class="bg-gray-50 rounded-lg p-4">
                            <p class="text-gray-800">{{ $pasien->alamat }}</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Dental Checkups Section --}}
            <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-200">
                <div class="bg-gradient-to-r from-gray-50 to-gray-100 border-b border-gray-200 px-6 py-4 flex justify-between items-center">
                    <div>
                        <h2 class="text-xl font-bold text-gray-800">Riwayat Pemeriksaan Gigi</h2>
                        <p class="text-sm text-gray-600 mt-1">Daftar pemeriksaan gigi yang telah dilakukan</p>
                    </div>

                    @if($pasien->jenis_pasien == 'ibu_hamil')
                        <a href="{{ route('pregnant-dental-checkups.create.withPasien', $pasien->id) }}"
                           class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg shadow hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            Tambah Pemeriksaan
                        </a>
                    @elseif($pasien->jenis_pasien == 'caten')
                        <a href="{{ route('caten-dental-checkups.create.withPasien', $pasien->id) }}"
                           class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg shadow hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            Tambah Pemeriksaan
                        </a>
                    @elseif($pasien->jenis_pasien == 'anak_sekolah')
                        <a href="{{ route('school-child-dental-checkups.create.withPasien', $pasien->id) }}"
                           class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg shadow hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            Tambah Pemeriksaan
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
                                            {{-- Left Side - Checkup Info --}}
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
                                            </div>

                                            {{-- Right Side - Action Button --}}
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
