<x-app-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">Tambah Pasien Baru</h2>
                    <p class="text-sm text-gray-500">Pilih jenis pasien terlebih dahulu, kemudian isi form yang muncul</p>
                </div>
                <a href="{{ route('pasien.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-100 border border-gray-300 rounded-lg font-semibold text-gray-700 hover:bg-gray-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Kembali
                </a>
            </div>

            <!-- Error Messages -->
            @if ($errors->any())
                <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-500" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-red-800">Terdapat {{ $errors->count() }} kesalahan dalam pengisian form:</h3>
                            <div class="mt-2 text-sm text-red-700">
                                <ul class="list-disc pl-5 space-y-1">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            @if (session('success'))
                <div class="mb-6 bg-green-50 border-l-4 border-green-500 p-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-green-500" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="p-6">
                    <form method="POST" action="{{ route('pasien.store') }}" id="pasienForm">
                        @csrf

                        <!-- Patient Type Selection -->
                        <div class="mb-8">
                            <label for="jenis_pasien" class="text-sm font-medium text-gray-700">Jenis Pasien <span class="text-red-500">*</span></label>
                            <select name="jenis_pasien" id="jenis_pasien"
                                class="mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm h-[37px] px-3 py-2"
                                required>
                                <option value="">-- Pilih Jenis Pasien --</option>
                                <option value="ibu_hamil" {{ old('jenis_pasien') == 'ibu_hamil' ? 'selected' : '' }}>Ibu Hamil</option>
                                <option value="anak_sekolah" {{ old('jenis_pasien') == 'anak_sekolah' ? 'selected' : '' }}>Anak Sekolah</option>
                                <option value="caten" {{ old('jenis_pasien') == 'caten' ? 'selected' : '' }}>CATEN (Dewasa)</option>
                            </select>
                            @error('jenis_pasien')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div id="formContainer" class="space-y-6" style="display:none">
                            <!-- Common Fields -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="nama" class="text-sm font-medium text-gray-700">Nama Lengkap <span class="text-red-500">*</span></label>
                                    <input type="text" name="nama" id="nama" value="{{ old('nama') }}"
                                        class="mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                        required>
                                    @error('nama')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label for="jenis_kelamin" class="text-sm font-medium text-gray-700">Jenis Kelamin <span class="text-red-500">*</span></label>
                                    <select name="jenis_kelamin" id="jenis_kelamin"
                                        class="mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm h-[37px] px-3 py-2">
                                        <option value="">Pilih Jenis Kelamin</option>
                                        <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                        <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                    </select>
                                    @error('jenis_kelamin')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label for="tempat_lahir" class="text-sm font-medium text-gray-700">Tempat Lahir <span class="text-red-500">*</span></label>
                                    <input type="text" name="tempat_lahir" id="tempat_lahir" value="{{ old('tempat_lahir') }}"
                                        class="mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                        required>
                                    @error('tempat_lahir')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label for="tanggal_lahir" class="text-sm font-medium text-gray-700">Tanggal Lahir <span class="text-red-500">*</span></label>
                                    <input type="date" name="tanggal_lahir" id="tanggal_lahir" value="{{ old('tanggal_lahir') }}"
                                        class="mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                        required>
                                    @error('tanggal_lahir')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Dynamic Fields -->
                            <div id="dynamicFields" class="space-y-6">
                                <!-- Ibu Hamil Fields -->
                                <div id="ibu_hamil_fields" class="jenis-pasien-fields hidden space-y-6">
                                    <input type="hidden" name="jenis_kelamin" value="Perempuan">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <div>
                                            <label for="nik_ibu_hamil" class="text-sm font-medium text-gray-700">
                                                NIK <span class="text-red-500">*</span>
                                            </label>
                                            <input type="text" name="nik" id="nik_ibu_hamil" value="{{ old('nik') }}"
                                                inputmode="numeric" pattern="\d*"
                                                maxlength="16"
                                                oninput="this.value = this.value.replace(/\D/g, '').slice(0,16);"
                                                class="mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                            @error('nik')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                            <span class="text-xs text-gray-500 ml-2">maksimal 16 digit angka</span>
                                        </div>
                                        <div>
                                            <label for="no_wa_ibu_hamil" class="text-sm font-medium text-gray-700">Nomor WhatsApp <span class="text-red-500">*</span></label>
                                            <input type="text" name="no_wa" id="no_wa_ibu_hamil" value="{{ old('no_wa') }}"
                                                inputmode="numeric" pattern="\d*" maxlength="15"
                                                oninput="this.value = this.value.replace(/\D/g, '').slice(0,15);"
                                                class="mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                            @error('no_wa')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                            <span class="text-xs text-gray-500 ml-2">maksimal 15 digit angka</span>
                                        </div>
                                    </div>
                                    <div>
                                        <label for="alamat_ibu_hamil" class="text-sm font-medium text-gray-700">Alamat</label>
                                        <textarea name="alamat" id="alamat_ibu_hamil" rows="3"
                                            class="mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('alamat') }}</textarea>
                                        @error('alamat')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Anak Sekolah Fields -->
                                <div id="anak_sekolah_fields" class="jenis-pasien-fields hidden space-y-6">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <div>
                                            <label for="nama_orang_tua" class="text-sm font-medium text-gray-700">Nama Orang Tua <span class="text-red-500">*</span></label>
                                            <input type="text" name="nama_orang_tua" id="nama_orang_tua" value="{{ old('nama_orang_tua') }}"
                                                class="mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                            @error('nama_orang_tua')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div>
                                            <label for="no_wa_anak_sekolah" class="text-sm font-medium text-gray-700">Nomor WhatsApp (Orang Tua) <span class="text-red-500">*</span></label>
                                            <input type="text" name="no_wa" id="no_wa_anak_sekolah" value="{{ old('no_wa') }}"
                                                inputmode="numeric" pattern="\d*" maxlength="15"
                                                oninput="this.value = this.value.replace(/\D/g, '').slice(0,15);"
                                                class="mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                            @error('no_wa')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                            <span class="text-xs text-gray-500 ml-2">maksimal 15 digit angka</span>
                                        </div>
                                    </div>
                                    <div>
                                        <label for="alamat_anak_sekolah" class="text-sm font-medium text-gray-700">Alamat</label>
                                        <textarea name="alamat" id="alamat_anak_sekolah" rows="3"
                                            class="mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('alamat') }}</textarea>
                                        @error('alamat')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <!-- CATEN Fields -->
                                <div id="caten_fields" class="jenis-pasien-fields hidden space-y-6">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <div>
                                            <label for="nik_caten" class="text-sm font-medium text-gray-700">
                                                NIK <span class="text-red-500">*</span>
                                            </label>
                                            <input type="text" name="nik" id="nik_caten" value="{{ old('nik') }}"
                                                inputmode="numeric" pattern="\d*"
                                                maxlength="16"
                                                oninput="this.value = this.value.replace(/\D/g, '').slice(0,16);"
                                                class="mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                            @error('nik')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                            <span class="text-xs text-gray-500 ml-2">maksimal 16 digit angka</span>
                                        </div>
                                        <div>
                                            <label for="no_wa_caten" class="text-sm font-medium text-gray-700">Nomor WhatsApp <span class="text-red-500">*</span></label>
                                            <input type="text" name="no_wa" id="no_wa_caten" value="{{ old('no_wa') }}"
                                                inputmode="numeric" pattern="\d*" maxlength="15"
                                                oninput="this.value = this.value.replace(/\D/g, '').slice(0,15);"
                                                class="mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                            @error('no_wa')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                            <span class="text-xs text-gray-500 ml-2">maksimal 15 digit angka</span>
                                        </div>
                                    </div>
                                    <div>
                                        <label for="alamat_caten" class="text-sm font-medium text-gray-700">Alamat</label>
                                        <textarea name="alamat" id="alamat_caten" rows="3"
                                            class="mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('alamat') }}</textarea>
                                        @error('alamat')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="flex justify-end">
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-lg font-semibold text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
                                    </svg>
                                    Simpan Data Pasien
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/pasien-form.js') }}"></script>

</x-app-layout>
