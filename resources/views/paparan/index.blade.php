<x-app-layout>
    <x-slot name="header">
        <h2 class="text-5xl font-extrabold text-indigo-900 dark:text-indigo-300 text-center">
            {{ __('Senarai Pelajar') }}
        </h2>
        <p class="text-lg text-gray-800 dark:text-gray-200 mt-4 text-center">
            Semak maklumat lengkap pelajar, termasuk lokasi syarikat mereka, dan muat turun dokumen penting.
        </p>
    </x-slot>

    <div class="py-16">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Hero Section -->
            <div class="bg-gradient-to-r from-indigo-600 to-indigo-500 text-white rounded-3xl shadow-lg p-8 mb-12">
                <div class="text-center">
                    <h3 class="text-4xl font-extrabold mb-4">Selamat Datang ke Paparan Pelajar</h3>
                    <p class="text-lg mb-6">Klik pada dokumen untuk muat turun, atau gunakan butang untuk navigasi lebih pantas.</p>
                    <div class="mt-6 flex justify-center space-x-6">
                        <a href="#table-section" id="scrollToTable" class="bg-teal-500 text-white py-3 px-8 rounded-full shadow-md hover:bg-teal-600 transform transition hover:scale-105">
                            <i class="fas fa-list"></i> <span class="ml-2">Senarai Pelajar</span>
                        </a>
                        <a href="{{ route('penyeliaDashboardShow') }}" class="bg-gray-800 text-white py-3 px-8 rounded-full shadow-md hover:bg-gray-700 transform transition hover:scale-105">
                            <i class="fas fa-arrow-left"></i> <span class="ml-2">Kembali ke Dashboard</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Table Section -->
            <div id="table-section" class="bg-white dark:bg-gray-800 rounded-3xl shadow-lg p-12">
                <div class="mb-8 text-center">
                    <h3 class="text-5xl font-extrabold text-gray-800 dark:text-white mb-4">{{ __('Maklumat Pelajar') }}</h3>
                    <p class="text-lg text-teal-500 font-medium">Senarai lengkap pelajar bersama lokasi syarikat dan dokumen berkaitan.</p>
                </div>

                <!-- Search Input -->
                <div class="mb-8 text-center">
                    <input type="text" id="studentSearch" class="w-1/2 p-2 border-2 rounded-lg text-black" placeholder="Cari Pelajar...">
                </div>

                <!-- List of Students -->
                <div id="studentList" class="space-y-6">
                    @foreach ($students as $selia)
                    <div class="student-item bg-white dark:bg-gray-600 p-6 rounded-xl shadow-md hover:shadow-xl transition-transform transform hover:scale-105">
                        <div class="flex justify-between items-center mb-4">
                            <h4 class="text-2xl font-semibold text-teal-700 dark:text-teal-300">{{ $selia->student->name }}</h4>
                        </div>

                        <div class="pl-6 mt-2 space-y-4">
                            <!-- Display User ID -->
                            <div class="flex items-center space-x-2">
                                <i class="fas fa-id-card text-indigo-500"></i>
                                <strong class="text-teal-700 dark:text-teal-200">No Pelajar:</strong>
                                <span class="text-gray-800 dark:text-gray-200">{{ $selia->student_id }}</span>
                            </div>

                            <!-- Display IC Number -->
                            <div class="flex items-center space-x-2">
                                <i class="fas fa-id-badge text-blue-500"></i>
                                <strong class="text-teal-700 dark:text-teal-200">No. IC:</strong>
                                <span class="text-gray-800 dark:text-gray-200">{{ $selia->student->no_ic ?? 'Tiada Data' }}</span>
                            </div>

                            <!-- Display Company Name -->
                            <div class="flex items-center space-x-2">
                                <i class="fas fa-building text-purple-500"></i>
                                <strong class="text-teal-700 dark:text-teal-200">Syarikat:</strong>
                                <span class="text-gray-800 dark:text-gray-200">{{ $selia->terima->company_name ?? 'Tiada Data' }}</span>
                            </div>

                            <!-- Button to toggle Lawatan status -->
                            <div class="flex items-center space-x-2 mb-4">
                                <i class="fas fa-calendar-check text-yellow-500" title="Lawatan Terjadual"></i>
                                <strong class="text-teal-700 dark:text-teal-200">Lawatan:</strong>
                                <span id="status-label-{{ $selia->student_id }}" class="text-lg font-semibold text-teal-700 dark:text-teal-200 ml-4">
                                    {{ strtoupper($selia->lawatan_status) }}
                                </span>
                                <button id="toggle-lawatan-{{ $selia->student_id }}"
                                    class="slider-btn bg-yellow-500 text-white py-2 px-6 rounded-md hover:bg-yellow-600 relative flex items-center">
                                    <span id="lawatan-status-{{ $selia->student_id }}" class="slider-text">
                                        {{ $selia->lawatan_status }}
                                    </span>
                                    <span class="slider-indicator"></span>
                                </button>
                            </div>

                            <div class="flex flex-col space-y-2 bg-white dark:bg-gray-800 p-4 rounded-lg shadow-lg">
                                <!-- Student Info and Location -->
                                <div class="flex items-center space-x-2">
                                    <i class="fas fa-map-marker-alt text-red-500"></i>
                                    <strong class="text-teal-700 dark:text-teal-200">Lokasi Syarikat:</strong>
                                    @if ($selia->terima)
                                    <button onclick="toggleMap('{{ $selia->student_id }}', {{ $selia->terima->latitude }}, {{ $selia->terima->longitude }})"
                                        class="bg-blue-500 text-white py-1 px-4 rounded-md hover:bg-blue-600 ml-4">
                                        Lihat Lokasi
                                    </button>
                                    @else
                                    <span class="italic text-gray-500 dark:text-gray-400">Tiada Data</span>
                                    @endif
                                </div>

                                <!-- Map Container (hidden initially) -->
                                @if ($selia->terima)
                                <div id="map-container-{{ $selia->student_id }}"
                                    style="display: none; height: 200px;"
                                    class="rounded-lg shadow-md mt-4">
                                </div>
                                @endif
                            </div>

                            <!-- Button to toggle the dropdown -->
                            <div class="flex items-center space-x-2 mb-4">
                                <button id="toggle-files-{{ $selia->student_id }}"
                                    class="bg-teal-500 text-white py-2 px-6 rounded-md hover:bg-teal-600">
                                    <i class="fas fa-file-alt"></i> <span class="ml-2">Lihat Dokumen</span>
                                </button>
                            </div>

                            <!-- Dropdown to show files -->
                            <div id="files-dropdown-{{ $selia->student_id }}" class="hidden space-y-4 pl-6">
                                <!-- Resume (from 'users' table) -->
                                <div class="flex items-center space-x-2">
                                    <i class="fas fa-file-pdf text-red-500"></i>
                                    <strong class="text-teal-700 dark:text-teal-200">Resume:</strong>
                                    @if ($selia->student->resume && file_exists(public_path('storage/' . $selia->student->resume)))
                                    <a href="{{ asset('storage/' . $selia->student->resume) }}" class="text-teal-500 hover:underline" target="_blank">
                                        Muat Turun
                                    </a>
                                    @else
                                    <span class="italic text-gray-500 dark:text-gray-400">Tiada Data</span>
                                    @endif
                                </div>

                                <!-- Cover Letter (from 'users' table) -->
                                <div class="flex items-center space-x-2">
                                    <i class="fas fa-file-alt text-yellow-500"></i>
                                    <strong class="text-teal-700 dark:text-teal-200">Cover Letter:</strong>
                                    @if ($selia->student->cover_letter && file_exists(public_path('storage/cover_letters/' . $selia->student->cover_letter)))
                                    <a href="{{ asset('storage/cover_letters/' . $selia->student->cover_letter) }}" class="text-teal-500 hover:underline" target="_blank">
                                        Muat Turun
                                    </a>
                                    @else
                                    <span class="italic text-gray-500 dark:text-gray-400">Tiada Data</span>
                                    @endif
                                </div>

                                <!-- Logbook (from 'users' table) -->
                                <div class="flex items-center space-x-2">
                                    <i class="fas fa-book text-green-500"></i>
                                    <strong class="text-teal-700 dark:text-teal-200">Logbook:</strong>
                                    @if ($selia->student->logbook && file_exists(public_path('storage/' . $selia->student->logbook)))
                                    <a href="{{ asset('storage/' . $selia->student->logbook) }}" class="text-teal-500 hover:underline" target="_blank">
                                        Muat Turun
                                    </a>
                                    @else
                                    <span class="italic text-gray-500 dark:text-gray-400">Tiada Data</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('[id^="toggle-lawatan-"]').forEach(function(button) {
            button.addEventListener('click', function() {
                const studentId = button.id.split('-').pop(); // Get studentId from button ID
                const lawatanStatusElement = document.getElementById('lawatan-status-' + studentId);
                const statusLabel = document.getElementById('status-label-' + studentId); // Add this line to update the status label
                const sliderButton = button;

                // Send AJAX request to update the lawatan_status
                fetch(`/selia/${studentId}/lawatan-status`, {
                        method: 'PATCH',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        },
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'success') {
                            // Toggle the button and the text
                            if (lawatanStatusElement.textContent === 'Belum') {
                                lawatanStatusElement.textContent = 'Selesai';
                                statusLabel.textContent = 'SELESAI'; // Update the label
                                sliderButton.classList.add('active');
                                lawatanStatusElement.classList.remove('Belum');
                                lawatanStatusElement.classList.add('Selesai');
                            } else {
                                lawatanStatusElement.textContent = 'Belum';
                                statusLabel.textContent = 'BELUM'; // Update the label
                                sliderButton.classList.remove('active');
                                lawatanStatusElement.classList.remove('Selesai');
                                lawatanStatusElement.classList.add('Belum');
                            }
                        } else {
                            alert('Error updating status.');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('An error occurred.');
                    });
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.slider-btn').forEach(function(button) {
                const lawatanStatusElement = button.querySelector('.slider-text');
                if (lawatanStatusElement.textContent === 'Selesai') {
                    button.classList.add('active');
                    lawatanStatusElement.classList.add('Selesai');
                } else {
                    lawatanStatusElement.classList.add('Belum');
                }
            });
        });
    </script>

    <script>
        // JavaScript to toggle the dropdown visibility
        document.querySelectorAll('[id^="toggle-files-"]').forEach(function(button) {
            button.addEventListener('click', function() {
                const studentId = button.id.split('-').pop();
                const dropdown = document.getElementById('files-dropdown-' + studentId);

                // Toggle the visibility of the dropdown
                if (dropdown.style.display === 'none' || dropdown.style.display === '') {
                    dropdown.style.display = 'block';
                } else {
                    dropdown.style.display = 'none';
                }
            });
        });
    </script>

    <script>
        function toggleMap(studentId, lat, lng) {
            const mapContainer = document.getElementById(`map-container-${studentId}`);

            if (!lat || !lng) {
                alert('Lokasi tidak tersedia.');
                return;
            }

            // Toggle visibility of the map container
            if (mapContainer.style.display === 'none' || mapContainer.style.display === '') {
                mapContainer.style.display = 'block';

                // Initialize the map only if it hasn't been initialized yet
                if (!mapContainer.dataset.mapInitialized) {
                    const map = L.map(mapContainer).setView([lat, lng], 15);

                    // Add OpenStreetMap tiles
                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        maxZoom: 19,
                        attribution: '© OpenStreetMap contributors'
                    }).addTo(map);

                    // Add a marker for the location
                    L.marker([lat, lng])
                        .addTo(map)
                        .bindPopup('Lokasi Syarikat')
                        .openPopup();

                    // Mark the container as initialized
                    mapContainer.dataset.mapInitialized = true;
                }
            } else {
                mapContainer.style.display = 'none';
            }
        }
    </script>

    <!-- Leaflet.js CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

    <!-- Leaflet.js JavaScript -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <script>
        document.getElementById("studentSearch").addEventListener("input", function() {
            const searchQuery = this.value.toLowerCase();
            const students = document.querySelectorAll(".student-item");

            students.forEach(function(student) {
                const studentName = student.querySelector("h4").textContent.toLowerCase();
                if (studentName.includes(searchQuery)) {
                    student.style.display = "block";
                } else {
                    student.style.display = "none";
                }
            });
        });
    </script>

</x-app-layout>