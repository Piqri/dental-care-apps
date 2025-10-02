<header class="z-10 py-4 bg-white shadow-md border-b border-gray-200">
    <div class="container mx-auto px-6 flex items-center justify-between h-full text-purple-600">

        <!-- KIRI: Tanggal & Jam Hari Ini -->
        <div class="flex items-center text-sm text-gray-600 space-x-2">
            <svg class="w-5 h-5 text-purple-500" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3M3 11h18M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
            </svg>
            <span>
            {{ \Carbon\Carbon::now()->locale('id')->translatedFormat('l, d F Y') }},
            <span id="live-clock"></span>
            </span>
        </div>
        <script>
            function updateClock() {
            const now = new Date();
            const jam = now.getHours().toString().padStart(2, '0');
            const menit = now.getMinutes().toString().padStart(2, '0');
            const detik = now.getSeconds().toString().padStart(2, '0');
            document.getElementById('live-clock').textContent = jam + ':' + menit + ':' + detik;
            }
            setInterval(updateClock, 1000);
            updateClock();
        </script>

        <!-- KANAN: Menu Profil dan Hamburger -->
        <div class="flex items-center space-x-6">

            <!-- Hamburger untuk Mobile - PERBAIKAN: @click yang benar -->
            <button class="p-2 rounded-md md:hidden text-purple-600 hover:bg-purple-100 focus:outline-none"
                    @click="isSideMenuOpen = !isSideMenuOpen"
                    aria-label="Menu">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                          d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                          clip-rule="evenodd" />
                </svg>
            </button>

            <!-- Dropdown Profil -->
            <div class="relative" x-data="{ open: false }">
                <button @click="open = !open" @keydown.escape="open = false"
                        class="flex items-center space-x-2 rounded-full focus:outline-none focus:ring">
                    <img class="w-8 h-8 rounded-full object-cover"
                         src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=6b46c1&color=fff"
                         alt="User avatar" />
                    <span class="text-sm font-medium text-gray-700 hidden sm:block">
                        {{ Auth::user()->name }}
                    </span>
                    <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" stroke-width="2"
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>

                <!-- Dropdown Menu -->
                <div x-show="open" @click.away="open = false"
                     x-transition
                     class="absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded-lg shadow-lg z-50">
                    <!-- Link Profil -->
                    <a href="{{ route('profile.edit') }}"
                       class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                        <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" stroke-width="2"
                             viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M5.121 17.804A13.937 13.937 0 0112 15c2.5 0 4.847.655 6.879 1.804M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        {{ __('Profile') }}
                    </a>

                    <!-- Logout -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                                class="w-full flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 text-left">
                            <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" stroke-width="2"
                                 viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                            </svg>
                            {{ __('Log Out') }}
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</header>
