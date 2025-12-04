<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-3xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Maklum Balas') }}
        </h2>
    </x-slot>

    <div class="py-12 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 p-10 rounded-3xl shadow-xl space-y-12">

                <!-- Section: Introduction -->
                <div class="text-center space-y-8">
                    <h3 class="text-2xl font-semibold text-gray-900 dark:text-gray-100">Maklum Balas Latihan Industri</h3>
                    <p class="text-lg text-gray-500 dark:text-gray-300 leading-relaxed">
                        Mengurus maklumat maklum balas mengenai latihan industri. Pastikan setiap maklumat yang dihantar disertakan dengan dokumen berkaitan.
                    </p>
                </div>

                <!-- Filter Section -->
                <div class="flex flex-col md:flex-row md:items-center md:justify-between space-y-6 md:space-y-0">
                    <div class="w-full md:w-2/3">
                        <label for="programFilter" class="block text-gray-700 dark:text-gray-300 font-medium mb-2">Tapis Mengikut Program:</label>
                        <select id="programFilter" class="block w-full p-3 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-2 focus:ring-indigo-500 transition">
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
                    <!--
                    <div>
                        <a href="{{ route('balas.create') }}"
                            class="inline-flex items-center px-6 py-3 bg-indigo-600 text-white font-semibold rounded-lg shadow hover:bg-indigo-700 focus:ring-2 focus:ring-indigo-500 transition transform hover:scale-105">
                            <i class="fas fa-plus mr-2"></i>Maklum Balas Baru
                        </a>
                    </div> -->
                </div>

                <!-- Table Section -->
                <div class="overflow-x-auto">
                    <table id="feedbackTable" class="min-w-full table-auto divide-y divide-gray-200 dark:divide-gray-700 bg-white dark:bg-gray-800 rounded-lg">
                        <thead class="bg-indigo-600 text-white">
                            <tr>
                                <th class="px-6 py-3 text-left text-sm font-medium">No Pelajar</th>
                                <th class="px-6 py-3 text-left text-sm font-medium">Nama</th>
                                <th class="px-6 py-3 text-left text-sm font-medium">Program</th>
                                <th class="px-6 py-3 text-left text-sm font-medium">Tarikh</th>
                                <th class="px-6 py-3 text-left text-sm font-medium">Dokumen</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach ($balas as $item)
                            <tr class="hover:bg-indigo-100 dark:hover:bg-gray-700">
                                <td class="px-6 py-4 text-sm font-medium text-gray-800 dark:text-gray-300">{{ $item->user_id }}</td>
                                <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-300">{{ $item->name }}</td>
                                <td class="px-6 py-4 text-sm font-medium text-gray-800 dark:text-gray-300">{{ $item->student_course }}</td>
                                <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-300">{{ \Carbon\Carbon::parse($item->date)->format('d/m/Y') }}</td>
                                <td class="px-6 py-4 text-sm font-medium">
                                    @if ($item->dokumen_balas)
                                    <a href="{{ asset('storage/dokumen/'.$item->dokumen_balas) }}" target="_blank"
                                        class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-600 transition duration-300 flex items-center space-x-2">
                                        <i class="fas fa-file-pdf w-4 h-4"></i>
                                        <span>Lihat Dokumen</span>
                                    </a>
                                    @else
                                    <span class="text-red-500">Dokumen tidak tersedia</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
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
            const rows = document.querySelectorAll('#feedbackTable tbody tr');

            rows.forEach(row => {
                const program = row.getAttribute('data-program');
                if (selectedProgram === '' || program === selectedProgram) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    </script>
</x-app-layout>