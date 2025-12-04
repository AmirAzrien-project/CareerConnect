<x-app-layout>
    <x-slot name="header">
        <h2 class="font-extrabold text-3xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Senarai Pelajar Berdaftar') }}
        </h2>
        <p class="text-gray-600 dark:text-gray-400 mt-2 text-lg">Lihat profil dan maklumat pelajar yang berdaftar dalam sistem.</p>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">

                <!-- Search Bar Section -->
                <div class="mb-8">
                    <input type="text" id="studentSearch" class="w-full p-4 rounded-lg bg-gray-100 dark:bg-gray-700 border-2 border-gray-300 dark:border-gray-600 text-gray-800 dark:text-gray-100 placeholder-gray-500 dark:placeholder-gray-300 focus:outline-none focus:border-indigo-600 focus:ring-1 focus:ring-indigo-600 transition" placeholder="Cari nama pelajar...">
                </div>

                <!-- Filter Section -->
                <div class="mb-8 flex items-center space-x-4">
                    <select id="courseFilter" class="w-full p-4 rounded-lg bg-gray-100 dark:bg-gray-700 border-2 border-gray-300 dark:border-gray-600 text-gray-800 dark:text-gray-100 focus:outline-none focus:border-indigo-600 focus:ring-1 focus:ring-indigo-600 transition">
                        <option value="" disabled selected>Pilih Program</option>
                        <option value="CS230 - Bachelor of Computer Science (Hons.)">CS230 - Bachelor of Computer Science (Hons.)</option>
                        <option value="CS245 - BACHELOR OF COMPUTER SCIENCE (HONS.) Data Communication and Networking">CS245 - Bachelor of Computer Science (Hons.) Data Communication and Networking</option>
                        <option value="CS246 - Bachelor of Information Technology (Hons.) Information Systems Engineering">CS246 - Bachelor of Information Technology (Hons.) Information Systems Engineering</option>
                        <option value="CS251 - Bachelor of Computer Science (Hons.) Netcentric Computing">CS251 - Bachelor of Computer Science (Hons.) Netcentric Computing</option>
                        <option value="CS253 - Bachelor of Computer Science (Hons.) Multimedia Computing">CS253 - Bachelor of Computer Science (Hons.) Multimedia Computing</option>
                        <option value="CS255 - Bachelor of Computer Science (Hons.) Computer Networks">CS255 - Bachelor of Computer Science (Hons.) Computer Networks</option>
                        <option value="CS266 - Bachelor of Information Technology (Hons.) Information Systems Engineering">CS266 - Bachelor of Information Technology (Hons.) Information Systems Engineering</option>
                    </select>
                    <button id="filterButton" class="bg-indigo-600 text-white p-4 rounded-lg shadow-lg hover:bg-indigo-500 flex items-center space-x-2 transition duration-300">
                        <i class="fas fa-filter"></i>
                        <span></span>
                    </button>
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

                <div class="mt-8 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8" id="studentList">
                    @if($users->isEmpty())
                    <div class="col-span-full bg-gray-100 dark:bg-gray-700 p-6 rounded-lg shadow-lg text-center">
                        <p class="text-gray-600 dark:text-gray-400 text-xl font-semibold">Tiada pelajar tersedia.</p>
                    </div>
                    @else
                    @foreach($users as $user)
                    <div class="bg-gray-50 dark:bg-gray-700 rounded-lg overflow-hidden shadow-lg transform transition-transform hover:scale-105 hover:shadow-xl student-item" data-course="{{ $user->student_course }}">
                        <div class="p-6">
                            <div class="flex justify-between items-center">
                                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-100">{{ $user->name }}</h2>
                            </div>

                            <div class="mt-4 space-y-2">
                                <p class="text-sm text-gray-600 dark:text-gray-400"><strong>Emel:</strong> {{ $user->email }}</p>
                                <p class="text-sm text-gray-600 dark:text-gray-400"><strong>Semester:</strong> {{ $user->part }}</p>
                                <p class="text-sm text-gray-600 dark:text-gray-400"><strong>Program:</strong> {{ $user->student_course }}</p>
                            </div>
                        </div>

                        <!-- Action Buttons in Same Row -->
                        <div class="flex justify-between p-4">
                            <!-- Lihat Profil Button -->
                            <a href="{{ route('student.show', $user->id) }}" class="bg-blue-600 text-white p-3 rounded-lg shadow-lg hover:bg-blue-500 flex items-center space-x-2 transition duration-300">
                                <i class="fas fa-user-circle"></i>
                                <span>Lihat Profil</span>
                            </a>

                            @if(Auth::user()->type == 2) <!-- Check if the user is an admin -->
                            <!-- Padam Button -->
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Adakah anda pasti ingin memadam pelajar ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 text-white p-3 rounded-lg shadow-lg hover:bg-red-500 flex items-center space-x-2 transition duration-300">
                                    <i class="fas fa-trash-alt"></i>
                                    <span>Padam</span>
                                </button>
                            </form>
                            @endif

                        </div>
                    </div>
                    @endforeach
                    @endif
                </div>

            </div>
        </div>
    </div>

    <script>
        // Debounced live search for student names
        let debounceTimer;
        document.getElementById('studentSearch').addEventListener('input', function() {
            const query = this.value.toLowerCase();
            clearTimeout(debounceTimer);

            debounceTimer = setTimeout(function() {
                const students = document.querySelectorAll('#studentList .student-item');

                students.forEach(student => {
                    const studentName = student.querySelector('h2').textContent.toLowerCase();
                    if (studentName.includes(query)) {
                        student.style.display = '';
                    } else {
                        student.style.display = 'none';
                    }
                });
            }, 500); // Delay search for 500ms after typing stops
        });

        // Filter functionality based on student course
        document.getElementById('filterButton').addEventListener('click', function() {
            const courseFilterValue = document.getElementById('courseFilter').value.toLowerCase();
            const students = document.querySelectorAll('#studentList .student-item');

            students.forEach(student => {
                const studentCourse = student.getAttribute('data-course').toLowerCase();
                if (courseFilterValue === '' || studentCourse.includes(courseFilterValue)) {
                    student.style.display = '';
                } else {
                    student.style.display = 'none';
                }
            });
        });

        // Clear the query string when the page reloads
        window.onload = function() {
            if (window.location.search) {
                window.history.replaceState(null, null, window.location.pathname);
            }
        };
    </script>

</x-app-layout>