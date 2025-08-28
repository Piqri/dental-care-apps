
<x-app-layout>
    <div class="py-6">
        <div class="w-full px-4 sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="py-4 bg-gray-50 border-b border-gray-200 flex justify-between items-center">
                <div>
                    <h2 class="text-xl font-semibold text-gray-800">Tambah Pemeriksaan Gigi Caten</h2>
                    <p class="text-sm text-gray-500 mt-1">Isi form berikut untuk menambahkan data pemeriksaan gigi caten</p>
                </div>
                <a href="{{ route('caten-dental-checkups.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-100 border border-gray-300 rounded-lg font-semibold text-gray-700 hover:bg-gray-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Kembali
                </a>
            </div>

            <div class="bg-white shadow-sm rounded-lg overflow-hidden">
                <!-- Form Section -->
                <form method="POST" action="{{ route('caten-dental-checkups.store') }}">
                    @csrf
                    <div class="px-6 py-4 space-y-6">
                        <!-- Patient Selection with Search -->
                        <label for="pasien_id" class="block text-sm font-medium text-gray-700 mb-1">Pasien *</label>
                        <div class="relative">
                            <select name="pasien_id" id="pasien_id" required
                                    class="select2-search block w-full rounded-md border border-gray-300 py-2 px-3 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm @error('pasien_id') border-red-500 @enderror">
                                @isset($pasien)
                                    {{-- Preselect jika datang dari show pasien --}}
                                    <option value="{{ $pasien->id }}" selected>
                                        {{ $pasien->nama }} (NIK: {{ $pasien->nik }}, {{ $pasien->umur }} tahun)
                                    </option>
                                @endisset
                            </select>
                        </div>
                        @error('pasien_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror

                        <!-- Keluhan Section -->
                        <div class="bg-gray-50 p-5 rounded-lg border border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b border-gray-200 flex items-center">
                                <svg class="h-5 w-5 mr-2 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                Keluhan Pasien
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                <!-- Gigi Berlubang -->
                                <div class="bg-white p-4 rounded-lg border border-gray-200 shadow-sm">
                                    <label class="block text-sm font-medium text-gray-700 mb-3">Apa ada gigi yang berlubang?</label>
                                    <div class="flex space-x-4">
                                        <label class="inline-flex items-center">
                                            <input type="radio" name="gigi_berlubang" value="Ya"
                                                {{ old('gigi_berlubang') == 'Ya' ? 'checked' : '' }}
                                                class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300">
                                            <span class="ml-2 text-sm text-gray-700">Ya</span>
                                        </label>
                                        <label class="inline-flex items-center">
                                            <input type="radio" name="gigi_berlubang" value="Tidak"
                                                {{ old('gigi_berlubang', 'Tidak') == 'Tidak' ? 'checked' : '' }}
                                                class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300">
                                            <span class="ml-2 text-sm text-gray-700">Tidak</span>
                                        </label>
                                    </div>
                                    @error('gigi_berlubang')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Riwayat Sakit Gigi -->
                                <div class="bg-white p-4 rounded-lg border border-gray-200 shadow-sm">
                                    <label class="block text-sm font-medium text-gray-700 mb-3">Apakah pernah sakit gigi? </label>
                                    <div class="flex space-x-4">
                                        <label class="inline-flex items-center">
                                            <input type="radio" name="riwayat_sakit_gigi" value="Ya"
                                                {{ old('riwayat_sakit_gigi') == 'Ya' ? 'checked' : '' }}
                                                class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300">
                                            <span class="ml-2 text-sm text-gray-700">Ya</span>
                                        </label>
                                        <label class="inline-flex items-center">
                                            <input type="radio" name="riwayat_sakit_gigi" value="Tidak"
                                                {{ old('riwayat_sakit_gigi', 'Tidak') == 'Tidak' ? 'checked' : '' }}
                                                class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300">
                                            <span class="ml-2 text-sm text-gray-700">Tidak</span>
                                        </label>
                                    </div>
                                    @error('riwayat_sakit_gigi')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Gusi Bengkak -->
                                <div class="bg-white p-4 rounded-lg border border-gray-200 shadow-sm">
                                    <label class="block text-sm font-medium text-gray-700 mb-3">Apakah gusi pernah bengkak? </label>
                                    <div class="flex space-x-4">
                                        <label class="inline-flex items-center">
                                            <input type="radio" name="gusi_bengkak" value="Ya"
                                                {{ old('gusi_bengkak') == 'Ya' ? 'checked' : '' }}
                                                class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300">
                                            <span class="ml-2 text-sm text-gray-700">Ya</span>
                                        </label>
                                        <label class="inline-flex items-center">
                                            <input type="radio" name="gusi_bengkak" value="Tidak"
                                                {{ old('gusi_bengkak', 'Tidak') == 'Tidak' ? 'checked' : '' }}
                                                class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300">
                                            <span class="ml-2 text-sm text-gray-700">Tidak</span>
                                        </label>
                                    </div>
                                    @error('gusi_bengkak')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Sisa Akar -->
                                <div class="bg-white p-4 rounded-lg border border-gray-200 shadow-sm">
                                    <label class="block text-sm font-medium text-gray-700 mb-3">Apakah ada gigi yang sudah sisa akar? </label>
                                    <div class="flex space-x-4">
                                        <label class="inline-flex items-center">
                                            <input type="radio" name="sisa_akar" value="Ya"
                                                {{ old('sisa_akar') == 'Ya' ? 'checked' : '' }}
                                                class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300">
                                            <span class="ml-2 text-sm text-gray-700">Ya</span>
                                        </label>
                                        <label class="inline-flex items-center">
                                            <input type="radio" name="sisa_akar" value="Tidak"
                                                {{ old('sisa_akar', 'Tidak') == 'Tidak' ? 'checked' : '' }}
                                                class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300">
                                            <span class="ml-2 text-sm text-gray-700">Tidak</span>
                                        </label>
                                    </div>
                                    @error('sisa_akar')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Gusi Berdarah -->
                                <div class="bg-white p-4 rounded-lg border border-gray-200 shadow-sm">
                                    <label class="block text-sm font-medium text-gray-700 mb-3">Apakah gusi pernah atau mudah berdarah? </label>
                                    <div class="flex space-x-4">
                                        <label class="inline-flex items-center">
                                            <input type="radio" name="gusi_berdarah" value="Ya"
                                                {{ old('gusi_berdarah') == 'Ya' ? 'checked' : '' }}
                                                class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300">
                                            <span class="ml-2 text-sm text-gray-700">Ya</span>
                                        </label>
                                        <label class="inline-flex items-center">
                                            <input type="radio" name="gusi_berdarah" value="Tidak"
                                                {{ old('gusi_berdarah', 'Tidak') == 'Tidak' ? 'checked' : '' }}
                                                class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300">
                                            <span class="ml-2 text-sm text-gray-700">Tidak</span>
                                        </label>
                                    </div>
                                    @error('gusi_berdarah')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Gigi Goyang -->
                                <div class="bg-white p-4 rounded-lg border border-gray-200 shadow-sm">
                                    <label class="block text-sm font-medium text-gray-700 mb-3">Apakah ada gigi yang terasa goyang? </label>
                                    <div class="flex space-x-4">
                                        <label class="inline-flex items-center">
                                            <input type="radio" name="gigi_goyang" value="Ya"
                                                {{ old('gigi_goyang') == 'Ya' ? 'checked' : '' }}
                                                class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300">
                                            <span class="ml-2 text-sm text-gray-700">Ya</span>
                                        </label>
                                        <label class="inline-flex items-center">
                                            <input type="radio" name="gigi_goyang" value="Tidak"
                                                {{ old('gigi_goyang', 'Tidak') == 'Tidak' ? 'checked' : '' }}
                                                class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300">
                                            <span class="ml-2 text-sm text-gray-700">Tidak</span>
                                        </label>
                                    </div>
                                    @error('gigi_goyang')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Sariawan -->
                                <div class="bg-white p-4 rounded-lg border border-gray-200 shadow-sm">
                                    <label class="block text-sm font-medium text-gray-700 mb-3">Apakah sering sariawan? </label>
                                    <div class="flex space-x-4">
                                        <label class="inline-flex items-center">
                                            <input type="radio" name="sariawan" value="Ya"
                                                {{ old('sariawan') == 'Ya' ? 'checked' : '' }}
                                                class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300">
                                            <span class="ml-2 text-sm text-gray-700">Ya</span>
                                        </label>
                                        <label class="inline-flex items-center">
                                            <input type="radio" name="sariawan" value="Tidak"
                                                {{ old('sariawan', 'Tidak') == 'Tidak' ? 'checked' : '' }}
                                                class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300">
                                            <span class="ml-2 text-sm text-gray-700">Tidak</span>
                                        </label>
                                    </div>
                                    @error('sariawan')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Tanggal Terakhir Sakit Gigi -->
                        <div class="bg-gray-50 p-5 rounded-lg border border-gray-200">
                            <label for="terakhir_sakit_gigi" class="block text-sm font-medium text-gray-700 mb-2">Kapan terakhir sakit gigi? </label>
                            <input type="date" name="terakhir_sakit_gigi" id="terakhir_sakit_gigi" value="{{ old('terakhir_sakit_gigi') }}"
                                class="mt-1 block w-full rounded-lg border border-gray-300 py-3 px-4 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 sm:text-sm @error('terakhir_sakit_gigi') border-red-500 @enderror">
                            @error('terakhir_sakit_gigi')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Kondisi Gigi Section -->
                        <div class="bg-gray-50 p-5 rounded-lg border border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b border-gray-200 flex items-center">
                                <svg class="h-5 w-5 mr-2 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Kondisi Gigi
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <!-- Karies -->
                                <div class="flex items-center bg-white p-3 rounded-lg border border-gray-200 shadow-sm">
                                    <input type="checkbox" name="kondisi_karies" id="kondisi_karies" value="1"
                                        {{ old('kondisi_karies') ? 'checked' : '' }}
                                        class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                    <label for="kondisi_karies" class="ml-3 block text-sm font-medium text-gray-700">Karies</label>
                                </div>

                                <!-- Sisa Akar -->
                                <div class="flex items-center bg-white p-3 rounded-lg border border-gray-200 shadow-sm">
                                    <input type="checkbox" name="kondisi_sisa_akar" id="kondisi_sisa_akar" value="1"
                                        {{ old('kondisi_sisa_akar') ? 'checked' : '' }}
                                        class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                    <label for="kondisi_sisa_akar" class="ml-3 block text-sm font-medium text-gray-700">Sisa Akar</label>
                                </div>

                                <!-- Karang Gigi -->
                                <div class="flex items-center bg-white p-3 rounded-lg border border-gray-200 shadow-sm">
                                    <input type="checkbox" name="kondisi_karang_gigi" id="kondisi_karang_gigi" value="1"
                                        {{ old('kondisi_karang_gigi') ? 'checked' : '' }}
                                        class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                    <label for="kondisi_karang_gigi" class="ml-3 block text-sm font-medium text-gray-700">Karang Gigi</label>
                                </div>

                                <!-- Gusi Bengkak -->
                                <div class="flex items-center bg-white p-3 rounded-lg border border-gray-200 shadow-sm">
                                    <input type="checkbox" name="kondisi_gusi_bengkak" id="kondisi_gusi_bengkak" value="1"
                                        {{ old('kondisi_gusi_bengkak') ? 'checked' : '' }}
                                        class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                    <label for="kondisi_gusi_bengkak" class="ml-3 block text-sm font-medium text-gray-700">Gusi Bengkak</label>
                                </div>

                                <!-- Gigi Goyang -->
                                <div class="flex items-center bg-white p-3 rounded-lg border border-gray-200 shadow-sm">
                                    <input type="checkbox" name="kondisi_gigi_goyang" id="kondisi_gigi_goyang" value="1"
                                        {{ old('kondisi_gigi_goyang') ? 'checked' : '' }}
                                        class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                    <label for="kondisi_gigi_goyang" class="ml-3 block text-sm font-medium text-gray-700">Gigi Goyang</label>
                                </div>

                                <!-- Pendarahan -->
                                <div class="flex items-center bg-white p-3 rounded-lg border border-gray-200 shadow-sm">
                                    <input type="checkbox" name="kondisi_pendarahan" id="kondisi_pendarahan" value="1"
                                        {{ old('kondisi_pendarahan') ? 'checked' : '' }}
                                        class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                    <label for="kondisi_pendarahan" class="ml-3 block text-sm font-medium text-gray-700">Pendarahan</label>
                                </div>
                            </div>
                        </div>

                        <!-- Saran dan Catatan -->
                        <div class="bg-gray-50 p-5 rounded-lg border border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b border-gray-200 flex items-center">
                                <svg class="h-5 w-5 mr-2 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                </svg>
                                Saran dan Catatan
                            </h3>

                            <div class="mb-5">
                                <div class="flex items-center bg-white p-3 rounded-lg border border-gray-200 shadow-sm">
                                    <input type="checkbox" name="saran_konsultasi" id="saran_konsultasi" value="Ya"
                                        {{ old('saran_konsultasi') ? 'checked' : '' }}
                                        class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                    <label for="saran_konsultasi" class="ml-3 block text-sm font-medium text-gray-700">Disarankan untuk melakukan konsultasi dan perawatan ke dokter gigi</label>
                                </div>
                                @error('saran_konsultasi')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-5">
                                <div class="flex items-center bg-white p-3 rounded-lg border border-gray-200 shadow-sm">
                                    <input type="checkbox" name="saran_kontrol_rutin" id="saran_kontrol_rutin" value="Ya"
                                        {{ old('saran_kontrol_rutin') ? 'checked' : '' }}
                                        class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                    <label for="saran_kontrol_rutin" class="ml-3 block text-sm font-medium text-gray-700">Disarankan untuk melakukan kontrol rutin 6x sekali</label>
                                </div>
                                @error('saran_kontrol_rutin')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="catatan" class="block text-sm font-medium text-gray-700 mb-2">Catatan</label>
                                <textarea name="catatan" id="catatan" rows="4"
                                    class="mt-1 block w-full rounded-lg border border-gray-300 py-3 px-4 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 sm:text-sm @error('catatan') border-red-500 @enderror"
                                    placeholder="Tambahkan catatan tambahan">{{ old('catatan') }}</textarea>
                                @error('catatan')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="flex justify-end pt-4">
                            <button type="submit" class="inline-flex items-center px-6 py-3 bg-blue-600 border border-transparent rounded-lg font-semibold text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200 shadow-md">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                Simpan Pemeriksaan
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Include Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- Include jQuery (required for Select2) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Include Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <link href="{{ asset('app/search.css') }}" rel="stylesheet">

    <script>
        const pasienSearchUrl = "{{ route('ajax.caten-search') }}";
    </script>

    <script src="{{ asset('app/caten-search.js') }}"></script>
</x-app-layout>
