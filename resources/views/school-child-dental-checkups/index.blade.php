<x-app-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Page Header --}}
            <x-page-header
                title="DATA PEMERIKSAAN GIGI ANAK SEKOLAH"
                subtitle="Manajemen data pemeriksaan gigi anak sekolah"
                :search="[
                    'action' => route('school-child-dental-checkups.index'),
                    'name' => 'search',
                    'placeholder' => 'Cari pasien...'
                ]"
                :button="[
                    'label' => 'Pemeriksaan Baru',
                    'url' => route('school-child-dental-checkups.create'),
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
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">JUMLAH GIGI</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">SARAN</th>
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
                                            <div class="h-10 w-10 bg-blue-100 rounded-full flex items-center justify-center">
                                                <svg class="h-6 w-6 text-blue-600" viewBox="0 0 24 24" fill="none" stroke="currentColor">
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
                                                <span class="px-2 py-0.5 text-xs bg-gray-100 text-gray-800 rounded-full">Karang Gigi</span>
                                            @endif
                                            @if($checkup->kondisi_gigi_goyang)
                                                <span class="px-2 py-0.5 text-xs bg-purple-100 text-purple-800 rounded-full">Gigi Goyang</span>
                                            @endif
                                            @if($checkup->kondisi_sisa_akar)
                                                <span class="px-2 py-0.5 text-xs bg-orange-100 text-orange-800 rounded-full">Sisa Akar</span>
                                            @endif
                                        </div>
                                    </td>

                                    {{-- Jumlah Gigi --}}
                                    <td class="px-6 py-4">
                                        <span class="px-2 py-1 text-xs font-medium bg-blue-100 text-blue-800 rounded-full">
                                            {{ $checkup->jumlah_gigi }}
                                        </span>
                                    </td>

                                    {{-- Saran --}}
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-gray-900">
                                            @php
                                                $saran = [];
                                                if($checkup->saran_konsultasi) $saran[] = 'Konsultasi';
                                                if($checkup->saran_kontrol_rutin) $saran[] = 'Kontrol Rutin';
                                            @endphp
                                            {{ implode(', ', $saran) }}
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
                                            <a href="{{ route('school-child-dental-checkups.show', $checkup->id) }}" class="p-2 rounded-full text-blue-600 hover:bg-blue-50" title="Lihat">
                                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                            </a>

                                            <a href="{{ route('school-child-dental-checkups.edit', $checkup->id) }}" class="p-2 rounded-full text-yellow-600 hover:bg-yellow-50" title="Edit">
                                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </a>

                                            <form action="{{ route('school-child-dental-checkups.destroy', $checkup->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data pemeriksaan ini?')">
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
                                    <td colspan="6" class="px-6 py-4 text-center text-gray-500">Tidak ada data pemeriksaan yang ditemukan.</td>
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
