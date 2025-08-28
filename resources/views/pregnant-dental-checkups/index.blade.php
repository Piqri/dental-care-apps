<x-app-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Page Header --}}
            <x-page-header
                title="DATA PEMERIKSAAN GIGI IBU HAMIL"
                subtitle="Manajemen data pemeriksaan gigi pasien ibu hamil"
                :search="[
                    'action' => route('pregnant-dental-checkups.index'),
                    'name' => 'search',
                    'placeholder' => 'Cari pasien...'
                ]"
                :button="[
                    'label' => 'Pemeriksaan Baru',
                    'url' => route('pregnant-dental-checkups.create'),
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
                Menampilkan <span class="font-bold">{{ $checkups->count() }}</span> dari
                <span class="font-bold">{{ number_format($checkups->total(), 0, ',', '.') }}</span> total data pemeriksaan.
            </div>

            {{-- Table --}}
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    NAMA PASIEN
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">KONDISI GIGI</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">KELUHAN</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">TANGGAL PEMERIKSAAN</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">AKSI</th>
                            </tr>
                        </thead>

                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($checkups as $checkup)
                                <tr class="hover:bg-gray-50 transition">
                                    {{-- Nama Pasien --}}
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div class="h-10 w-10 bg-pink-100 rounded-full flex items-center justify-center">
                                                <svg class="h-6 w-6 text-pink-600" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                                </svg>
                                            </div>
                                            <div>
                                                <div class="font-semibold text-gray-800">{{ strtoupper($checkup->pasien->nama) }}</div>
                                                <div class="text-xs text-gray-500 mt-1">{{ $checkup->pasien->umur }} tahun • NIK: {{ $checkup->pasien->nik }}</div>
                                            </div>
                                        </div>
                                    </td>

                                    {{-- Kondisi Gigi --}}
                                    <td class="px-6 py-4">
                                        <div class="flex flex-wrap gap-1">
                                            @if($checkup->kondisi_karies)
                                                <span class="px-2 py-0.5 text-xs bg-yellow-100 text-yellow-800 rounded-full">Karies</span>
                                            @endif
                                            @if($checkup->kondisi_karang_gigi)
                                                <span class="px-2 py-0.5 text-xs bg-orange-100 text-orange-800 rounded-full">Karang Gigi</span>
                                            @endif
                                            @if($checkup->kondisi_gusi_bengkak)
                                                <span class="px-2 py-0.5 text-xs bg-red-100 text-red-800 rounded-full">Gusi Bengkak</span>
                                            @endif
                                            @if($checkup->kondisi_pendarahan)
                                                <span class="px-2 py-0.5 text-xs bg-pink-100 text-pink-800 rounded-full">Pendarahan</span>
                                            @endif
                                        </div>
                                    </td>

                                    {{-- Keluhan --}}
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-gray-900 line-clamp-2">
                                            @php
                                                $keluhan = [];
                                                if($checkup->gigi_berdarah) $keluhan[] = 'Gigi Berdarah';
                                                if($checkup->gusi_bengkak) $keluhan[] = 'Gusi Bengkak';
                                                if($checkup->gigi_goyang) $keluhan[] = 'Gigi Goyang';
                                                if($checkup->gusi_sakit) $keluhan[] = 'Gusi Sakit';
                                                if($checkup->gigi_sakit) $keluhan[] = 'Gigi Sakit';
                                            @endphp
                                            {{ implode(', ', $keluhan) }}
                                            @if($checkup->keluhan_lain)
                                                , {{ $checkup->keluhan_lain }}
                                            @endif
                                        </div>
                                    </td>

                                    {{-- Tanggal Pemeriksaan --}}
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">
                                            {{ $checkup->created_at->format('d M Y') }}
                                        </div>
                                        <div class="text-xs text-gray-500">
                                            {{ $checkup->created_at->format('H:i') }}
                                        </div>
                                    </td>

                                    {{-- Aksi --}}
                                    <td class="px-6 py-4 text-right text-sm">
                                        <div class="flex justify-end space-x-2">
                                            <a href="{{ route('pregnant-dental-checkups.show', $checkup->id) }}" class="p-2 rounded-full text-blue-600 hover:bg-blue-50" title="Lihat">
                                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                            </a>

                                            <a href="{{ route('pregnant-dental-checkups.edit', $checkup->id) }}" class="p-2 rounded-full text-yellow-600 hover:bg-yellow-50" title="Edit">
                                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </a>

                                            <form action="{{ route('pregnant-dental-checkups.destroy', $checkup->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data pemeriksaan ini?')">
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
                                    <td colspan="5" class="px-6 py-4 text-center text-gray-500">Tidak ada data pemeriksaan yang ditemukan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Pagination --}}
            @if ($checkups->hasPages())
                <div class="mt-6">
                    {{ $checkups->appends(request()->query())->links() }}
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
    </script>
</x-app-layout>
