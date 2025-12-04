<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Senarai Pelajar dan Penyelia') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Students and Supervisors Table -->
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">
                    Senarai Pelajar dan Penyelia yang bertugas
                </h3>

                <!-- Live Search -->
                <div class="mb-6">
                    <input type="text" id="studentSearch" class="w-full p-4 rounded-lg bg-gray-100 dark:bg-gray-700 border-2 border-gray-300 dark:border-gray-600 text-gray-800 dark:text-gray-100 placeholder-gray-500 dark:placeholder-gray-300 focus:outline-none focus:border-indigo-600 focus:ring-1 focus:ring-indigo-600 transition" placeholder="Cari nama pelajar...">
                </div>

                <table class="min-w-full table-auto divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-indigo-600 text-white">
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-medium">ID Pelajar</th>
                            <th class="px-6 py-3 text-left text-sm font-medium">Nama Pelajar</th>
                            <th class="px-6 py-3 text-left text-sm font-medium">Program</th>
                            <th class="px-6 py-3 text-left text-sm font-medium">Penyelia</th>
                        </tr>
                    </thead>
                    <tbody id="studentList" class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach ($students as $student)
                        <tr class="student-item hover:bg-gray-100 dark:hover:bg-gray-700">
                            <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-300">{{ $student->student_id }}</td>
                            <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-300">{{ $student->student_name }}</td>
                            <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-300">{{ $student->student_course }}</td>
                            <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-300">
                                {{ $student->penyelia_name ?? '-' }}
                            </td>
                        </tr>
                        @endforeach

                        @if ($students->isEmpty())
                        <tr>
                            <td colspan="4" class="text-center text-gray-800 dark:text-gray-300">
                                Tiada pelajar dalam senarai.
                            </td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-6">
                {{ $students->links() }}
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
                    const studentName = student.querySelector('td:nth-child(2)').textContent.toLowerCase();
                    if (studentName.includes(query)) {
                        student.style.display = '';
                    } else {
                        student.style.display = 'none';
                    }
                });
            }, 500);
        });
    </script>
</x-app-layout>