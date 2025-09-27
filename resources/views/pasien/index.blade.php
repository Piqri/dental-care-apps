<x-app-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Page Header --}}
            <x-page-header
                title="DATA PASIEN"
                subtitle="Manajemen data pasien"
                :search="[
                    'action' => route('pasien.index'),
                    'name' => 'search',
                    'placeholder' => 'Cari pasien...'
                ]"
                :button="[
                    'label' => 'Pasien Baru',
                    'url' => route('pasien.create'),
                    'icon' => '<svg xmlns=\'http://www.w3.org/2000/svg\' class=\'h-5 w-5 mr-2\' fill=\'none\' viewBox=\'0 0 24 24\' stroke=\'currentColor\'><path stroke-linecap=\'round\' stroke-linejoin=\'round\' stroke-width=\'2\' d=\'M12 6v6m0 0v6m0-6h6m-6 0H6\' /></svg>'
                ]"
            />

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

            {{-- Statistics Cards --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                <div class="bg-gradient-to-r from-blue-50 to-blue-100 border border-blue-200 rounded-xl p-6 shadow-sm">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-blue-600">Total Pasien</p>
                            <p class="text-3xl font-bold text-blue-700 mt-2">{{ number_format($pasien->total(), 0, ',', '.') }}</p>
                            <p class="text-xs text-blue-500 mt-1">Data keseluruhan</p>
                        </div>
                        <div class="h-14 w-14 bg-blue-100 rounded-full flex items-center justify-center">
                            <svg class="h-7 w-7 text-blue-600" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-r from-pink-50 to-pink-100 border border-pink-200 rounded-xl p-6 shadow-sm">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-pink-600">Ibu Hamil</p>
                            @php
                                $totalPasien = collect($pasien->items());
                                $ibuHamilCount = $totalPasien->where('jenis_pasien', 'ibu_hamil')->count();
                            @endphp
                            <p class="text-3xl font-bold text-pink-700 mt-2">{{ $ibuHamilCount }}</p>
                            <p class="text-xs text-pink-500 mt-1">Pasien ibu hamil</p>
                        </div>
                        <div class="h-14 w-14 bg-pink-100 rounded-full flex items-center justify-center">
                            <svg class="h-7 w-7 text-pink-600" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-r from-indigo-50 to-indigo-100 border border-indigo-200 rounded-xl p-6 shadow-sm">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-indigo-600">Anak Sekolah</p>
                            @php
                                $anakSekolahCount = $totalPasien->where('jenis_pasien', 'anak_sekolah')->count();
                            @endphp
                            <p class="text-3xl font-bold text-indigo-700 mt-2">{{ $anakSekolahCount }}</p>
                            <p class="text-xs text-indigo-500 mt-1">Pasien anak sekolah</p>
                        </div>
                        <div class="h-14 w-14 bg-indigo-100 rounded-full flex items-center justify-center">
                            <svg class="h-7 w-7 text-indigo-600" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-r from-purple-50 to-purple-100 border border-purple-200 rounded-xl p-6 shadow-sm">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-purple-600">CATEN</p>
                            @php
                                $catenCount = $totalPasien->where('jenis_pasien', 'caten')->count();
                            @endphp
                            <p class="text-3xl font-bold text-purple-700 mt-2">{{ $catenCount }}</p>
                            <p class="text-xs text-purple-500 mt-1">Calon pengantin</p>
                        </div>
                        <div class="h-14 w-14 bg-purple-100 rounded-full flex items-center justify-center">
                            <svg class="h-7 w-7 text-purple-600" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Table Container --}}
            <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-200">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider cursor-pointer" onclick="sortTable('nama')">
                                    <div class="flex items-center gap-2">
                                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                        NAMA PASIEN
                                        @if(request('sort') == 'nama')
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z" clip-rule="evenodd" />
                                            </svg>
                                        @endif
                                    </div>
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">
                                    ALAMAT & KONTAK
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">
                                    JENIS PASIEN
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">
                                    INFORMASI TAMBAHAN
                                </th>
                                <th class="px-6 py-4 text-right text-xs font-semibold text-gray-600 uppercase">
                                    AKSI
                                </th>
                            </tr>
                        </thead>

                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($pasien as $p)
                                <tr class="hover:bg-gray-50 transition-colors duration-150">
                                    {{-- Nama Pasien --}}
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            @php
                                                $avatarColors = [
                                                    'ibu_hamil'    => 'from-pink-100 to-pink-200 text-pink-600',
                                                    'anak_sekolah' => 'from-blue-100 to-blue-200 text-blue-600',
                                                    'caten'        => 'from-purple-100 to-purple-200 text-purple-600',
                                                ];
                                            @endphp
                                            <div class="h-10 w-10 bg-gradient-to-br {{ $avatarColors[$p->jenis_pasien] ?? 'from-gray-100 to-gray-200 text-gray-600' }} rounded-full flex items-center justify-center shadow-sm">
                                                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                                </svg>
                                            </div>
                                            <div>
                                                <div class="font-semibold text-gray-800">{{ strtoupper($p->nama) }}</div>
                                                <div class="text-xs text-gray-500 mt-1 flex items-center gap-2">
                                                    <span>{{ $p->umur }} tahun</span>
                                                    @if($p->nik)
                                                        <span>•</span>
                                                        <span>NIK: {{ $p->nik }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                    {{-- Alamat & Kontak --}}
                                    <td class="px-6 py-4">
                                        <div class="max-w-[200px]">
                                            <div class="flex items-start gap-2 mb-2">
                                                <svg class="h-4 w-4 text-gray-400 mt-0.5 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                                </svg>
                                                <div class="text-sm text-gray-900">{{ $p->alamat }}</div>
                                            </div>
                                            @if($p->no_wa)
                                                <div class="flex items-center gap-2">
                                                    <svg class="h-4 w-4 text-green-500 flex-shrink-0" viewBox="0 0 24 24" fill="currentColor">
                                                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.570-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.890-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.309"/>
                                                    </svg>
                                                    <span class="text-sm text-gray-700">{{ $p->no_wa }}</span>
                                                </div>
                                            @endif
                                        </div>
                                    </td>

                                    {{-- Jenis Pasien --}}
                                    <td class="px-6 py-4">
                                        @php
                                            $badgeClasses = [
                                                'ibu_hamil'    => 'bg-pink-100 text-pink-800 border-pink-200',
                                                'anak_sekolah' => 'bg-blue-100 text-blue-800 border-blue-200',
                                                'caten'        => 'bg-purple-100 text-purple-800 border-purple-200',
                                            ];

                                            $badgeIcons = [
                                                'ibu_hamil'    => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />',
                                                'anak_sekolah' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />',
                                                'caten'        => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />'
                                            ];
                                        @endphp

                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium border {{ $badgeClasses[$p->jenis_pasien] ?? 'bg-gray-100 text-gray-800 border-gray-200' }}">
                                            <svg class="h-3 w-3 mr-1.5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                                {!! $badgeIcons[$p->jenis_pasien] ?? '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />' !!}
                                            </svg>
                                            {{ $p->jenis_pasien == 'caten' ? 'CATEN' : ucfirst(str_replace('_', ' ', $p->jenis_pasien)) }}
                                        </span>
                                    </td>

                                    {{-- Informasi Tambahan --}}
                                    <td class="px-6 py-4">
                                        <div class="space-y-1">
                                            @if($p->nama_orang_tua)
                                                <div class="flex items-center gap-2">
                                                    <svg class="h-4 w-4 text-gray-400 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z" />
                                                    </svg>
                                                    <span class="text-sm text-gray-600">{{ $p->nama_orang_tua }}</span>
                                                </div>
                                            @endif
                                            @if($p->jenis_pasien == 'ibu_hamil' && isset($p->trimester))
                                                <div class="flex items-center gap-2">
                                                    <svg class="h-4 w-4 text-pink-400 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                    <span class="text-sm text-pink-600">Trimester {{ $p->trimester }}</span>
                                                </div>
                                            @endif
                                            @if(!$p->nama_orang_tua && (!isset($p->trimester) || $p->jenis_pasien != 'ibu_hamil'))
                                                <span class="text-sm text-gray-400 italic">-</span>
                                            @endif
                                        </div>
                                    </td>

                                    {{-- Aksi --}}
                                    <td class="px-6 py-4 text-right">
                                        <div class="flex justify-end items-center space-x-2">
                                            {{-- View Button --}}
                                            <a href="{{ route('pasien.show', $p->id) }}"
                                               class="inline-flex items-center p-2 bg-blue-50 text-blue-700 rounded-lg hover:bg-blue-100 transition-colors duration-200"
                                               title="Lihat Detail">
                                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                            </a>

                                            {{-- Edit Button --}}
                                            <a href="{{ route('pasien.edit', $p->id) }}"
                                               class="inline-flex items-center p-2 bg-yellow-50 text-yellow-700 rounded-lg hover:bg-yellow-100 transition-colors duration-200"
                                               title="Edit Data">
                                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </a>

                                            {{-- Delete Button --}}
                                            <form action="{{ route('pasien.destroy', $p->id) }}" method="POST"
                                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus data pasien ini?')"
                                                  class="inline">
                                                @csrf @method('DELETE')
                                                <button type="submit"
                                                        class="inline-flex items-center p-2 bg-red-50 text-red-700 rounded-lg hover:bg-red-100 transition-colors duration-200"
                                                        title="Hapus Data">
                                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-8 text-center">
                                        <div class="flex flex-col items-center justify-center text-gray-400">
                                            <svg class="h-16 w-16 mb-4" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                            </svg>
                                            <p class="text-lg font-medium text-gray-500">Tidak ada data pasien</p>
                                            <p class="text-sm text-gray-400 mt-1">Mulai dengan menambahkan pasien baru</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Pagination --}}
            @if ($pasien->hasPages())
                <div class="mt-6 bg-white rounded-lg shadow-sm border border-gray-200 p-4">
                    {{ $pasien->appends(request()->query())->links() }}
                </div>
            @endif
        </div>
    </div>

    <script>
        // Auto-hide success message after 5 seconds
        setTimeout(() => {
            const alert = document.querySelector('[role="alert"]');
            if (alert) {
                alert.style.opacity = '0';
                alert.style.transition = 'opacity 0.5s ease';
                setTimeout(() => alert.remove(), 500);
            }
        }, 5000);

        // Sorting function
        function sortTable(column) {
            const url = new URL(window.location.href);
            const searchParams = url.searchParams;

            if (searchParams.get('sort') === column) {
                searchParams.set('direction', searchParams.get('direction') === 'asc' ? 'desc' : 'asc');
            } else {
                searchParams.set('sort', column);
                searchParams.set('direction', 'asc');
            }

            window.location.href = url.toString();
        }
    </script>
</x-app-layout>
