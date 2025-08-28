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

            <!-- Hamburger untuk Mobile -->
            <button class="p-2 rounded-md md:hidden text-purple-600 hover:bg-purple-100 focus:outline-none"
                    @click="toggleSideMenu" aria-label="Menu">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                          d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                          clip-rule="evenodd" />
                </svg>
            </button>

            <!-- Dropdown Profil -->
            <x-dropdown>
                <x-slot name="trigger">
                    <button class="flex items-center space-x-2 rounded-full focus:outline-none focus:shadow-outline-purple"
                            @click="toggleProfileMenu" @keydown.escape="closeProfileMenu"
                            aria-label="Account" aria-haspopup="true">
                        <img class="w-8 h-8 rounded-full object-cover"
                             src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=6b46c1&color=fff"
                             alt="User avatar" />
                        <span class="text-sm font-medium text-gray-700 hidden sm:block">
                            {{ Auth::user()->name }}
                        </span>
                    </button>
                </x-slot>

                <x-slot name="content">
                    <!-- Link Profil -->
                    <x-dropdown-link href="{{ route('profile.edit') }}">
                        <x-slot name="icon">
                            <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path d="M12 4.354a4 4 0 00-3.682 2.401L8 7m4-2.646V7m0 0v2m0 2v7m0 0H8m4 0h4" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </x-slot>
                        {{ __('Profile') }}
                    </x-dropdown-link>

                    <!-- Logout -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-dropdown-link :href="route('logout')"
                                         onclick="event.preventDefault(); this.closest('form').submit();">
                            <x-slot name="icon">
                                <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                </svg>
                            </x-slot>
                            {{ __('Log Out') }}
                        </x-dropdown-link>
                    </form>
                </x-slot>
            </x-dropdown>
        </div>
    </div>
</header>
