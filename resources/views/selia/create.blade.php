<x-app-layout>
    <x-slot name="header">
        <h2 class="text-4xl font-bold text-center mb-8">Penugasan Pelajar kepada Penyelia</h2>
        <p class="text-center text-lg mb-8">Pilih penyelia dahulu, kemudian pilih pelajar untuk penugasan.</p>
    </x-slot>

    <div class="container mx-auto py-10">
        <!-- Penyelia Selection -->
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-xl mb-6">
            <h3 class="text-2xl font-bold mb-4">Pilih Penyelia</h3>
            <form method="GET" action="{{ route('selia.create') }}">
                <select
                    id="penyeliaSelector"
                    name="penyelia_id"
                    class="w-full px-4 py-3 text-black bg-white-100 dark:bg-white-700 dark:text-black rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-200 ease-in-out hover:bg-gray-200">
                    <option value="" disabled selected>Pilih Penyelia</option>
                    @foreach ($penyelia as $item)
                    <option
                        value="{{ $item->id }}"
                        {{ session('selected_penyelia') && session('selected_penyelia')->id == $item->id ? 'selected' : '' }}
                        class="hover:bg-blue-600 transition-all duration-150">
                        {{ $item->name }}
                    </option>
                    @endforeach
                </select>
                <button type="submit" class="bg-blue-600 text-white px-5 py-3 rounded-lg shadow hover:bg-blue-700 transition-all mt-4">Pilih</button>
            </form>
        </div>

        @if(session('selected_penyelia'))
        <!-- Student List with Penyelia Info -->
        <div class="bg-white dark:bg-gray-800 p-8 rounded-lg shadow-xl mb-8">
            <!--<h3 class="text-2xl font-extrabold mb-6 text-center">
                Pelajar untuk Penyelia: {{ session('selected_penyelia')->name }}
            </h3>-->

            <h3 class="text-2xl font-extrabold mb-6 text-center">Senarai Pelajar Untuk Penyeliaan</h3>

            <!-- Filter & Search Bar -->
            <div class="flex flex-col lg:flex-row gap-6 mb-6 items-center justify-between">
                <!-- Program Filter Dropdown -->
                <div class="relative w-full lg:w-1/2">
                    <select id="programFilter" class="w-full px-5 py-3 text-gray-200 bg-gray-700 dark:bg-gray-600 rounded-lg shadow focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="" selected>Semua Program</option>
                        <option value="CS230 - Bachelor of Computer Science (Hons.)">CS230 - Bachelor of Computer Science (Hons.)</option>
                        <option value="CS245 - Bachelor of Computer Science (Hons.) Data Communication and Networking">CS245 - Bachelor of Computer Science (Hons.) Data Communication and Networking</option>
                        <option value="CS246 - Bachelor of Information Technology (Hons.) Information Systems Engineering">CS246 - Bachelor of Information Technology (Hons.) Information Systems Engineering</option>
                        <option value="CS251 - Bachelor of Computer Science (Hons.) Netcentric Computing">CS251 - Bachelor of Computer Science (Hons.) Netcentric Computing</option>
                        <option value="CS253 - Bachelor of Computer Science (Hons.) Multimedia Computing">CS253 - Bachelor of Computer Science (Hons.) Multimedia Computing</option>
                        <option value="CS255 - Bachelor of Computer Science (Hons.) Data Communication and Networking">CS255 - Bachelor of Computer Science (Hons.) Data Communication and Networking</option>
                        <option value="CS266 - Bachelor of Information Technology (Hons.) Information Systems Engineering">CS266 - Bachelor of Information Technology (Hons.) Information Systems Engineering</option>
                    </select>
                </div>

                <!-- Search Input -->
                <div class="relative w-full lg:w-1/2">
                    <input type="text" id="studentSearch" placeholder="Cari pelajar..." class="w-full px-5 py-3 text-gray-200 bg-gray-700 dark:bg-gray-600 rounded-lg shadow focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="absolute right-4 top-3 w-6 h-6 text-gray-400 pointer-events-none" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 15l5.5 5.5m-4.5-10.5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
            </div>

            <!-- Student List Table -->
            <form method="POST" action="{{ route('selia.store') }}">
                @csrf
                <div class="overflow-x-auto">
                    <table class="min-w-full table-auto bg-white dark:bg-gray-700 border-collapse border border-gray-300 rounded-lg shadow-md">
                        <thead class="bg-gray-900 text-white">
                            <tr>
                                <th class="py-3 px-6 text-left">Pilih</th>
                                <th class="py-3 px-6 text-left">Nama Pelajar</th>
                                <th class="py-3 px-6 text-left">Kursus Pelajar</th>
                                <th class="py-3 px-6 text-left">Penyelia</th>
                            </tr>
                        </thead>
                        <tbody id="studentTable">
                            @foreach ($students as $student)
                            <tr class="hover:bg-gray-800 transition-all duration-150" data-program="{{ $student->student_course }}">
                                <td class="py-4 px-6">
                                    <input
                                        type="checkbox"
                                        name="student_id[]"
                                        value="{{ $student->student_id }}"
                                        id="student_{{ $student->student_id }}"
                                        class="w-6 h-6 text-blue-600 border-gray-300 rounded focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                </td>
                                <td class="py-4 px-6 text-gray-900 dark:text-white">{{ $student->student_name }}</td>
                                <td class="py-4 px-6 text-gray-900 dark:text-white">{{ $student->student_course }}</td>
                                <td class="py-4 px-6 text-gray-900 dark:text-white">{{ $student->penyelia_name ?? 'Tiada Penyelia' }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Submit Button -->
                <div class="mt-8 flex justify-center">
                    <button
                        type="submit"
                        class="inline-flex items-center px-10 py-4 bg-gradient-to-r from-blue-500 to-blue-600 text-white text-xl font-semibold rounded-xl shadow-lg hover:from-blue-600 hover:to-blue-700 focus:ring-4 focus:ring-blue-400 focus:ring-offset-2 transition-all duration-300">
                        <svg class="w-7 h-7 mr-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Simpan
                    </button>
                </div>
            </form>
        </div>
        @endif
    </div>

    <script>
        // Auto-submit when penyelia is selected
        document.getElementById('penyeliaSelector').addEventListener('change', function() {
            const penyeliaId = this.value;
            if (penyeliaId) {
                const url = "{{ route('selia.create') }}";
                window.location.href = `${url}?penyelia_id=${penyeliaId}`;
            }
        });

        // Program filter functionality
        document.getElementById('programFilter').addEventListener('change', function() {
            const selectedProgram = this.value; // Ambil nilai dari dropdown filter
            const rows = document.querySelectorAll('#studentTable tr'); // Pastikan elemen <tr> dipilih dengan benar
            let hasVisibleRow = false;

            rows.forEach(row => {
                const program = row.getAttribute('data-program'); // Ambil atribut 'data-program' dari baris
                if (selectedProgram === '' || program === selectedProgram) {
                    row.style.display = ''; // Tampilkan baris jika cocok
                    hasVisibleRow = true;
                } else {
                    row.style.display = 'none'; // Sembunyikan baris jika tidak cocok
                }
            });

            // Jika tidak ada baris yang terlihat, Anda bisa menampilkan pesan
            const noResultsMessage = document.getElementById('noResultsMessage');
            if (!hasVisibleRow) {
                if (!noResultsMessage) {
                    const message = document.createElement('tr');
                    message.id = 'noResultsMessage';
                    message.innerHTML = `
                <td colspan="4" class="text-center text-gray-500 py-4">Tiada pelajar untuk program yang dipilih.</td>
            `;
                    document.querySelector('#studentTable').appendChild(message);
                }
            } else {
                if (noResultsMessage) {
                    noResultsMessage.remove();
                }
            }
        });


        // Search functionality for students
        document.getElementById('studentSearch').addEventListener('input', function() {
            const query = this.value.toLowerCase();
            const students = document.querySelectorAll('table tbody tr');

            students.forEach(student => {
                const studentName = student.querySelector('td:nth-child(2)').textContent.toLowerCase();
                if (studentName.includes(query)) {
                    student.style.display = '';
                } else {
                    student.style.display = 'none';
                }
            });
        });
    </script>
</x-app-layout>