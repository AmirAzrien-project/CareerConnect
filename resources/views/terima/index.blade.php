<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Senarai Pelajar Menghantar Borang Lapor Diri') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Students Submission Table -->
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">
                    Pelajar yang Telah Menghantar Borang Lapor Diri
                </h3>

                <!-- Live Search and Filter -->
                <div class="flex justify-between mb-6">
                    <!-- Search Bar Section -->
                    <div class="mb-8">
                        <input type="text" id="studentSearch" class="w-full p-4 rounded-lg bg-gray-100 dark:bg-gray-700 border-2 border-gray-300 dark:border-gray-600 text-gray-800 dark:text-gray-100 placeholder-gray-500 dark:placeholder-gray-300 focus:outline-none focus:border-indigo-600 focus:ring-1 focus:ring-indigo-600 transition" placeholder="Cari nama pelajar...">
                    </div>

                    <!-- Filter Section -->
                    <div class="mb-8 flex items-center space-x-4">
                        <select id="courseFilter" class="w-full p-4 rounded-lg bg-gray-100 dark:bg-gray-700 border-2 border-gray-300 dark:border-gray-600 text-gray-800 dark:text-gray-100 focus:outline-none focus:border-indigo-600 focus:ring-1 focus:ring-indigo-600 transition">
                            <option value="" disabled selected>Pilih Program</option>
                            <option value="CS230 - Bachelor of Computer Science (Hons.)">CS230 - Bachelor of Computer Science (Hons.)</option>
                            <option value="CS245 - BACHELOR OF COMPUTER SCIENCE (HONS.) DATA COMMUNICATION AND NETWORKING">CS245 - Bachelor of Computer Science (Hons.) Data Communication and Networking</option>
                            <option value="CS246 - Bachelor of Information Technology (Hons.) Information Systems Engineering">CS246 - Bachelor of Information Technology (Hons.) Information Systems Engineering</option>
                            <option value="CS251 - Bachelor of Computer Science (Hons.) Netcentric Computing">CS251 - Bachelor of Computer Science (Hons.) Netcentric Computing</option>
                            <option value="CS253 - Bachelor of Computer Science (Hons.) Multimedia Computing">CS253 - Bachelor of Computer Science (Hons.) Multimedia Computing</option>
                            <option value="CS255 - Bachelor of Computer Science (Hons.) Computer Networks">CS255 - Bachelor of Computer Science (Hons.) Computer Networks</option>
                            <option value="CS266 - Bachelor of Information Technology (Hons.) Information Systems Engineering">CS266 - Bachelor of Information Technology (Hons.) Information Systems Engineering</option>
                        </select>
                        <button id="filterButton" class="bg-indigo-600 text-white p-4 rounded-lg shadow-lg hover:bg-indigo-500 flex items-center space-x-2 transition duration-300">
                            <i class="fas fa-filter"></i>
                        </button>
                    </div>
                </div>

                <table class="min-w-full table-auto divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-indigo-600 text-white">
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-medium">Nama Pelajar</th>
                            <th class="px-6 py-3 text-left text-sm font-medium">Program</th>
                            <th class="px-6 py-3 text-left text-sm font-medium">Nama Syarikat</th>
                            <th class="px-6 py-3 text-left text-sm font-medium">Tarikh Hantar</th>
                            <th class="px-6 py-3 text-left text-sm font-medium">Fail</th>
                        </tr>
                    </thead>
                    <tbody id="studentList" class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse ($students as $student)
                        <tr class="student-item hover:bg-gray-100 dark:hover:bg-gray-700" data-course="{{ $student->student_course }}">
                            <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-300">{{ $student->student_name }}</td>
                            <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-300">{{ $student->student_course }}</td>
                            <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-300">{{ $student->company_name ?? '-' }}</td>
                            <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-300">
                                {{ \Carbon\Carbon::parse($student->submission_date)->format('d/m/Y') }}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-300">
                                @if ($student->document)
                                <a href="{{ asset('storage/dokumen/' . $student->document) }}"
                                    class="text-indigo-600 hover:underline" target="_blank">
                                    <i class="fas fa-file-alt mr-2"></i> Lihat Laporan
                                </a>
                                @else
                                Tiada Fail
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center text-gray-800 dark:text-gray-300">
                                Tiada pelajar yang telah menghantar borang Lapor Diri.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
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
                    const studentName = student.querySelector('td').textContent.toLowerCase();
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