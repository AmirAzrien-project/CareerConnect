<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-4xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Senarai Pensyarah') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-xl p-8">

                <!-- Search Bar Section -->
                <div class="mb-8">
                    <input type="text" id="adminSearch" class="w-full p-4 rounded-lg bg-gray-100 dark:bg-gray-700 border-2 border-gray-300 dark:border-gray-600 text-gray-800 dark:text-gray-100 placeholder-gray-500 dark:placeholder-gray-300 focus:outline-none focus:border-indigo-600 focus:ring-1 focus:ring-indigo-600 transition" placeholder="Cari nama pensyarah...">
                </div>

                <!-- Action Section -->
                @if(Auth::user()->type == 2) <!-- Check if the user is an admin -->
                <div class="mt-12 flex justify-between items-center">
                    <div>
                        <a href="{{ route('manageuser.create') }}" class="bg-indigo-600 text-white px-6 py-3 rounded-full shadow-lg hover:bg-indigo-500 flex items-center space-x-2 transition duration-300">
                            <i class="fas fa-plus-circle"></i>
                            <span>Tambah Pengguna</span>
                        </a>
                    </div>
                </div>
                @endif

                <br>
                <br>
                
                <!-- Cards Section -->
                <div id="adminList" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                    @if($users->isEmpty())
                    <div class="col-span-3 text-center text-gray-600 dark:text-gray-400">
                        <p>Tiada pensyarah yang tersedia pada masa ini.</p>
                    </div>
                    @else
                    @foreach($users as $user)
                    <div class="bg-gray-50 dark:bg-gray-700 rounded-xl overflow-hidden shadow-lg transition-transform transform hover:scale-105 hover:shadow-2xl p-6 admin-item">
                        <div class="flex flex-col items-center text-center space-y-4">
                            <!-- Profile Image Section -->

                            <!-- Name & Job Title -->
                            <h3 class="text-2xl font-semibold text-gray-800 dark:text-gray-100">{{ $user->name }}</h3>
                            <p class="text-md text-gray-600 dark:text-gray-400">{{ $user->current_position }}</p>

                            <!-- Faculty Info -->
                            <p class="text-sm text-gray-600 dark:text-gray-400">Fakulti: {{ $user->faculty }}</p>

                            <!-- Action Button -->
                            <a href="{{ route('admin.show', $user->id) }}" class="text-indigo-600 dark:text-indigo-400 hover:underline mt-4 text-lg font-medium">Lihat Profil</a>
                        </div>
                    </div>
                    @endforeach
                    @endif
                </div>

                <!-- Action Section for Admin -->
                @if(Auth::user()->role == 2) <!-- Only visible to admin -->
                <div class="mt-12 flex justify-between items-center">
                    <div>
                        <h4 class="text-xl font-semibold text-gray-800 dark:text-gray-100">Tindakan Lanjut</h4>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Tambah, kemas kini, atau uruskan pensyarah dalam sistem.</p>
                    </div>
                    <div class="flex space-x-4">
                        <a href="{{ route('admin.create') }}" class="bg-indigo-600 text-white px-6 py-3 rounded-full shadow-lg hover:bg-indigo-500 flex items-center space-x-2 transition duration-300">
                            <i class="fas fa-plus-circle"></i>
                            <span>Tambah Pensyarah</span>
                        </a>
                        <a href="{{ route('admin.index') }}" class="bg-yellow-500 text-white px-6 py-3 rounded-full shadow-lg hover:bg-yellow-400 flex items-center space-x-2 transition duration-300">
                            <i class="fas fa-edit"></i>
                            <span>Kemas Kini Pensyarah</span>
                        </a>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>

    <script>
        // Debounced live search for admin names
        let debounceTimer;
        document.getElementById('adminSearch').addEventListener('input', function() {
            const query = this.value.toLowerCase();
            clearTimeout(debounceTimer);

            debounceTimer = setTimeout(function() {
                const admins = document.querySelectorAll('.admin-item');

                admins.forEach(admin => {
                    const adminName = admin.querySelector('h3').textContent.toLowerCase();
                    if (adminName.includes(query)) {
                        admin.style.display = '';
                    } else {
                        admin.style.display = 'none';
                    }
                });
            }, 500); // Delay search for 500ms after typing stops
        });

        // Clear the query string when the page reloads
        window.onload = function() {
            if (window.location.search) {
                window.history.replaceState(null, null, window.location.pathname);
            }
        };
    </script>

</x-app-layout>