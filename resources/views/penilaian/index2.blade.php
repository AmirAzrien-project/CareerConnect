<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Senarai Pelajar yang Telah Menyediakan Semua Fail') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            <!-- Introduction Section -->
            <div class="bg-indigo-100 dark:bg-gray-800 text-gray-800 dark:text-gray-200 p-6 rounded-lg shadow-md">
                <h3 class="text-lg font-bold mb-2">Maklumat Penting</h3>
                <p class="text-sm">
                    Di bawah adalah senarai pelajar yang telah menyerahkan semua fail (BLI05, BLI-06, FBLI-07, dan BLI-08).
                    Anda boleh menyemak status mereka dan pastikan maklumat dalam fail adalah lengkap dan terkini.
                </p>
            </div>

            <!-- Filter Section -->
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
                <div class="mb-6">
                    <label for="programFilter" class="block text-gray-300 font-medium mb-2">Tapis Mengikut Program:</label>
                    <select id="programFilter" class="block w-full p-3 bg-gray-100 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-2 focus:ring-indigo-500 transition">
                        <option value="" selected>Semua Program</option>
                        <option value="CS230 - Bachelor of Computer Science (Hons.)">CS230 - Bachelor of Computer Science (Hons.)</option>
                        <option value="CS245 - Bachelor of Computer Science (Hons.) Data Communication and Networking">CS245 - Bachelor of Computer Science (Hons.) Data Communication and Networking</option>
                        <option value="CS246 - Bachelor of Information Technology (Hons.) Information Systems Engineering">CS246 - Bachelor of Information Technology (Hons.) Information Systems Engineering</option>
                        <option value="CS251 - Bachelor of Computer Science (Hons.) Netcentric Computing">CS251 - Bachelor of Computer Science (Hons.) Netcentric Computing</option>
                        <option value="CS253 - Bachelor of Computer Science (Hons.) Multimedia Computing">CS253 - Bachelor of Computer Science (Hons.) Multimedia Computing</option>
                        <option value="CS255 - Bachelor of Computer Science (Hons.) Computer Networks">CS255 - Bachelor of Computer Science (Hons.) Computer Networks</option>
                        <option value="CS266 - Bachelor of Information Technology (Hons.) Information Systems Engineering">CS266 - Bachelor of Information Technology (Hons.) Information Systems Engineering</option>
                    </select>
                </div>

                <!-- Search Section -->
                <div class="mb-6">
                    <label for="studentSearch" class="block text-gray-300 font-medium mb-2">Cari Nama Pelajar:</label>
                    <input type="text" id="studentSearch" class="block w-full p-3 bg-gray-100 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-2 focus:ring-indigo-500 transition" placeholder="Cari nama pelajar...">
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
                <h3 class="text-lg font-bold text-gray-800 dark:text-gray-200 mb-6">Senarai Penilaian Pelajar</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-gray-100 dark:bg-gray-700 rounded-lg shadow-lg" id="logbookTable">
                        <thead class="bg-indigo-600 text-white">
                            <tr>
                                <th class="px-6 py-4 text-left text-sm font-medium">No Pelajar</th>
                                <th class="px-6 py-4 text-left text-sm font-medium">Nama Penuh</th>
                                <th class="px-6 py-4 text-left text-sm font-medium">Program</th> <!-- Shortened Program Column -->
                                <th class="px-6 py-4 text-left text-sm font-medium">Status Fail</th>
                                <th class="px-6 py-4 text-left text-sm font-medium"></th>
                                <th class="px-6 py-4 text-left text-sm font-medium"></th>
                                <th class="px-6 py-4 text-left text-sm font-medium"></th>
                                <th class="px-6 py-4 text-left text-sm font-medium"></th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-300 dark:divide-gray-600" id="studentList">
                            @forelse ($penilaian as $record)
                            <tr class="hover:bg-indigo-100 dark:hover:bg-indigo-800 transition-all duration-200 student-item" data-program="{{ $record->student->student_course }}">
                                <td class="px-6 py-4 text-sm font-medium text-gray-800 dark:text-gray-300">{{ $record->student_id }}</td>
                                <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-300">{{ $record->student->name }}</td>
                                <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-300">{{ Str::limit($record->student->student_course, 6) }}</td> <!-- Display shortened program code -->
                                <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-300">
                                    @if($record->statussatu == 'complete' && $record->statusdua == 'complete' && $record->statustiga == 'complete')
                                    <span class="bg-green-600 text-white px-2 py-1 rounded-md">Penilaian Lengkap</span>
                                    @else
                                    <span class="bg-red-600 text-white px-2 py-1 rounded-md">Belum Melengkapi Penilaian</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-300">
                                    <ul class="space-y-2">
                                        @if($record->failsatu)
                                        <li><a href="{{ asset('storage/' . $record->failsatu) }}" class="text-blue-600" target="_blank"><i class="fas fa-file-pdf mr-2"></i>BLI-05</a></li>
                                        @endif
                                    </ul>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-300">
                                    <ul class="space-y-2">
                                        @if($record->faildua)
                                        <li><a href="{{ asset('storage/' . $record->faildua) }}" class="text-blue-600" target="_blank"><i class="fas fa-file-pdf mr-2"></i>BLI-07</a></li>
                                        @endif
                                    </ul>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-300">
                                    <ul class="space-y-2">
                                        @if($record->failtiga)
                                        <li><a href="{{ asset('storage/' . $record->failtiga) }}" class="text-blue-600" target="_blank"><i class="fas fa-file-pdf mr-2"></i>BLI-06</a></li>
                                        @endif
                                    </ul>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-300">
                                    <ul class="space-y-2">
                                        @if($record->failempat)
                                        <li><a href="{{ asset('storage/' . $record->failempat) }}" class="text-blue-600" target="_blank"><i class="fas fa-file-pdf mr-2"></i>BLI-08</a></li>
                                        @endif
                                    </ul>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="px-6 py-4 text-sm text-gray-800 dark:text-gray-300 text-center">
                                    Tiada pelajar yang telah menyerahkan semua fail.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>


        </div>
    </div>

    <!-- JavaScript -->
    <script>
        // Debounced live search for student names
        let debounceTimer;
        document.getElementById('studentSearch').addEventListener('input', function() {
            const query = this.value.toLowerCase();
            clearTimeout(debounceTimer);

            debounceTimer = setTimeout(function() {
                const students = document.querySelectorAll('#studentList .student-item');

                students.forEach(student => {
                    const studentName = student.querySelector('td:nth-child(2)').textContent.toLowerCase(); // Targeting the 'Nama Penuh' column
                    if (studentName.includes(query)) {
                        student.style.display = '';
                    } else {
                        student.style.display = 'none';
                    }
                });
            }, 500); // Delay search for 500ms after typing stops
        });
    </script>
</x-app-layout>