<x-app-layout>
    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Welcome Banner -->
            <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-xl shadow-md mb-8 p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-2xl font-bold mb-2">Selamat Datang, {{ Auth::user()->name }}!</h3>
                        <p class="opacity-90">Sistem Informasi Kesehatan Gigi</p>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 opacity-80" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                </div>
            </div>

            <!-- Quick Stats -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <!-- Total Pasien -->
                <div class="bg-white rounded-xl shadow-md overflow-hidden transition-all hover:shadow-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">Total Pasien</p>
                                <p class="text-2xl font-semibold text-gray-900">{{ \App\Models\Pasien::count() }}</p>
                            </div>
                        </div>
                        <a href="{{ route('pasien.index') }}" class="mt-4 inline-flex items-center text-sm font-medium text-blue-600 hover:text-blue-700">
                            Lihat semua
                            <svg xmlns="http://www.w3.org/2000/svg" class="ml-1 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Pemeriksaan Ibu Hamil -->
                <div class="bg-white rounded-xl shadow-md overflow-hidden transition-all hover:shadow-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-pink-100 text-pink-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">Pemeriksaan Ibu Hamil</p>
                                <p class="text-2xl font-semibold text-gray-900">{{ \App\Models\PregnantDentalCheckup::count() }}</p>
                            </div>
                        </div>
                        <div class="mt-4 text-sm font-medium text-pink-600">
                            Terakhir diperbarui
                        </div>
                    </div>
                </div>

                <!-- Pemeriksaan Anak Sekolah -->
                <div class="bg-white rounded-xl shadow-md overflow-hidden transition-all hover:shadow-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-green-100 text-green-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">Pemeriksaan Anak Sekolah</p>
                                <p class="text-2xl font-semibold text-gray-900">{{ \App\Models\SchoolChildDentalCheckup::count() }}</p>
                            </div>
                        </div>
                        <div class="mt-4 text-sm font-medium text-green-600">
                            Terakhir diperbarui
                        </div>
                    </div>
                </div>

                <!-- Pemeriksaan CATEN -->
                <div class="bg-white rounded-xl shadow-md overflow-hidden transition-all hover:shadow-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-purple-100 text-purple-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">Pemeriksaan CATEN</p>
                                <p class="text-2xl font-semibold text-gray-900">{{ \App\Models\CatenDentalCheckup::count() }}</p>
                            </div>
                        </div>
                        <div class="mt-4 text-sm font-medium text-purple-600">
                            Terakhir diperbarui
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Menu Section -->
            <div class="mb-8">
                <h3 class="text-xl font-semibold text-gray-800 mb-6 pb-2 border-b border-gray-200">Menu Utama</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Data Pasien -->
                    <a href="{{ route('pasien.index') }}" class="group block bg-white rounded-xl shadow-md overflow-hidden transition-all hover:shadow-lg hover:border-blue-500 border border-transparent">
                        <div class="p-6">
                            <div class="flex items-start">
                                <div class="flex-shrink-0 p-3 bg-blue-100 rounded-lg group-hover:bg-blue-200 transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <h3 class="text-lg font-bold text-gray-900 group-hover:text-blue-600 transition-colors">Data Pasien</h3>
                                    <p class="mt-1 text-sm text-gray-500">Kelola data pasien kesehatan gigi</p>
                                    <div class="mt-3 inline-flex items-center text-sm font-medium text-blue-600">
                                        Akses modul
                                        <svg xmlns="http://www.w3.org/2000/svg" class="ml-1 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>

                    <!-- Tambah Pasien Baru -->
                    <a href="{{ route('pasien.create') }}" class="group block bg-white rounded-xl shadow-md overflow-hidden transition-all hover:shadow-lg hover:border-green-500 border border-transparent">
                        <div class="p-6">
                            <div class="flex items-start">
                                <div class="flex-shrink-0 p-3 bg-green-100 rounded-lg group-hover:bg-green-200 transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <h3 class="text-lg font-bold text-gray-900 group-hover:text-green-600 transition-colors">Tambah Pasien Baru</h3>
                                    <p class="mt-1 text-sm text-gray-500">Input data pasien baru ke sistem</p>
                                    <div class="mt-3 inline-flex items-center text-sm font-medium text-green-600">
                                        Buat entri baru
                                        <svg xmlns="http://www.w3.org/2000/svg" class="ml-1 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>

                    <!-- Pemeriksaan Ibu Hamil -->
                    <a href="#" class="group block bg-white rounded-xl shadow-md overflow-hidden transition-all hover:shadow-lg hover:border-pink-500 border border-transparent">
                        <div class="p-6">
                            <div class="flex items-start">
                                <div class="flex-shrink-0 p-3 bg-pink-100 rounded-lg group-hover:bg-pink-200 transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-pink-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <h3 class="text-lg font-bold text-gray-900 group-hover:text-pink-600 transition-colors">Pemeriksaan Ibu Hamil</h3>
                                    <p class="mt-1 text-sm text-gray-500">Data pemeriksaan kesehatan gigi ibu hamil</p>
                                    <div class="mt-3 inline-flex items-center text-sm font-medium text-pink-600">
                                        Lihat pemeriksaan
                                        <svg xmlns="http://www.w3.org/2000/svg" class="ml-1 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Recent Activity Section -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Pasien Terbaru -->
                <div class="bg-white rounded-xl shadow-md overflow-hidden">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-xl font-semibold text-gray-800">Pasien Terbaru</h3>
                            <a href="{{ route('pasien.index') }}" class="inline-flex items-center text-sm font-medium text-blue-600 hover:text-blue-700">
                                Lihat semua
                                <svg xmlns="http://www.w3.org/2000/svg" class="ml-1 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>

                        <div class="space-y-4">
                            @forelse(\App\Models\Pasien::latest()->take(5)->get() as $pasien)
                            <div class="flex items-start p-3 hover:bg-gray-50 rounded-lg transition-colors">
                                <div class="flex-shrink-0 p-2 bg-blue-100 rounded-lg text-blue-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                <div class="ml-3 flex-1">
                                    <div class="flex items-center justify-between">
                                        <h4 class="text-sm font-medium text-gray-900">{{ $pasien->nama }}</h4>
                                        <span class="text-xs text-gray-500">{{ $pasien->created_at->diffForHumans() }}</span>
                                    </div>
                                    <p class="text-xs text-gray-500 mt-1">
                                        {{ \Carbon\Carbon::parse($pasien->tanggal_lahir)->age }} tahun •
                                        {{ ucfirst($pasien->jenis_pasien) }}
                                    </p>
                                </div>
                            </div>
                            @empty
                            <div class="text-center text-gray-500 py-4">
                                Tidak ada data pasien
                            </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- Pemeriksaan Ibu Hamil Terbaru -->
                <div class="bg-white rounded-xl shadow-md overflow-hidden">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-xl font-semibold text-gray-800">Pemeriksaan Terbaru</h3>
                            <a href="#" class="inline-flex items-center text-sm font-medium text-pink-600 hover:text-pink-700">
                                Lihat semua
                                <svg xmlns="http://www.w3.org/2000/svg" class="ml-1 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>

                        <div class="space-y-4">
                            @forelse(\App\Models\PregnantDentalCheckup::with('pasien')->latest()->take(5)->get() as $pemeriksaan)
                            <div class="flex items-start p-3 hover:bg-gray-50 rounded-lg transition-colors">
                                <div class="flex-shrink-0 p-2 bg-pink-100 rounded-lg text-pink-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div class="ml-3 flex-1">
                                    <div class="flex items-center justify-between">
                                        <h4 class="text-sm font-medium text-gray-900">
                                            {{ $pemeriksaan->pasien->nama ?? 'Pasien Tidak Ditemukan' }}
                                        </h4>
                                        <span class="text-xs text-gray-500">{{ $pemeriksaan->created_at->diffForHumans() }}</span>
                                    </div>
                                    <p class="text-xs text-gray-500 mt-1">
                                        @if($pemeriksaan->pasien)
                                            {{ \Carbon\Carbon::parse($pemeriksaan->pasien->tanggal_lahir)->age }} tahun •
                                            {{ $pemeriksaan->pasien->alamat }}
                                        @endif
                                    </p>
                                </div>
                            </div>
                            @empty
                            <div class="text-center text-gray-500 py-4">
                                Tidak ada data pemeriksaan
                            </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
