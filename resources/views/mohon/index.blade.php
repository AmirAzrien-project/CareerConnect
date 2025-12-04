<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Senarai Permohonan BLI-01 Pelajar') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Instructions Section -->
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">
                    Permohonan BLI - 01
                </h3>
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    Pastikan semua maklumat lengkap sebelum menghantar borang permohonan. Klik butang
                    <span class="font-semibold text-indigo-600">"Permohonan Baru"</span> untuk membuat permohonan baru. Anda juga boleh mengedit borang dengan mengklik pada nama pelajar dalam jadual.
                </p>
                <p class="text-sm text-gray-600 dark:text-gray-400 mt-2">
                    Gunakan penapis di bawah untuk mencari permohonan mengikut program kursus.
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
            </div>

            <!-- Table Section -->
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
                <div class="mb-4">
                    <a href="{{ route('mohon.create') }}"
                        class="inline-flex items-center px-6 py-2 bg-green-600 text-white font-medium rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500">
                        <i class="fas fa-plus-circle mr-2"></i> Permohonan Baru
                    </a>
                </div>

                <table id="studentTable" class="min-w-full table-auto divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-indigo-600 text-white rounded-lg">
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-medium">No Pelajar</th>
                            <th class="px-6 py-3 text-left text-sm font-medium">Nama</th>
                            <th class="px-6 py-3 text-left text-sm font-medium">Program</th>
                            <th class="px-6 py-3 text-left text-sm font-medium">Tarikh</th>
                            <th class="px-6 py-3 text-left text-sm font-medium">Borang</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach ($mohons as $mohon)
                        <tr data-program="{{ $mohon->student_course }}" class="hover:bg-gray-100 dark:hover:bg-gray-700">
                            <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-300">{{ $mohon->user_id }}</td>
                            <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-300">
                                <a href="{{ route('mohon.edit', $mohon->id) }}" class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-600 transition duration-300 ease-in-out">
                                    {{ $mohon->name }}
                                </a>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-300">{{ $mohon->student_course }}</td>
                            <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-300">{{ \Carbon\Carbon::parse($mohon->date)->format('d/m/Y') }}</td>
                            <td class="px-6 py-4 text-sm font-medium">
                                @if($mohon->user && $mohon->user->cover_letter)
                                <a href="{{ asset('storage/cover_letters/'.$mohon->user->cover_letter) }}" target="_blank"
                                    class="inline-flex items-center text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-600 transition duration-300 ease-in-out">
                                    <i class="fas fa-file-pdf mr-2"></i> Borang SLI - 01
                                </a>
                                @else
                                <span class="text-gray-500">Tiada Dokumen</span>
                                @endif
                            </td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <p id="noResults" class="text-center text-gray-500 mt-4" style="display: none;">Tiada hasil dijumpai untuk penapis yang dipilih.</p>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script>
        document.getElementById('programFilter').addEventListener('change', function() {
            const selectedProgram = this.value;
            const rows = document.querySelectorAll('#studentTable tbody tr');
            let hasVisibleRow = false;

            rows.forEach(row => {
                const program = row.getAttribute('data-program');
                if (selectedProgram === '' || program === selectedProgram) {
                    row.classList.remove('hidden');
                    hasVisibleRow = true;
                } else {
                    row.classList.add('hidden');
                }
            });

            // Show or hide "No Results" message based on visible rows
            document.getElementById('noResults').style.display = hasVisibleRow ? 'none' : 'block';
        });
    </script>
</x-app-layout>