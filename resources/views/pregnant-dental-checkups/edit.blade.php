<x-app-layout>
    <div class="py-6">
        <div class="w-full px-4 sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="py-4 bg-gray-50 border-b border-gray-200 flex justify-between items-center">
                <div>
                    <h2 class="text-xl font-semibold text-gray-800">Edit Pemeriksaan Gigi Ibu Hamil</h2>
                    <p class="text-sm text-gray-500 mt-1">Edit data pemeriksaan gigi ibu hamil</p>
                </div>
                <a href="{{ route('pregnant-dental-checkups.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-100 border border-gray-300 rounded-lg font-semibold text-gray-700 hover:bg-gray-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Kembali
                </a>
            </div>

            <div class="bg-white shadow-sm rounded-lg overflow-hidden">
                <!-- Form Section -->
                <form method="POST" action="{{ route('pregnant-dental-checkups.update', $pregnantDentalCheckup->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="px-6 py-4 space-y-6">
                        <!-- Patient Selection (Display only, cannot edit) -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Pasien</label>
                            <div class="p-3 bg-gray-50 rounded-md border border-gray-300">
                                <p class="text-gray-900 font-medium">{{ $pregnantDentalCheckup->pasien->nama }}</p>
                                <p class="text-sm text-gray-600">NIK: {{ $pregnantDentalCheckup->pasien->nik }} | Umur: {{ $pregnantDentalCheckup->pasien->umur }} tahun</p>
                            </div>
                            <input type="hidden" name="pasien_id" value="{{ $pregnantDentalCheckup->pasien_id }}">
                        </div>

                        <!-- Keluhan Section -->
                        <div class="bg-gray-50 p-5 rounded-lg border border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b border-gray-200 flex items-center">
                                <svg class="h-5 w-5 mr-2 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                Keluhan Pasien
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                <!-- Gigi Berdarah -->
                                <div class="bg-white p-4 rounded-lg border border-gray-200 shadow-sm">
                                    <label class="block text-sm font-medium text-gray-700 mb-3">Gigi Berdarah</label>
                                    <div class="flex space-x-4">
                                        <label class="inline-flex items-center">
                                            <input type="radio" name="gigi_berdarah" value="Ya"
                                                {{ old('gigi_berdarah', $pregnantDentalCheckup->gigi_berdarah) == 'Ya' ? 'checked' : '' }}
                                                class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300">
                                            <span class="ml-2 text-sm text-gray-700">Ya</span>
                                        </label>
                                        <label class="inline-flex items-center">
                                            <input type="radio" name="gigi_berdarah" value="Tidak"
                                                {{ old('gigi_berdarah', $pregnantDentalCheckup->gigi_berdarah) == 'Tidak' ? 'checked' : '' }}
                                                class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300">
                                            <span class="ml-2 text-sm text-gray-700">Tidak</span>
                                        </label>
                                    </div>
                                    @error('gigi_berdarah')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Gusi Bengkak -->
                                <div class="bg-white p-4 rounded-lg border border-gray-200 shadow-sm">
                                    <label class="block text-sm font-medium text-gray-700 mb-3">Gusi Bengkak</label>
                                    <div class="flex space-x-4">
                                        <label class="inline-flex items-center">
                                            <input type="radio" name="gusi_bengkak" value="Ya"
                                                {{ old('gusi_bengkak', $pregnantDentalCheckup->gusi_bengkak) == 'Ya' ? 'checked' : '' }}
                                                class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300">
                                            <span class="ml-2 text-sm text-gray-700">Ya</span>
                                        </label>
                                        <label class="inline-flex items-center">
                                            <input type="radio" name="gusi_bengkak" value="Tidak"
                                                {{ old('gusi_bengkak', $pregnantDentalCheckup->gusi_bengkak) == 'Tidak' ? 'checked' : '' }}
                                                class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300">
                                            <span class="ml-2 text-sm text-gray-700">Tidak</span>
                                        </label>
                                    </div>
                                    @error('gusi_bengkak')
                                        <p class="mt-2 text-sm text红色-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Dikomentari Bau Mulut -->
                                <div class="bg-white p-4 rounded-lg border border-gray-200 shadow-sm">
                                    <label class="block text-sm font-medium text-gray-700 mb-3">Dikomentari Bau Mulut</label>
                                    <div class="flex space-x-4">
                                        <label class="inline-flex items-center">
                                            <input type="radio" name="dikomentari_bau_mulut" value="Ya"
                                                {{ old('dikomentari_bau_mulut', $pregnantDentalCheckup->dikomentari_bau_mulut) == 'Ya' ? 'checked' : '' }}
                                                class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300">
                                            <span class="ml-2 text-sm text-gray-700">Ya</span>
                                        </label>
                                        <label class="inline-flex items-center">
                                            <input type="radio" name="dikomentari_bau_mulut" value="Tidak"
                                                {{ old('dikomentari_bau_mulut', $pregnantDentalCheckup->dikomentari_bau_mulut) == 'Tidak' ? 'checked' : '' }}
                                                class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300">
                                            <span class="ml-2 text-sm text-gray-700">Tidak</span>
                                        </label>
                                    </div>
                                    @error('dikomentari_bau_mulut')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Gigi Goyang -->
                                <div class="bg-white p-4 rounded-lg border border-gray-200 shadow-sm">
                                    <label class="block text-sm font-medium text-gray-700 mb-3">Gigi Goyang</label>
                                    <div class="flex space-x-4">
                                        <label class="inline-flex items-center">
                                            <input type="radio" name="gigi_goyang" value="Ya"
                                                {{ old('gigi_goyang', $pregnantDentalCheckup->gigi_goyang) == 'Ya' ? 'checked' : '' }}
                                                class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300">
                                            <span class="ml-2 text-sm text-gray-700">Ya</span>
                                        </label>
                                        <label class="inline-flex items-center">
                                            <input type="radio" name="gigi_goyang" value="Tidak"
                                                {{ old('gigi_goyang', $pregnantDentalCheckup->gigi_goyang) == 'Tidak' ? 'checked' : '' }}
                                                class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300">
                                            <span class="ml-2 text-sm text-gray-700">Tidak</span>
                                        </label>
                                    </div>
                                    @error('gigi_goyang')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Sulit Mengunyah -->
                                <div class="bg-white p-4 rounded-lg border border-gray-200 shadow-sm">
                                    <label class="block text-sm font-medium text-gray-700 mb-3">Sulit Mengunyah</label>
                                    <div class="flex space-x-4">
                                        <label class="inline-flex items-center">
                                            <input type="radio" name="sulit_mengunyah" value="Ya"
                                                {{ old('sulit_mengunyah', $pregnantDentalCheckup->sulit_mengunyah) == 'Ya' ? 'checked' : '' }}
                                                class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300">
                                            <span class="ml-2 text-sm text-gray-700">Ya</span>
                                        </label>
                                        <label class="inline-flex items-center">
                                            <input type="radio" name="sulit_mengunyah" value="Tidak"
                                                {{ old('sulit_mengunyah', $pregnantDentalCheckup->sulit_mengunyah) == 'Tidak' ? 'checked' : '' }}
                                                class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300">
                                            <span class="ml-2 text-sm text-gray-700">Tidak</span>
                                        </label>
                                    </div>
                                    @error('sulit_mengunyah')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Makanan Terselip -->
                                <div class="bg-white p-4 rounded-lg border border-gray-200 shadow-sm">
                                    <label class="block text-sm font-medium text-gray-700 mb-3">Makanan Terselip</label>
                                    <div class="flex space-x-4">
                                        <label class="inline-flex items-center">
                                            <input type="radio" name="makanan_terselip" value="Ya"
                                                {{ old('makanan_terselip', $pregnantDentalCheckup->makanan_terselip) == 'Ya' ? 'checked' : '' }}
                                                class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300">
                                            <span class="ml-2 text-sm text-gray-700">Ya</span>
                                        </label>
                                        <label class="inline-flex items-center">
                                            <input type="radio" name="makanan_terselip" value="Tidak"
                                                {{ old('makanan_terselip', $pregnantDentalCheckup->makanan_terselip) == 'Tidak' ? 'checked' : '' }}
                                                class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300">
                                            <span class="ml-2 text-sm text-gray-700">Tidak</span>
                                        </label>
                                    </div>
                                    @error('makanan_terselip')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Gusi Sakit -->
                                <div class="bg-white p-4 rounded-lg border border-gray-200 shadow-sm">
                                    <label class="block text-sm font-medium text-gray-700 mb-3">Gusi Sakit</label>
                                    <div class="flex space-x-4">
                                        <label class="inline-flex items-center">
                                            <input type="radio" name="gusi_sakit" value="Ya"
                                                {{ old('gusi_sakit', $pregnantDentalCheckup->gusi_sakit) == 'Ya' ? 'checked' : '' }}
                                                class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300">
                                            <span class="ml-2 text-sm text-gray-700">Ya</span>
                                        </label>
                                        <label class="inline-flex items-center">
                                            <input type="radio" name="gusi_sakit" value="Tidak"
                                                {{ old('gusi_sakit', $pregnantDentalCheckup->gusi_sakit) == 'Tidak' ? 'checked' : '' }}
                                                class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300">
                                            <span class="ml-2 text-sm text-gray-700">Tidak</span>
                                        </label>
                                    </div>
                                    @error('gusi_sakit')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Gigi Sakit -->
                                <div class="bg-white p-4 rounded-lg border border-gray-200 shadow-sm">
                                    <label class="block text-sm font-medium text-gray-700 mb-3">Gigi Sakit</label>
                                    <div class="flex space-x-4">
                                        <label class="inline-flex items-center">
                                            <input type="radio" name="gigi_sakit" value="Ya"
                                                {{ old('gigi_sakit', $pregnantDentalCheckup->gigi_sakit) == 'Ya' ? 'checked' : '' }}
                                                class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300">
                                            <span class="ml-2 text-sm text-gray-700">Ya</span>
                                        </label>
                                        <label class="inline-flex items-center">
                                            <input type="radio" name="gigi_sakit" value="Tidak"
                                                {{ old('gigi_sakit', $pregnantDentalCheckup->gigi_sakit) == 'Tidak' ? 'checked' : '' }}
                                                class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300">
                                            <span class="ml-2 text-sm text-gray-700">Tidak</span>
                                        </label>
                                    </div>
                                    @error('gigi_sakit')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Keluhan Lain -->
                        <div class="bg-gray-50 p-5 rounded-lg border border-gray-200">
                            <label for="keluhan_lain" class="block text-sm font-medium text-gray-700 mb-2">Keluhan Lain</label>
                            <input type="text" name="keluhan_lain" id="keluhan_lain" value="{{ old('keluhan_lain', $pregnantDentalCheckup->keluhan_lain) }}"
                                class="mt-1 block w-full rounded-lg border border-gray-300 py-3 px-4 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 sm:text-sm @error('keluhan_lain') border-red-500 @enderror"
                                placeholder="Masukkan keluhan lain jika ada">
                            @error('keluhan_lain')
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
                                        {{ old('kondisi_karies', $pregnantDentalCheckup->kondisi_karies) ? 'checked' : '' }}
                                        class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                    <label for="kondisi_karies" class="ml-3 block text-sm font-medium text-gray-700">Karies</label>
                                </div>

                                <!-- Sisa Akar -->
                                <div class="flex items-center bg-white p-3 rounded-lg border border-gray-200 shadow-sm">
                                    <input type="checkbox" name="kondisi_sisa_akar" id="kondisi_sisa_akar" value="1"
                                        {{ old('kondisi_sisa_akar', $pregnantDentalCheckup->kondisi_sisa_akar) ? 'checked' : '' }}
                                        class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                    <label for="kondisi_sisa_akar" class="ml-3 block text-sm font-medium text-gray-700">Sisa Akar</label>
                                </div>

                                <!-- Karang Gigi -->
                                <div class="flex items-center bg-white p-3 rounded-lg border border-gray-200 shadow-sm">
                                    <input type="checkbox" name="kondisi_karang_gigi" id="kondisi_karang_gigi" value="1"
                                        {{ old('kondisi_karang_gigi', $pregnantDentalCheckup->kondisi_karang_gigi) ? 'checked' : '' }}
                                        class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                    <label for="kondisi_karang_gigi" class="ml-3 block text-sm font-medium text-gray-700">Karang Gigi</label>
                                </div>

                                <!-- Gusi Bengkak -->
                                <div class="flex items-center bg-white p-3 rounded-lg border border-gray-200 shadow-sm">
                                    <input type="checkbox" name="kondisi_gusi_bengkak" id="kondisi_gusi_bengkak" value="1"
                                        {{ old('kondisi_gusi_bengkak', $pregnantDentalCheckup->kondisi_gusi_bengkak) ? 'checked' : '' }}
                                        class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                    <label for="kondisi_gusi_bengkak" class="ml-3 block text-sm font-medium text-gray-700">Gusi Bengkak</label>
                                </div>

                                <!-- Gigi Goyang -->
                                <div class="flex items-center bg-white p-3 rounded-lg border border-gray-200 shadow-sm">
                                    <input type="checkbox" name="kondisi_gigi_goyang" id="kondisi_gigi_goyang" value="1"
                                        {{ old('kondisi_gigi_goyang', $pregnantDentalCheckup->kondisi_gigi_goyang) ? 'checked' : '' }}
                                        class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                    <label for="kondisi_gigi_goyang" class="ml-3 block text-sm font-medium text-gray-700">Gigi Goyang</label>
                                </div>

                                <!-- Pendarahan -->
                                <div class="flex items-center bg-white p-3 rounded-lg border border-gray-200 shadow-sm">
                                    <input type="checkbox" name="kondisi_pendarahan" id="kondisi_pendarahan" value="1"
                                        {{ old('kondisi_pendarahan', $pregnantDentalCheckup->kondisi_pendarahan) ? 'checked' : '' }}
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
                                        {{ old('saran_konsultasi', $pregnantDentalCheckup->saran_konsultasi) ? 'checked' : '' }}
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
                                        {{ old('saran_kontrol_rutin', $pregnantDentalCheckup->saran_kontrol_rutin) ? 'checked' : '' }}
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
                                    placeholder="Tambahkan catatan tambahan">{{ old('catatan', $pregnantDentalCheckup->catatan) }}</textarea>
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
                                Perbarui Pemeriksaan
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
