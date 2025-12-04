<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Senarai Resume Yang Dimuat Naik') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            <!-- Introduction Section -->
            <div class="bg-indigo-100 dark:bg-gray-800 text-gray-800 dark:text-gray-200 p-6 rounded-lg shadow-md">
                <h3 class="text-lg font-bold mb-2">Maklumat Penting</h3>
                <p class="text-sm">
                    Di bawah adalah senarai resume yang telah dimuat naik oleh pelajar.
                    Anda boleh menyemak resume tersebut dan pastikan maklumat dalam resume adalah lengkap dan terkini.
                </p>
            </div>

            <!-- Upload Section
            <div class="flex justify-between items-center bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Muat Naik Resume Baru</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Klik butang di bawah untuk memuat naik resume anda.</p>
                </div>
                <a href="{{ route('resume.upload') }}"
                    class="inline-flex items-center px-6 py-3 bg-green-600 text-white font-medium rounded-lg shadow-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500">
                    <i class="fas fa-upload mr-2"></i> {{ __('Muat Naik Resume') }}
                </a>
            </div> -->

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
            </div>

            <!-- Resumes Table Section -->
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
                <h3 class="text-lg font-bold text-gray-800 dark:text-gray-200 mb-6">Senarai Resume</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-gray-100 dark:bg-gray-700 rounded-lg shadow-lg" id="logbookTable">
                        <thead class="bg-indigo-600 text-white">
                            <tr>
                                <th class="px-6 py-4 text-left text-sm font-medium">No Pelajar</th>
                                <th class="px-6 py-4 text-left text-sm font-medium">Nama Penuh</th>
                                <th class="px-6 py-4 text-left text-sm font-medium">Program</th>
                                <th class="px-6 py-4 text-left text-sm font-medium">Resume</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-300 dark:divide-gray-600">
                            @forelse ($users as $user)
                            <tr class="hover:bg-indigo-100 dark:hover:bg-indigo-800 transition-all duration-200" data-program="{{ $user->student_course }}">
                                <td class="px-6 py-4 text-sm font-medium text-gray-800 dark:text-gray-300">{{ $user->user_id }}</td>
                                <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-300">{{ $user->name }}</td>
                                <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-300">{{ $user->student_course }}</td>
                                <td class="px-6 py-4 text-sm font-medium">
                                    <a href="{{ asset('storage/'.$user->resume) }}" target="_blank"
                                        class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                        <i class="fas fa-file-alt mr-2"></i> Lihat Resume
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-sm text-gray-800 dark:text-gray-300 text-center">
                                    Tiada resume dijumpai.
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
        document.getElementById('programFilter').addEventListener('change', function() {
            const selectedProgram = this.value;
            const rows = document.querySelectorAll('#logbookTable tbody tr');
            let hasVisibleRow = false;

            rows.forEach(row => {
                const program = row.getAttribute('data-program');
                if (selectedProgram === '' || program === selectedProgram) {
                    row.style.display = '';
                    hasVisibleRow = true;
                } else {
                    row.style.display = 'none';
                }
            });

            // If no rows are visible, show a message
            const noResults = document.getElementById('noResults');
            if (!hasVisibleRow) {
                if (!noResults) {
                    const noResultsMessage = document.createElement('tr');
                    noResultsMessage.id = 'noResults';
                    noResultsMessage.innerHTML = '<td colspan="4" class="px-6 py-4 text-sm text-gray-800 dark:text-gray-300 text-center">Tiada resume dijumpai untuk program yang dipilih.</td>';
                    document.querySelector('#logbookTable tbody').appendChild(noResultsMessage);
                }
            } else {
                if (noResults) {
                    noResults.remove();
                }
            }
        });
    </script>
</x-app-layout>