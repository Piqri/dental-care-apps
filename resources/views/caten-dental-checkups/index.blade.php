<x-app-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Page Header --}}
            <x-page-header
                title="DATA PEMERIKSAAN GIGI CATEN"
                subtitle="Manajemen data pemeriksaan gigi pasien caten"
                :search="[
                    'action' => route('caten-dental-checkups.index'),
                    'name' => 'search',
                    'placeholder' => 'Cari pasien...'
                ]"
                :button="[
                    'label' => 'Pemeriksaan Baru',
                    'url' => route('caten-dental-checkups.create'),
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
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div class="bg-gradient-to-r from-blue-50 to-blue-100 border border-blue-200 rounded-xl p-6 shadow-sm">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-blue-600">Total Pemeriksaan</p>
                            <p class="text-3xl font-bold text-blue-700 mt-2">{{ number_format($checkups->total(), 0, ',', '.') }}</p>
                            <p class="text-xs text-blue-500 mt-1">Data keseluruhan</p>
                        </div>
                        <div class="h-14 w-14 bg-blue-100 rounded-full flex items-center justify-center">
                            <svg class="h-7 w-7 text-blue-600" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-r from-orange-50 to-orange-100 border border-orange-200 rounded-xl p-6 shadow-sm">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-orange-600">Kondisi Bermasalah</p>
                            <p class="text-3xl font-bold text-orange-700 mt-2">{{ $stats['problematic_conditions'] ?? 0 }}</p>
                            <p class="text-xs text-orange-500 mt-1">Memerlukan perhatian</p>
                        </div>
                        <div class="h-14 w-14 bg-orange-100 rounded-full flex items-center justify-center">
                            <svg class="h-7 w-7 text-orange-600" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
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
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    <div class="flex items-center gap-2">
                                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                        PASIEN
                                    </div>
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">
                                    KELUHAN
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">
                                    KONDISI GIGI
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">
                                    TANGGAL
                                </th>
                                <th class="px-6 py-4 text-right text-xs font-semibold text-gray-600 uppercase">
                                    AKSI
                                </th>
                            </tr>
                        </thead>

                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($checkups as $checkup)
                                <tr class="hover:bg-gray-50 transition-colors duration-150">
                                    {{-- Nama Pasien --}}
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div class="h-10 w-10 bg-gradient-to-br from-blue-100 to-blue-200 rounded-full flex items-center justify-center shadow-sm">
                                                <svg class="h-5 w-5 text-blue-600" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                                </svg>
                                            </div>
                                            <div>
                                                <div class="font-semibold text-gray-800">{{ strtoupper($checkup->pasien->nama) }}</div>
                                                <div class="text-xs text-gray-500 mt-1">{{ $checkup->pasien->umur }} tahun • NIK: {{ $checkup->pasien->nik }}</div>
                                            </div>
                                        </div>
                                    </td>

                                    {{-- Keluhan --}}
                                    <td class="px-6 py-4">
                                        <div class="max-w-[200px]">
                                            @php
                                                $keluhan = [];
                                                if($checkup->gigi_berlubang == 'Ya') $keluhan[] = 'Gigi Berlubang';
                                                if($checkup->riwayat_sakit_gigi == 'Ya') $keluhan[] = 'Riwayat Sakit Gigi';
                                                if($checkup->gusi_bengkak == 'Ya') $keluhan[] = 'Gusi Bengkak';
                                                if($checkup->sisa_akar == 'Ya') $keluhan[] = 'Sisa Akar';
                                                if($checkup->gusi_berdarah == 'Ya') $keluhan[] = 'Gusi Berdarah';
                                                if($checkup->gigi_goyang == 'Ya') $keluhan[] = 'Gigi Goyang';
                                                if($checkup->sariawan == 'Ya') $keluhan[] = 'Sariawan';
                                            @endphp
                                            
                                            @if(count($keluhan) > 0)
                                                <div class="space-y-1">
                                                    @foreach(array_slice($keluhan, 0, 3) as $item)
                                                        <span class="inline-block px-2 py-1 bg-red-50 text-red-700 rounded text-xs font-medium">
                                                            {{ $item }}
                                                        </span>
                                                    @endforeach
                                                    @if(count($keluhan) > 3)
                                                        <span class="inline-block px-2 py-1 bg-gray-100 text-gray-600 rounded text-xs">
                                                            +{{ count($keluhan) - 3 }} lainnya
                                                        </span>
                                                    @endif
                                                </div>
                                            @else
                                                <span class="text-sm text-gray-400 italic">Tidak ada keluhan</span>
                                            @endif
                                        </div>
                                    </td>

                                    {{-- Kondisi Gigi --}}
                                    <td class="px-6 py-4">
                                        <div class="space-y-2 max-w-[200px]">
                                            <div class="flex flex-wrap gap-1">
                                                @if($checkup->kondisi_karies)
                                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 border border-yellow-200">
                                                        Karies
                                                    </span>
                                                @endif
                                                @if($checkup->kondisi_sisa_akar)
                                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-orange-100 text-orange-800 border border-orange-200">
                                                        Sisa Akar
                                                    </span>
                                                @endif
                                                @if($checkup->kondisi_karang_gigi)
                                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800 border border-gray-200">
                                                        Karang Gigi
                                                    </span>
                                                @endif
                                                @if($checkup->kondisi_gusi_bengkak)
                                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800 border border-red-200">
                                                        Gusi Bengkak
                                                    </span>
                                                @endif
                                                @if($checkup->kondisi_gigi_goyang)
                                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800 border border-purple-200">
                                                        Gigi Goyang
                                                    </span>
                                                @endif
                                                @if($checkup->kondisi_pendarahan)
                                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-pink-100 text-pink-800 border border-pink-200">
                                                        Pendarahan
                                                    </span>
                                                @endif
                                            </div>

                                            @if(!$checkup->kondisi_karies && !$checkup->kondisi_sisa_akar && !$checkup->kondisi_karang_gigi && 
                                                !$checkup->kondisi_gusi_bengkak && !$checkup->kondisi_gigi_goyang && !$checkup->kondisi_pendarahan)
                                                <span class="text-xs text-gray-400 italic">Kondisi normal</span>
                                            @endif
                                        </div>
                                    </td>

                                    {{-- Tanggal Pemeriksaan --}}
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center gap-2">
                                            <svg class="h-4 w-4 text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                            <div>
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $checkup->created_at->format('d M Y') }}
                                                </div>
                                                <div class="text-xs text-gray-500">
                                                    {{ $checkup->created_at->format('H:i') }} WIB
                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                    {{-- Aksi --}}
                                    <td class="px-6 py-4 text-right">
                                        <div class="flex justify-end items-center space-x-2">
                                            {{-- WhatsApp Button --}}
                                            <a href="{{ route('caten-dental-checkups.whatsapp', $checkup->id) }}" 
                                               class="inline-flex items-center p-2 bg-green-50 text-green-700 rounded-lg hover:bg-green-100 transition-colors duration-200"
                                               title="Kirim via WhatsApp"
                                               target="_blank">
                                                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor">
                                                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.570-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.890-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.309"/>
                                                </svg>
                                            </a>

                                            {{-- Print Button --}}
                                            <a href="{{ route('caten-dental-checkups.print', $checkup->id) }}" 
                                               class="inline-flex items-center p-2 bg-purple-50 text-purple-700 rounded-lg hover:bg-purple-100 transition-colors duration-200"
                                               title="Cetak Hasil" target="_blank">
                                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                                                </svg>
                                            </a>

                                            {{-- View Button --}}
                                            <a href="{{ route('caten-dental-checkups.show', $checkup->id) }}" 
                                               class="inline-flex items-center p-2 bg-blue-50 text-blue-700 rounded-lg hover:bg-blue-100 transition-colors duration-200"
                                               title="Lihat Detail">
                                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                            </a>

                                            {{-- Edit Button --}}
                                            <a href="{{ route('caten-dental-checkups.edit', $checkup->id) }}" 
                                               class="inline-flex items-center p-2 bg-yellow-50 text-yellow-700 rounded-lg hover:bg-yellow-100 transition-colors duration-200"
                                               title="Edit Data">
                                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </a>

                                            {{-- Delete Button --}}
                                            <form action="{{ route('caten-dental-checkups.destroy', $checkup->id) }}" method="POST" 
                                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus data pemeriksaan ini?')"
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
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                                            <p class="text-lg font-medium text-gray-500">Tidak ada data pemeriksaan</p>
                                            <p class="text-sm text-gray-400 mt-1">Mulai dengan menambahkan pemeriksaan baru</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Pagination --}}
            @if ($checkups->hasPages())
                <div class="mt-6 bg-white rounded-lg shadow-sm border border-gray-200 p-4">
                    {{ $checkups->appends(request()->query())->links() }}
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
    </script>

    <style>
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
</x-app-layout>