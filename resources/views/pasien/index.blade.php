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
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-lg" role="alert">
                    <div class="flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <p>{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            {{-- Info --}}
            <div class="bg-blue-50 text-blue-800 px-4 py-3 rounded-lg mb-6">
                Menampilkan <span class="font-bold">{{ $pasien->count() }}</span> dari
                <span class="font-bold">{{ number_format($pasien->total(), 0, ',', '.') }}</span> total data pasien.
            </div>

            {{-- Table --}}
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer" onclick="sortTable('nama')">
                                    <div class="flex items-center">
                                        NAMA PASIEN
                                        @if(request('sort') == 'nama')
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z" clip-rule="evenodd" />
                                            </svg>
                                        @endif
                                    </div>
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ALAMAT</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">JENIS PASIEN</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">KONTAK</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">AKSI</th>
                            </tr>
                        </thead>

                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($pasien as $p)
                                <tr class="hover:bg-gray-50 transition">
                                    {{-- Nama --}}
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div class="h-10 w-10 bg-blue-100 rounded-full flex items-center justify-center">
                                                <svg class="h-6 w-6 text-blue-600" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                                </svg>
                                            </div>
                                            <div>
                                                <div class="font-semibold text-gray-800">{{ strtoupper($p->nama) }}</div>
                                                <div class="text-xs text-gray-500 mt-1">{{ $p->umur }} tahun • NIK: {{ $p->nik }}</div>
                                            </div>
                                        </div>
                                    </td>

                                    {{-- Alamat --}}
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-gray-900">{{ $p->alamat }}</div>
                                    </td>

                                    {{-- Jenis Pasien --}}
                                    <td class="px-8 py-6 whitespace-nowrap">
                                        @php
                                            $badgeClasses = [
                                                'ibu_hamil'    => 'bg-pink-100 text-pink-800 border-pink-200',
                                                'anak_sekolah' => 'bg-blue-100 text-blue-800 border-blue-200',
                                                'caten'        => 'bg-purple-100 text-purple-800 border-purple-200',
                                            ];
                                        @endphp

                                        <span class="inline-flex px-4 py-0.5 text-xs leading-tight font-semibold rounded-full border whitespace-nowrap {{ $badgeClasses[$p->jenis_pasien] ?? 'bg-gray-100 text-gray-800 border-gray-200' }}">
                                            {{ $p->jenis_pasien == 'caten' ? 'CATEN' : ucfirst(str_replace('_', ' ', $p->jenis_pasien)) }}
                                        </span>
                                    </td>

                                    {{-- Kontak --}}
                                    <td class="px-6 py-4">
                                        <div class="text-sm">{{ $p->no_wa }}</div>
                                        <div class="text-xs text-gray-500">Orang Tua: {{ $p->nama_orang_tua ?? '-' }}</div>
                                    </td>

                                    {{-- Aksi --}}
                                    <td class="px-6 py-4 text-right text-sm">
                                        <div class="flex justify-end space-x-2">
                                            <a href="{{ route('pasien.show', $p->id) }}" class="p-2 rounded-full text-blue-600 hover:bg-blue-50" title="Lihat">
                                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                            </a>

                                            <a href="{{ route('pasien.edit', $p->id) }}" class="p-2 rounded-full text-yellow-600 hover:bg-yellow-50" title="Edit">
                                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </a>

                                            <form action="{{ route('pasien.destroy', $p->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data pasien ini?')">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="p-2 rounded-full text-red-600 hover:bg-red-50" title="Hapus">
                                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-4 text-center text-gray-500">Tidak ada data pasien yang ditemukan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Pagination --}}
            @if ($pasien->hasPages())
                <div class="mt-6">
                    {{ $pasien->appends(request()->query())->links() }}
                </div>
            @endif
        </div>
    </div>

    <script>
        // Auto-hide success message after 5 seconds
        setTimeout(() => {
            const alert = document.querySelector('[role="alert"]');
            if (alert) alert.style.display = 'none';
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
