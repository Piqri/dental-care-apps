<!-- Mobile Backdrop -->
<div
        x-show="isSideMenuOpen"
        x-transition:enter="transition ease-in-out duration-150"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in-out duration-150"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-10 flex items-end bg-black bg-opacity-50 sm:items-center sm:justify-center md:hidden"
        @click="isSideMenuOpen = false"
></div>

<!-- Mobile Sidebar -->
<aside
        class="fixed inset-y-0 z-20 flex-shrink-0 w-64 mt-16 overflow-y-auto bg-white md:hidden"
        x-show="isSideMenuOpen"
        x-transition:enter="transition ease-in-out duration-150"
        x-transition:enter-start="opacity-0 transform -translate-x-20"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in-out duration-150"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0 transform -translate-x-20"
        @click.outside="isSideMenuOpen = false"
        @keydown.escape="isSideMenuOpen = false"
>
    <div class="py-4 text-gray-500" id="sidebar-simrs-mobile">
        <a class="ml-6 text-lg font-bold text-gray-800" href="{{ route('dashboard') }}">
            NAME
        </a>

        <ul class="mt-6">
            <!-- Dashboard -->
            <li class="relative px-6 py-3">
                <x-responsive-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                    <x-slot name="icon">
                        <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                            <path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                    </x-slot>
                    {{ __('Dashboard') }}
                </x-responsive-nav-link>
            </li>

            <!-- Data Category -->
            <li class="px-6 py-3">
                <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Data</span>
            </li>

            <!-- Data Pasien -->
            <li class="relative px-6 py-3">
                <x-responsive-nav-link href="{{ route('pasien.index') }}" :active="request()->routeIs('patients.*')">
                    <x-slot name="icon">
                        <!-- Icon: User Group (for Data Pasien) -->
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                        </svg>
                    </x-slot>
                    {{ __('Data Pasien') }}
                </x-responsive-nav-link>
            </li>

            <!-- Pemeriksaan Category -->
            <li class="px-6 py-3">
                <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Pemeriksaan</span>
            </li>

            <!-- Pregnant Dental Checkup -->
            <li class="relative px-6 py-3">
                <x-responsive-nav-link href="{{ route('pregnant-dental-checkups.index') }}" :active="request()->routeIs('pregnant-dental-checkup.*')">
                    <x-slot name="icon">
                        <!-- Icon: Heart (for Pregnant Dental Checkup) -->
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                        </svg>
                    </x-slot>
                    {{ __('Ibu Hamil') }}
                </x-responsive-nav-link>
            </li>

            <!-- Caten Dental Checkup -->
            <li class="relative px-6 py-3">
                <x-responsive-nav-link href="{{ route('caten-dental-checkups.index') }}" :active="request()->routeIs('caten-dental-checkup.*')">
                    <x-slot name="icon">
                        <!-- Icon: Heart (for Caten Dental Checkup) -->
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                        </svg>
                    </x-slot>
                    {{ __('Caten') }}
                </x-responsive-nav-link>
            </li>

            <!-- School Child Dental Checkup -->
            <li class="relative px-6 py-3">
                <x-responsive-nav-link href="{{ route('school-child-dental-checkups.index') }}" :active="request()->routeIs('school-child-dental-checkup.*')">
                    <x-slot name="icon">
                        <!-- Icon: Heart (for School Child Dental Checkup) -->
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                        </svg>
                    </x-slot>
                    {{ __('Anak Sekolah') }}
                </x-responsive-nav-link>
            </li>
        </ul>
    </div>
</aside>
