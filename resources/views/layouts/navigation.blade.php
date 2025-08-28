<aside class="z-20 hidden w-64 overflow-y-auto bg-white md:block flex-shrink-0">
    <div class="py-4 text-gray-500" id="sidebar-simrs">
        <a class="ml-6 text-lg font-bold text-gray-800" href="{{ route('dashboard') }}">
            NAME
        </a>

        <ul class="mt-6">
            <!-- Dashboard -->
            <li class="relative px-6 py-3">
                <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                    <x-slot name="icon">
                        <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                            <path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                    </x-slot>
                    {{ __('Dashboard') }}
                </x-nav-link>
            </li>

            <!-- Data Category -->
            <li class="px-6 py-3">
                <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Data</span>
            </li>

            <!-- Data Pasien -->
            <li class="relative px-6 py-3">
                <x-nav-link href="{{ route('pasien.index') }}" :active="request()->routeIs('patients.*')">
                    <x-slot name="icon">
                        <!-- Icon: User Group (for Data Pasien) -->
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                        </svg>
                    </x-slot>
                    {{ __('Data Pasien') }}
                </x-nav-link>
            </li>

            <!-- Pemeriksaan Category -->
            <li class="px-6 py-3">
                <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Pemeriksaan</span>
            </li>

            <!-- Pregnant Dental Checkup -->
            <li class="relative px-6 py-3">
                <x-nav-link href="{{ route('pregnant-dental-checkups.index') }}" :active="request()->routeIs('pregnant-dental-checkup.*')">
                    <x-slot name="icon">
                        <!-- Icon: Heart (for Pregnant Dental Checkup) -->
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                        </svg>
                    </x-slot>
                    {{ __('Ibu Hamil') }}
                </x-nav-link>
            </li>

            <!-- Caten Dental Checkup -->
            <li class="relative px-6 py-3">
                <x-nav-link href="{{ route('caten-dental-checkups.index') }}" :active="request()->routeIs('caten-dental-checkup.*')">
                    <x-slot name="icon">
                        <!-- Icon: Heart (for Caten Dental Checkup) -->
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                        </svg>
                    </x-slot>
                    {{ __('Caten') }}
                </x-nav-link>
            </li>

            <!-- school child dental checkup -->
            <li class="relative px-6 py-3">
                <x-nav-link href="{{ route('school-child-dental-checkups.index') }}" :active="request()->routeIs('school-child-dental-checkup.*')">
                    <x-slot name="icon">
                        <!-- Icon: Heart (for School Child Dental Checkup) -->
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                        </svg>
                    </x-slot>
                    {{ __('Anak Sekolah') }}
                </x-nav-link>
            </li>

            <!-- Pemeriksaan -->
            {{-- <li class="relative px-6 py-3">
                <x-nav-link href="{{ route('pemeriksaan.index') }}" :active="request()->routeIs('pemeriksaan.*')">
                    <x-slot name="icon">
                        <!-- Icon: Clipboard Document (for Pemeriksaan) -->
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 4H7a2 2 0 01-2-2V6a2 2 0 012-2h3.5a1.5 1.5 0 003 0H17a2 2 0 012 2v12a2 2 0 01-2 2z" />
                        </svg>
                    </x-slot>
                    {{ __('Pemeriksaan') }}
                </x-nav-link>
            </li> --}}

            <!-- Pertanyaan -->
            {{-- <li class="relative px-6 py-3">
                <x-nav-link href="{{ route('pertanyaan.index') }}" :active="request()->routeIs('pertanyaan.*')">
                    <x-slot name="icon">
                        <!-- Icon: Question Mark Circle (for Pertanyaan) -->
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 18h.01M12 14a2 2 0 100-4 2 2 0 000 4zm0 0v2m0-6a6 6 0 110 12 6 6 0 010-12z" />
                        </svg>
                    </x-slot>
                    {{ __('Pertanyaan') }}
                </x-nav-link>
            </li> --}}


            <!-- Users -->
            {{-- <li class="relative px-6 py-3">
                <x-nav-link href="{{ route('users.index') }}" :active="request()->routeIs('users.index')">
                    <x-slot name="icon">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                    </x-slot>
                    {{ __('Users') }}
                </x-nav-link>
            </li> --}}

        </ul>
    </div>
</aside>

<script>
    function toggleDropdown(button) {
        const menu = button.nextElementSibling;
        const arrow = button.querySelector('svg#dropdown-arrow');

        // Toggle menu visibility
        menu.classList.toggle('hidden');

        // Rotate arrow
        arrow.classList.toggle('rotate-180');
    }
</script>
