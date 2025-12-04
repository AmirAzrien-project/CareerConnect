<nav x-data="{ open: false }" class="bg-gray-900 text-gray-100 border-b border-gray-700 shadow-lg">
    <!-- Header Utama -->
    <div class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-10 py-4">
        <div class="flex items-center">

            <!-- Navigasi Utama -->
            <div class="hidden md:flex space-x-6 items-center">

                @if (Auth::check() && Auth::user()->type === 1)
                <!-- PELAJAR --------------------------------------------------------------->
                <!-- PELAJAR --------------------------------------------------------------->
                <!-- PELAJAR --------------------------------------------------------------->

                <!-- Logo -->
                <div class="flex items-center space-x-4" id="logo-container">
                    <a href="{{ route('dashboard') }}" class="flex items-center space-x-2 text-white">
                        <h1 class="text-2xl font-bold tracking-wide hover:text-indigo-400 transition">
                            UITM Career Connect
                        </h1>
                    </a>
                </div>

                <!-- BORANG UTAMA --------------------------------------------------------------->
                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open" class="flex items-center px-4 py-2 bg-gray-800 text-gray-100 hover:bg-indigo-600 rounded-md text-sm font-medium shadow-lg">
                        <span class="mr-2">Borang Utama</span>
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06 0L10 10.939l3.71-3.72a.75.75 0 111.06 1.06l-4.25 4.25a.75.75 0 01-1.06 0L5.23 8.27a.75.75 0 010-1.06z" clip-rule="evenodd" />
                        </svg>
                    </button>
                    <div x-show="open" @click.away="open = false" class="absolute mt-2 w-60 bg-gray-800 shadow-md rounded-md py-2 z-20">
                        <a href="{{ route('mohon.create') }}" class="flex items-center px-4 py-2 hover:bg-indigo-600 transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                            Borang BLI-01
                        </a>
                        <a href="{{ route('mohon2.index') }}" class="flex items-center px-4 py-2 hover:bg-indigo-600 transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                            Permohonan
                        </a>
                        <a href="{{ route('balas.create') }}" class="flex items-center px-4 py-2 hover:bg-indigo-600 transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                            Maklum Balas
                        </a>
                        <a href="{{ route('terima.create') }}" class="flex items-center px-4 py-2 hover:bg-indigo-600 transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                            Lapor Diri
                        </a>
                        <a href="{{ route('selia.index') }}" class="flex items-center px-4 py-2 hover:bg-indigo-600 transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                            Maklumat Penyeliaan
                        </a>
                        <a href="{{ route('penilaian.index') }}" class="flex items-center px-4 py-2 hover:bg-indigo-600 transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                            Penilaian
                        </a>
                    </div>
                </div>

                <!-- BORANG PERIBADI --------------------------------------------------------------->
                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open" class="flex items-center px-4 py-2 bg-gray-800 text-gray-100 hover:bg-indigo-600 rounded-md text-sm font-medium shadow-lg">
                        <span class="mr-2">Dokumen Peribadi</span>
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06 0L10 10.939l3.71-3.72a.75.75 0 111.06 1.06l-4.25 4.25a.75.75 0 01-1.06 0L5.23 8.27a.75.75 0 010-1.06z" clip-rule="evenodd" />
                        </svg>
                    </button>
                    <div x-show="open" @click.away="open = false" class="absolute mt-2 w-60 bg-gray-800 shadow-md rounded-md py-2 z-20">
                        <a href="{{ route('resume.upload') }}" class="flex items-center px-4 py-2 hover:bg-indigo-600 transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                            Resume
                        </a>
                        <a href="{{ route('coverletter.upload') }}" class="flex items-center px-4 py-2 hover:bg-indigo-600 transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                            Cover Letter<br>(Borang SLI-01)
                        </a>
                        <a href="{{ route('logbook.upload') }}" class="flex items-center px-4 py-2 hover:bg-indigo-600 transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                            Logbook
                        </a>
                    </div>
                </div>

                <!-- PENGGUNA LAIN --------------------------------------------------------------->
                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open" class="flex items-center px-4 py-2 bg-gray-800 text-gray-100 hover:bg-indigo-600 rounded-md text-sm font-medium shadow-lg">
                        <span class="mr-2">Maklumat Pengguna</span>
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06 0L10 10.939l3.71-3.72a.75.75 0 111.06 1.06l-4.25 4.25a.75.75 0 01-1.06 0L5.23 8.27a.75.75 0 010-1.06z" clip-rule="evenodd" />
                        </svg>
                    </button>
                    <div x-show="open" @click.away="open = false" class="absolute mt-2 w-60 bg-gray-800 shadow-md rounded-md py-2 z-20">
                        <a href="{{ route('student.index') }}" class="flex items-center px-4 py-2 hover:bg-indigo-600 transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                            Pelajar
                        </a>
                        <a href="{{ route('admin.index') }}" class="flex items-center px-4 py-2 hover:bg-indigo-600 transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                            Pensyarah
                        </a>
                    </div>
                </div>



                @elseif (Auth::check() && Auth::user()->type === 2)
                <!-- Admin Links --------------------------------------------------------------------------------------------->
                <!-- Admin Links --------------------------------------------------------------------------------------------->
                <!-- Admin Links --------------------------------------------------------------------------------------------->

                <!-- Logo -->
                <div class="flex items-center space-x-4" id="logo-container2">
                    <a href="{{ route('adminDashboardShow') }}" class="flex items-center space-x-2 text-white">
                        <h1 class="text-2xl font-bold tracking-wide hover:text-indigo-400 transition">
                            UITM Career Connect
                        </h1>
                    </a>
                </div>

                <!-- BORANG UTAMA --------------------------------------------------------------->
                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open" class="flex items-center px-4 py-2 bg-gray-800 text-gray-100 hover:bg-indigo-600 rounded-md text-sm font-medium shadow-lg">
                        <span class="mr-2">Borang - Borang</span>
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06 0L10 10.939l3.71-3.72a.75.75 0 111.06 1.06l-4.25 4.25a.75.75 0 01-1.06 0L5.23 8.27a.75.75 0 010-1.06z" clip-rule="evenodd" />
                        </svg>
                    </button>
                    <div x-show="open" @click.away="open = false" class="absolute mt-2 w-60 bg-gray-800 shadow-md rounded-md py-2 z-20">
                        <a href="{{ route('resume.index') }}" class="flex items-center px-4 py-2 hover:bg-indigo-600 transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                            Resume
                        </a>
                        <a href="{{ route('logbook.index') }}" class="flex items-center px-4 py-2 hover:bg-indigo-600 transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                            Logbook
                        </a>
                        <a href="{{ route('mohon.index') }}" class="flex items-center px-4 py-2 hover:bg-indigo-600 transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                            Cover Letter<br>(Borang BLI-01)
                        </a>
                        <a href="{{ route('mohon2.create') }}" class="flex items-center px-4 py-2 hover:bg-indigo-600 transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                            SLI-02 & BLI-02
                        </a>
                        <a href="{{ route('balas.index') }}" class="flex items-center px-4 py-2 hover:bg-indigo-600 transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg> Maklum Balas
                        </a>
                        <a href="{{ route('terima.index') }}" class="flex items-center px-4 py-2 hover:bg-indigo-600 transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                            Lapor Diri
                        </a>
                        <a href="{{ route('penilaian.index2') }}" class="flex items-center px-4 py-2 hover:bg-indigo-600 transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                            Laporan Penilaian
                        </a>
                    </div>
                </div>

                <!-- PENYELIA LAIN --------------------------------------------------------------->
                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open" class="flex items-center px-4 py-2 bg-gray-800 text-gray-100 hover:bg-indigo-600 rounded-md text-sm font-medium shadow-lg">
                        <span class="mr-2">Maklumat Penyeliaan</span>
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06 0L10 10.939l3.71-3.72a.75.75 0 111.06 1.06l-4.25 4.25a.75.75 0 01-1.06 0L5.23 8.27a.75.75 0 010-1.06z" clip-rule="evenodd" />
                        </svg>
                    </button>
                    <div x-show="open" @click.away="open = false" class="absolute mt-2 w-60 bg-gray-800 shadow-md rounded-md py-2 z-20">
                        <a href="{{ route('selia.create') }}" class="flex items-center px-4 py-2 hover:bg-indigo-600 transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                            Penyeliaan
                        </a>
                    </div>
                </div>

                <!-- PENGGUNA LAIN --------------------------------------------------------------->
                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open" class="flex items-center px-4 py-2 bg-gray-800 text-gray-100 hover:bg-indigo-600 rounded-md text-sm font-medium shadow-lg">
                        <span class="mr-2">Maklumat Pengguna</span>
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06 0L10 10.939l3.71-3.72a.75.75 0 111.06 1.06l-4.25 4.25a.75.75 0 01-1.06 0L5.23 8.27a.75.75 0 010-1.06z" clip-rule="evenodd" />
                        </svg>
                    </button>
                    <div x-show="open" @click.away="open = false" class="absolute mt-2 w-60 bg-gray-800 shadow-md rounded-md py-2 z-20">
                        <a href="{{ route('student.index') }}" class="flex items-center px-4 py-2 hover:bg-indigo-600 transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                            Pelajar
                        </a>
                        <a href="{{ route('admin.index') }}" class="flex items-center px-4 py-2 hover:bg-indigo-600 transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                            Pensyarah
                        </a>
                    </div>
                </div>


                @elseif (Auth::check() && Auth::user()->type === 3)
                <!-- Penyelia Links --------------------------------------------------------------------------------------------->
                <!-- Penyelia Links --------------------------------------------------------------------------------------------->
                <!-- Penyelia Links --------------------------------------------------------------------------------------------->

                <!-- Logo -->
                <div class="flex items-center space-x-4" id="logo-container3">
                    <a href="{{ route('penyeliaDashboardShow') }}" class="flex items-center space-x-2 text-white">
                        <h1 class="text-2xl font-bold tracking-wide hover:text-indigo-400 transition">
                            UITM Career Connect
                        </h1>
                    </a>
                </div>

                <!-- BORANG UTAMA --------------------------------------------------------------->
                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open" class="flex items-center px-4 py-2 bg-gray-800 text-gray-100 hover:bg-indigo-600 rounded-md text-sm font-medium shadow-lg">
                        <span class="mr-2">Pelajar Pantauan</span>
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06 0L10 10.939l3.71-3.72a.75.75 0 111.06 1.06l-4.25 4.25a.75.75 0 01-1.06 0L5.23 8.27a.75.75 0 010-1.06z" clip-rule="evenodd" />
                        </svg>
                    </button>
                    <div x-show="open" @click.away="open = false" class="absolute mt-2 w-60 bg-gray-800 shadow-md rounded-md py-2 z-20">
                        <a href="{{ route('selia.create') }}" class="flex items-center px-4 py-2 hover:bg-indigo-600 transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                            Penyeliaan
                        </a>
                        <a href="{{ route('paparan.index') }}" class="flex items-center px-4 py-2 hover:bg-indigo-600 transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                            Maklumat Pelajar
                        </a>
                        <a href="{{ route('penilaian.index2') }}" class="flex items-center px-4 py-2 hover:bg-indigo-600 transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                            Laporan Penilaian
                        </a>
                    </div>
                </div>

                <!-- PENGGUNA LAIN --------------------------------------------------------------->
                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open" class="flex items-center px-4 py-2 bg-gray-800 text-gray-100 hover:bg-indigo-600 rounded-md text-sm font-medium shadow-lg">
                        <span class="mr-2">Maklumat Pengguna</span>
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06 0L10 10.939l3.71-3.72a.75.75 0 111.06 1.06l-4.25 4.25a.75.75 0 01-1.06 0L5.23 8.27a.75.75 0 010-1.06z" clip-rule="evenodd" />
                        </svg>
                    </button>
                    <div x-show="open" @click.away="open = false" class="absolute mt-2 w-60 bg-gray-800 shadow-md rounded-md py-2 z-20">
                        <a href="{{ route('student.index') }}" class="flex items-center px-4 py-2 hover:bg-indigo-600 transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                            Pelajar
                        </a>
                        <a href="{{ route('admin.index') }}" class="flex items-center px-4 py-2 hover:bg-indigo-600 transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                            Pensyarah
                        </a>
                    </div>
                </div>
                @endif


                <!-- Profil Pengguna -->
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center px-4 py-2 bg-gray-800 text-gray-100 hover:bg-indigo-600 rounded-md text-sm font-medium shadow-lg">
                            <div class="mr-2">{{ Auth::user()->name }}</div>
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06 0L10 10.939l3.71-3.72a.75.75 0 111.06 1.06l-4.25 4.25a.75.75 0 01-1.06 0L5.23 8.27a.75.75 0 010-1.06z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')"> Profil </x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                                Log Keluar
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
        </div>
    </div>

    <script>
        // Get the logo container and nav button container
        const logoContainer = document.getElementById('logo-container');
        const logoContainer2 = document.getElementById('logo-container2');
        const logoContainer3 = document.getElementById('logo-container3');

        const navButtons = document.getElementById('nav-buttons');

        // Function to generate a random margin value (for logoContainer)
        function generateRandomSpacing() {
            return Math.floor(Math.random() * 30) + 130; // Random spacing between 180px and 210px
        }

        // Function to generate a random margin value (for logoContainer2)
        function generateRandomSpacing2() {
            return Math.floor(Math.random() * 30) + 100; // Random spacing between 200px and 230px
        }

        // Function to generate a random margin value (for logoContainer3)
        function generateRandomSpacing3() {
            return Math.floor(Math.random() * 30) + 300; // Random spacing between 200px and 230px
        }

        // Function to generate a random margin value (for navButtons)
        function generateRandomSpacing4() {
            return Math.floor(Math.random() * 50) + 150; // Random spacing between 150px and 200px
        }

        // Set a random margin-right to the logo containers
        if (logoContainer) {
            logoContainer.style.marginRight = generateRandomSpacing() + 'px';
        }

        if (logoContainer2) {
            logoContainer2.style.marginRight = generateRandomSpacing2() + 'px';
        }

        if (logoContainer3) {
            logoContainer3.style.marginRight = generateRandomSpacing3() + 'px';
        }

        // Set a random margin-right to the nav buttons container
        if (navButtons) {
            navButtons.style.marginRight = generateRandomSpacing4() + 'px';
        }
    </script>


</nav>