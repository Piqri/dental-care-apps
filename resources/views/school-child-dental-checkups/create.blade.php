<x-app-layout>
    <div class="py-6">
        <div class="w-full px-4 sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="py-4 bg-gray-50 border-b border-gray-200 flex justify-between items-center">
                <div>
                    <h2 class="text-xl font-semibold text-gray-800">Tambah Pemeriksaan Gigi Anak Sekolah</h2>
                    <p class="text-sm text-gray-500 mt-1">Isi form berikut untuk menambahkan data pemeriksaan gigi anak sekolah</p>
                </div>
                <a href="{{ route('school-child-dental-checkups.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-100 border border-gray-300 rounded-lg font-semibold text-gray-700 hover:bg-gray-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Kembali
                </a>
            </div>

            <div class="bg-white shadow-sm rounded-lg overflow-hidden">
                <!-- Form Section -->
                <form method="POST" action="{{ route('school-child-dental-checkups.store') }}">
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

                        <!-- Kondisi Gigi Section -->
                        <div class="bg-gray-50 p-5 rounded-lg border border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b border-gray-200 flex items-center">
                                <svg class="h-5 w-5 mr-2 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Kondisi Gigi
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <!-- Karies -->
                                <div class="flex items-center bg-white p-3 rounded-lg border border-gray-200 shadow-sm">
                                    <input type="checkbox" name="kondisi_karies" id="kondisi_karies" value="1"
                                        {{ old('kondisi_karies') ? 'checked' : '' }}
                                        class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                    <label for="kondisi_karies" class="ml-3 block text-sm font-medium text-gray-700">Karies</label>
                                </div>

                                <!-- Karang Gigi -->
                                <div class="flex items-center bg-white p-3 rounded-lg border border-gray-200 shadow-sm">
                                    <input type="checkbox" name="kondisi_karang_gigi" id="kondisi_karang_gigi" value="1"
                                        {{ old('kondisi_karang_gigi') ? 'checked' : '' }}
                                        class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                    <label for="kondisi_karang_gigi" class="ml-3 block text-sm font-medium text-gray-700">Karang Gigi</label>
                                </div>

                                <!-- Gigi Goyang -->
                                <div class="flex items-center bg-white p-3 rounded-lg border border-gray-200 shadow-sm">
                                    <input type="checkbox" name="kondisi_gigi_goyang" id="kondisi_gigi_goyang" value="1"
                                        {{ old('kondisi_gigi_goyang') ? 'checked' : '' }}
                                        class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                    <label for="kondisi_gigi_goyang" class="ml-3 block text-sm font-medium text-gray-700">Gigi Goyang</label>
                                </div>

                                <!-- Sisa Akar -->
                                <div class="flex items-center bg-white p-3 rounded-lg border border-gray-200 shadow-sm">
                                    <input type="checkbox" name="kondisi_sisa_akar" id="kondisi_sisa_akar" value="1"
                                        {{ old('kondisi_sisa_akar') ? 'checked' : '' }}
                                        class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                    <label for="kondisi_sisa_akar" class="ml-3 block text-sm font-medium text-gray-700">Sisa Akar</label>
                                </div>
                            </div>
                        </div>

                        <!-- Jumlah Gigi -->
                        <div class="bg-gray-50 p-5 rounded-lg border border-gray-200">
                            <label for="jumlah_gigi" class="block text-sm font-medium text-gray-700 mb-2">Jumlah Gigi</label>
                            <select name="jumlah_gigi" id="jumlah_gigi" class="mt-1 block w-full rounded-lg border border-gray-300 py-3 px-4 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 sm:text-sm @error('jumlah_gigi') border-red-500 @enderror">
                                <option value="normal" {{ old('jumlah_gigi', 'normal') == 'normal' ? 'selected' : '' }}>Normal</option>
                                <option value="berlebih" {{ old('jumlah_gigi') == 'berlebih' ? 'selected' : '' }}>Berlebih</option>
                                <option value="kurang" {{ old('jumlah_gigi') == 'kurang' ? 'selected' : '' }}>Kurang</option>
                            </select>
                            @error('jumlah_gigi')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
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
        const pasienSearchUrl = "{{ route('ajax.child-search') }}";
    </script>

    <script src="{{ asset('app/child-search.js') }}"></script>
</x-app-layout>
