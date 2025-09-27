<x-app-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Welcome Banner --}}
            <div class="bg-gradient-to-r from-blue-600 to-blue-700 rounded-xl shadow-lg mb-6 p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-bold mb-2">Selamat Datang, {{ Auth::user()->name }}!</h1>
                        <p class="text-blue-100 text-lg">Sistem Informasi Kesehatan Gigi</p>
                        <p class="text-blue-200 text-sm mt-1">{{ now()->format('l, d F Y') }}</p>
                    </div>
                    <div class="hidden md:block">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-blue-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                </div>
            </div>

            {{-- FILTER (bulan, tahun, jenis) --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden mb-6">
                <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                    <div class="flex items-center">
                        <svg class="h-5 w-5 text-gray-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.207A1 1 0 013 6.5V4z" />
                        </svg>
                        <h3 class="text-lg font-semibold text-gray-800">Filter Data</h3>
                    </div>
                </div>

                <div class="p-6">
                    <form method="GET" action="{{ route('dashboard') }}" class="space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-4">
                            <!-- Filter Bulan -->
                            <div class="space-y-2">
                                <label class="block text-sm font-medium text-gray-700">
                                    <svg class="inline h-4 w-4 mr-1 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    Bulan
                                </label>
                                <select name="month" class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200">
                                    <option value="">Semua Bulan</option>
                                    @for ($m = 1; $m <= 12; $m++)
                                        <option value="{{ $m }}" {{ (string)$selectedMonth === (string)$m ? 'selected' : '' }}>
                                            {{ \Carbon\Carbon::create()->month((int)$m)->locale('id')->translatedFormat('F') }}
                                        </option>
                                    @endfor
                                </select>
                            </div>

                            <!-- Filter Tahun -->
                            <div class="space-y-2">
                                <label class="block text-sm font-medium text-gray-700">
                                    <svg class="inline h-4 w-4 mr-1 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    Tahun
                                </label>
                                <select name="year" class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200">
                                    <option value="">Semua Tahun</option>
                                    @for ($y = date('Y'); $y >= date('Y') - 5; $y--)
                                        <option value="{{ $y }}" {{ (string)$selectedYear === (string)$y ? 'selected' : '' }}>{{ $y }}</option>
                                    @endfor
                                </select>
                            </div>

                            <!-- Filter Jenis Pasien -->
                            <div class="space-y-2">
                                <label class="block text-sm font-medium text-gray-700">
                                    <svg class="inline h-4 w-4 mr-1 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                    Jenis Pasien
                                </label>
                                <select name="jenis" class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200">
                                    <option value="">Semua Jenis</option>
                                    <option value="ibu_hamil" {{ $selectedJenis === 'ibu_hamil' ? 'selected' : '' }}>
                                        🤱 Ibu Hamil
                                    </option>
                                    <option value="anak_sekolah" {{ $selectedJenis === 'anak_sekolah' ? 'selected' : '' }}>
                                        🎓 Anak Sekolah
                                    </option>
                                    <option value="caten" {{ $selectedJenis === 'caten' ? 'selected' : '' }}>
                                        💍 CATEN
                                    </option>
                                </select>
                            </div>

                            <!-- Tombol Action -->
                            <div class="space-y-2">
                                <label class="block text-sm font-medium text-transparent">Action</label>
                                <div class="flex flex-col sm:flex-row gap-2">
                                    <button type="submit" class="flex-1 inline-flex items-center justify-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg shadow-sm transition-colors duration-200 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                        <svg class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.207A1 1 0 013 6.5V4z" />
                                        </svg>
                                        Filter
                                    </button>
                                    <a href="{{ route('dashboard') }}" class="flex-1 inline-flex items-center justify-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-lg shadow-sm transition-colors duration-200">
                                        <svg class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                        </svg>
                                        Reset
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Filter Status Info -->
                        @if($selectedMonth || $selectedYear || $selectedJenis)
                        <div class="mt-4 p-3 bg-blue-50 border border-blue-200 rounded-lg">
                            <div class="flex items-start">
                                <svg class="h-5 w-5 text-blue-500 mt-0.5 mr-2 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <div class="flex-1">
                                    <p class="text-sm font-medium text-blue-800">Filter Aktif:</p>
                                    <div class="mt-1 flex flex-wrap gap-2">
                                        @if($selectedMonth)
                                            <span class="inline-flex items-center px-2 py-1 text-xs font-medium bg-blue-100 text-blue-800 rounded-full">
                                                Bulan: {{ \Carbon\Carbon::create()->month((int)$selectedMonth)->locale('id')->translatedFormat('F') }}
                                            </span>
                                        @endif
                                        @if($selectedYear)
                                            <span class="inline-flex items-center px-2 py-1 text-xs font-medium bg-blue-100 text-blue-800 rounded-full">
                                                Tahun: {{ $selectedYear }}
                                            </span>
                                        @endif
                                        @if($selectedJenis)
                                            <span class="inline-flex items-center px-2 py-1 text-xs font-medium bg-blue-100 text-blue-800 rounded-full">
                                                Jenis:
                                                @if($selectedJenis === 'ibu_hamil') Ibu Hamil
                                                @elseif($selectedJenis === 'anak_sekolah') Anak Sekolah
                                                @elseif($selectedJenis === 'caten') CATEN
                                                @endif
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    </form>
                </div>
            </div>

            {{-- Statistics Cards --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                {{-- Total Pasien --}}
                <div class="bg-gradient-to-r from-blue-50 to-blue-100 border border-blue-200 rounded-xl p-6 shadow-sm">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-blue-600">Total Pasien</p>
                            <p class="text-3xl font-bold text-blue-700 mt-2">{{ number_format($totalPasien ?? 0, 0, ',', '.') }}</p>
                            <p class="text-xs text-blue-500 mt-1">Semua jenis pasien</p>
                        </div>
                        <div class="h-14 w-14 bg-blue-100 rounded-full flex items-center justify-center">
                            <svg class="h-7 w-7 text-blue-600" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                    </div>
                    <div class="mt-4 pt-4 border-t border-blue-150">
                        <a href="{{ route('pasien.index') }}" class="inline-flex items-center text-sm font-medium text-blue-700 hover:text-blue-800">
                            Lihat semua
                            <svg class="ml-1 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                </div>

                {{-- Pemeriksaan Ibu Hamil --}}
                <div class="bg-gradient-to-r from-pink-50 to-pink-100 border border-pink-200 rounded-xl p-6 shadow-sm">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-pink-600">Ibu Hamil</p>
                            <p class="text-3xl font-bold text-pink-700 mt-2">{{ number_format($ibuHamilCount ?? 0, 0, ',', '.') }}</p>
                            <p class="text-xs text-pink-500 mt-1">Pemeriksaan</p>
                        </div>
                        <div class="h-14 w-14 bg-pink-100 rounded-full flex items-center justify-center">
                            <svg class="h-7 w-7 text-pink-600" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                            </svg>
                        </div>
                    </div>
                    <div class="mt-4 pt-4 border-t border-pink-150">
                        <a href="{{ route('pregnant-dental-checkups.index') }}" class="inline-flex items-center text-sm font-medium text-pink-700 hover:text-pink-800">
                            Lihat semua
                            <svg class="ml-1 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                </div>

                {{-- Pemeriksaan Anak Sekolah --}}
                <div class="bg-gradient-to-r from-indigo-50 to-indigo-100 border border-indigo-200 rounded-xl p-6 shadow-sm">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-indigo-600">Anak Sekolah</p>
                            <p class="text-3xl font-bold text-indigo-700 mt-2">{{ number_format($anakSekolahCount ?? 0, 0, ',', '.') }}</p>
                            <p class="text-xs text-indigo-500 mt-1">Pemeriksaan</p>
                        </div>
                        <div class="h-14 w-14 bg-indigo-100 rounded-full flex items-center justify-center">
                            <svg class="h-7 w-7 text-indigo-600" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </div>
                    </div>
                    <div class="mt-4 pt-4 border-t border-indigo-150">
                        <a href="{{ route('school-child-dental-checkups.index') }}" class="inline-flex items-center text-sm font-medium text-indigo-700 hover:text-indigo-800">
                            Lihat semua
                            <svg class="ml-1 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                </div>

                {{-- Pemeriksaan CATEN --}}
                <div class="bg-gradient-to-r from-purple-50 to-purple-100 border border-purple-200 rounded-xl p-6 shadow-sm">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-purple-600">CATEN</p>
                            <p class="text-3xl font-bold text-purple-700 mt-2">{{ number_format($catenCount ?? 0, 0, ',', '.') }}</p>
                            <p class="text-xs text-purple-500 mt-1">Pemeriksaan</p>
                        </div>
                        <div class="h-14 w-14 bg-purple-100 rounded-full flex items-center justify-center">
                            <svg class="h-7 w-7 text-purple-600" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        </div>
                    </div>
                    <div class="mt-4 pt-4 border-t border-purple-150">
                        <a href="{{ route('caten-dental-checkups.index') }}" class="inline-flex items-center text-sm font-medium text-purple-700 hover:text-purple-800">
                            Lihat semua
                            <svg class="ml-1 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            {{-- Menu Utama (tidak berubah) --}}
            <div class="mb-6">
                <div class="flex items-center gap-3 mb-6">
                    <svg class="h-6 w-6 text-gray-600" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                    <h2 class="text-xl font-bold text-gray-800">Menu Utama</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    {{-- Data Pasien --}}
                    <a href="{{ route('pasien.index') }}" class="group block bg-white rounded-xl shadow-md overflow-hidden border border-gray-200 hover:shadow-lg hover:border-blue-300 transition-all duration-200">
                        <div class="p-6">
                            <div class="flex items-start">
                                <div class="flex-shrink-0 p-3 bg-blue-50 rounded-xl group-hover:bg-blue-100 transition-colors duration-200">
                                    <svg class="h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                </div>
                                <div class="ml-4 flex-1">
                                    <h3 class="text-lg font-bold text-gray-900 group-hover:text-blue-600 transition-colors duration-200">Data Pasien</h3>
                                    <p class="mt-2 text-sm text-gray-500">Kelola data pasien kesehatan gigi</p>
                                    <div class="mt-3 inline-flex items-center text-sm font-medium text-blue-600">
                                        Kelola Data
                                        <svg class="ml-1 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>

                    {{-- Pemeriksaan Ibu Hamil --}}
                    <a href="{{ route('pregnant-dental-checkups.index') }}" class="group block bg-white rounded-xl shadow-md overflow-hidden border border-gray-200 hover:shadow-lg hover:border-pink-300 transition-all duration-200">
                        <div class="p-6">
                            <div class="flex items-start">
                                <div class="flex-shrink-0 p-3 bg-pink-50 rounded-xl group-hover:bg-pink-100 transition-colors duration-200">
                                    <svg class="h-8 w-8 text-pink-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                    </svg>
                                </div>
                                <div class="ml-4 flex-1">
                                    <h3 class="text-lg font-bold text-gray-900 group-hover:text-pink-600 transition-colors duration-200">Ibu Hamil</h3>
                                    <p class="mt-2 text-sm text-gray-500">Pemeriksaan kesehatan gigi ibu hamil</p>
                                    <div class="mt-3 inline-flex items-center text-sm font-medium text-pink-600">
                                        Lihat Pemeriksaan
                                        <svg class="ml-1 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>

                    {{-- Pemeriksaan Anak Sekolah --}}
                    <a href="{{ route('school-child-dental-checkups.index') }}" class="group block bg-white rounded-xl shadow-md overflow-hidden border border-gray-200 hover:shadow-lg hover:border-indigo-300 transition-all duration-200">
                        <div class="p-6">
                            <div class="flex items-start">
                                <div class="flex-shrink-0 p-3 bg-indigo-50 rounded-xl group-hover:bg-indigo-100 transition-colors duration-200">
                                    <svg class="h-8 w-8 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                    </svg>
                                </div>
                                <div class="ml-4 flex-1">
                                    <h3 class="text-lg font-bold text-gray-900 group-hover:text-indigo-600 transition-colors duration-200">Anak Sekolah</h3>
                                    <p class="mt-2 text-sm text-gray-500">Pemeriksaan kesehatan gigi anak sekolah</p>
                                    <div class="mt-3 inline-flex items-center text-sm font-medium text-indigo-600">
                                        Lihat Pemeriksaan
                                        <svg class="ml-1 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>

                    {{-- Pemeriksaan CATEN --}}
                    <a href="{{ route('caten-dental-checkups.index') }}" class="group block bg-white rounded-xl shadow-md overflow-hidden border border-gray-200 hover:shadow-lg hover:border-purple-300 transition-all duration-200">
                        <div class="p-6">
                            <div class="flex items-start">
                                <div class="flex-shrink-0 p-3 bg-purple-50 rounded-xl group-hover:bg-purple-100 transition-colors duration-200">
                                    <svg class="h-8 w-8 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                    </svg>
                                </div>
                                <div class="ml-4 flex-1">
                                    <h3 class="text-lg font-bold text-gray-900 group-hover:text-purple-600 transition-colors duration-200">CATEN</h3>
                                    <p class="mt-2 text-sm text-gray-500">Pemeriksaan kesehatan gigi CATEN</p>
                                    <div class="mt-3 inline-flex items-center text-sm font-medium text-purple-600">
                                        Lihat Pemeriksaan
                                        <svg class="ml-1 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            {{-- Aktivitas Terbaru --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
                {{-- Pemeriksaan Ibu Hamil Terbaru --}}
                <div class="bg-white rounded-xl shadow-md border border-gray-200 overflow-hidden">
                    <div class="bg-gradient-to-r from-pink-500 to-pink-600 px-6 py-4">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-bold text-white">Ibu Hamil Terbaru</h3>
                            <svg class="h-6 w-6 text-pink-100" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                            </svg>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="space-y-4">
                            @forelse($recentIbuHamil as $pemeriksaan)
                            <div class="flex items-center p-3 hover:bg-gray-50 rounded-lg transition-colors duration-150">
                                <div class="h-10 w-10 bg-gradient-to-br from-pink-100 to-pink-200 rounded-full flex items-center justify-center flex-shrink-0">
                                    <svg class="h-5 w-5 text-pink-600" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                <div class="ml-3 flex-1 min-w-0">
                                    <div class="flex items-center justify-between">
                                        <h4 class="text-sm font-semibold text-gray-900 truncate">
                                            {{ strtoupper($pemeriksaan->pasien->nama ?? 'Pasien Tidak Ditemukan') }}
                                        </h4>
                                        <span class="text-xs text-gray-500">{{ $pemeriksaan->created_at->diffForHumans() }}</span>
                                    </div>
                                    <p class="text-xs text-gray-500 mt-1">
                                        @if($pemeriksaan->pasien)
                                            {{ $pemeriksaan->pasien->umur }} tahun • Trimester {{ $pemeriksaan->pasien->trimester ?? '-' }}
                                        @endif
                                    </p>
                                </div>
                            </div>
                            @empty
                            <div class="text-center text-gray-500 py-8">
                                <svg class="h-12 w-12 mx-auto text-gray-300 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                <p class="text-sm">Tidak ada data pemeriksaan</p>
                            </div>
                            @endforelse
                        </div>
                        @if($ibuHamilCount > 0)
                        <div class="mt-4 pt-4 border-t border-gray-100">
                            <a href="{{ route('pregnant-dental-checkups.index') }}" class="inline-flex items-center text-sm font-medium text-pink-600 hover:text-pink-700">
                                Lihat semua
                                <svg class="ml-1 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                        @endif
                    </div>
                </div>

                {{-- Pemeriksaan Anak Sekolah Terbaru --}}
                <div class="bg-white rounded-xl shadow-md border border-gray-200 overflow-hidden">
                    <div class="bg-gradient-to-r from-indigo-500 to-indigo-600 px-6 py-4">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-bold text-white">Anak Sekolah Terbaru</h3>
                            <svg class="h-6 w-6 text-indigo-100" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="space-y-4">
                            @forelse($recentAnakSekolah as $pemeriksaan)
                            <div class="flex items-center p-3 hover:bg-gray-50 rounded-lg transition-colors duration-150">
                                <div class="h-10 w-10 bg-gradient-to-br from-indigo-100 to-indigo-200 rounded-full flex items-center justify-center flex-shrink-0">
                                    <svg class="h-5 w-5 text-indigo-600" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                <div class="ml-3 flex-1 min-w-0">
                                    <div class="flex items-center justify-between">
                                        <h4 class="text-sm font-semibold text-gray-900 truncate">
                                            {{ strtoupper($pemeriksaan->pasien->nama ?? 'Pasien Tidak Ditemukan') }}
                                        </h4>
                                        <span class="text-xs text-gray-500">{{ $pemeriksaan->created_at->diffForHumans() }}</span>
                                    </div>
                                    <p class="text-xs text-gray-500 mt-1">
                                        @if($pemeriksaan->pasien)
                                            {{ $pemeriksaan->pasien->umur }} tahun • {{ $pemeriksaan->pasien->nama_sekolah ?? 'Sekolah tidak diketahui' }}
                                        @endif
                                    </p>
                                </div>
                            </div>
                            @empty
                            <div class="text-center text-gray-500 py-8">
                                <svg class="h-12 w-12 mx-auto text-gray-300 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                <p class="text-sm">Tidak ada data pemeriksaan</p>
                            </div>
                            @endforelse
                        </div>
                        @if($anakSekolahCount > 0)
                        <div class="mt-4 pt-4 border-t border-gray-100">
                            <a href="{{ route('school-child-dental-checkups.index') }}" class="inline-flex items-center text-sm font-medium text-indigo-600 hover:text-indigo-700">
                                Lihat semua
                                <svg class="ml-1 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                        @endif
                    </div>
                </div>

                {{-- Pemeriksaan CATEN Terbaru --}}
                <div class="bg-white rounded-xl shadow-md border border-gray-200 overflow-hidden">
                    <div class="bg-gradient-to-r from-purple-500 to-purple-600 px-6 py-4">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-bold text-white">CATEN Terbaru</h3>
                            <svg class="h-6 w-6 text-purple-100" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="space-y-4">
                            @forelse($recentCaten as $pemeriksaan)
                            <div class="flex items-center p-3 hover:bg-gray-50 rounded-lg transition-colors duration-150">
                                <div class="h-10 w-10 bg-gradient-to-br from-purple-100 to-purple-200 rounded-full flex items-center justify-center flex-shrink-0">
                                    <svg class="h-5 w-5 text-purple-600" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                <div class="ml-3 flex-1 min-w-0">
                                    <div class="flex items-center justify-between">
                                        <h4 class="text-sm font-semibold text-gray-900 truncate">
                                            {{ strtoupper($pemeriksaan->pasien->nama ?? 'Pasien Tidak Ditemukan') }}
                                        </h4>
                                        <span class="text-xs text-gray-500">{{ $pemeriksaan->created_at->diffForHumans() }}</span>
                                    </div>
                                    <p class="text-xs text-gray-500 mt-1">
                                        @if($pemeriksaan->pasien)
                                            {{ $pemeriksaan->pasien->umur }} tahun • Calon Pengantin
                                        @endif
                                    </p>
                                </div>
                            </div>
                            @empty
                            <div class="text-center text-gray-500 py-8">
                                <svg class="h-12 w-12 mx-auto text-gray-300 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                <p class="text-sm">Tidak ada data pemeriksaan</p>
                            </div>
                            @endforelse
                        </div>
                        @if($catenCount > 0)
                        <div class="mt-4 pt-4 border-t border-gray-100">
                            <a href="{{ route('caten-dental-checkups.index') }}" class="inline-flex items-center text-sm font-medium text-purple-600 hover:text-purple-700">
                                Lihat semua
                                <svg class="ml-1 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Pasien Terbaru --}}
            <div class="bg-white rounded-xl shadow-md border border-gray-200 overflow-hidden">
                <div class="bg-gradient-to-r from-blue-500 to-blue-600 px-6 py-4">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-bold text-white">Pasien Terbaru</h3>
                        <svg class="h-6 w-6 text-blue-100" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @forelse($recentPasien as $pasien)
                        <div class="flex items-center p-4 hover:bg-gray-50 rounded-lg transition-colors duration-150 border border-gray-100">
                            @php
                                $avatarColors = [
                                    'ibu_hamil'    => 'from-pink-100 to-pink-200 text-pink-600',
                                    'anak_sekolah' => 'from-indigo-100 to-indigo-200 text-indigo-600',
                                    'caten'        => 'from-purple-100 to-purple-200 text-purple-600',
                                ];
                            @endphp
                            <div class="h-10 w-10 bg-gradient-to-br {{ $avatarColors[$pasien->jenis_pasien] ?? 'from-gray-100 to-gray-200 text-gray-600' }} rounded-full flex items-center justify-center flex-shrink-0">
                                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <div class="ml-3 flex-1 min-w-0">
                                <div class="flex items-center justify-between">
                                    <h4 class="text-sm font-semibold text-gray-900 truncate">{{ strtoupper($pasien->nama) }}</h4>
                                    <span class="text-xs text-gray-500">{{ $pasien->created_at->diffForHumans() }}</span>
                                </div>
                                <p class="text-xs text-gray-500 mt-1">
                                    {{ $pasien->umur }} tahun •
                                    @if($pasien->jenis_pasien == 'ibu_hamil')
                                        Ibu Hamil
                                    @elseif($pasien->jenis_pasien == 'anak_sekolah')
                                        Anak Sekolah
                                    @elseif($pasien->jenis_pasien == 'caten')
                                        CATEN
                                    @else
                                        {{ ucfirst($pasien->jenis_pasien) }}
                                    @endif
                                </p>
                            </div>
                        </div>
                        @empty
                        <div class="text-center text-gray-500 py-8 col-span-full">
                            <svg class="h-12 w-12 mx-auto text-gray-300 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            <p class="text-sm">Tidak ada data pasien</p>
                        </div>
                        @endforelse
                    </div>
                    @if($totalPasien > 0)
                    <div class="mt-6 pt-4 border-t border-gray-100">
                        <a href="{{ route('pasien.index') }}" class="inline-flex items-center text-sm font-medium text-blue-600 hover:text-blue-700">
                            Lihat semua pasien
                            <svg class="ml-1 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
