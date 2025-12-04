<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Borang Lapor Diri Latihan Industri') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 space-y-12">

            <!-- Seksyen Penghantaran Borang -->
            <div class="bg-white dark:bg-gray-800 shadow-xl rounded-xl p-8 space-y-6">
                <div class="mb-6 flex justify-between items-center">
                    <h3 class="text-2xl font-semibold text-gray-800 dark:text-gray-100">
                        Sila Muat Naik Borang Lapor Diri
                    </h3>
                </div>

                <!-- Paparan Mesej Kejayaan -->
                @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-800 p-4 rounded-lg shadow-md mb-6">
                    {{ session('success') }}
                </div>
                @endif

                <!-- Borang Penghantaran -->
                <form action="{{ route('terima.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                    @csrf

                    <!-- No Pelajar -->
                    <div class="space-y-2">
                        <label for="user_id" class="block text-gray-700 dark:text-gray-300 font-medium">
                            No Pelajar
                        </label>
                        <x-text-input id="user_id" name="user_id" type="text" class="block w-full mt-1 rounded-xl shadow-sm border border-gray-300 dark:border-gray-600" value="{{ Auth::user()->user_id }}" required readonly />
                        <x-input-error :messages="$errors->get('user_id')" class="mt-2" />
                    </div>

                    <!-- Nama Penuh -->
                    <div class="space-y-2">
                        <label for="name" class="block text-gray-700 dark:text-gray-300 font-medium">
                            Nama Penuh
                        </label>
                        <x-text-input id="name" name="name" type="text" class="block w-full mt-1 rounded-xl shadow-sm border border-gray-300 dark:border-gray-600" value="{{ Auth::user()->name }}" oninput="this.value = this.value.toUpperCase();" required readonly />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- Nama Syarikat -->
                    <div class="space-y-2">
                        <label for="company_name" class="block text-gray-700 dark:text-gray-300 font-medium">
                            Nama Syarikat
                        </label>
                        <x-text-input id="company_name" name="company_name" type="text" class="block w-full mt-1 rounded-xl shadow-sm border border-gray-300 dark:border-gray-600" value="{{ old('company_name') }}" required />
                        <x-input-error :messages="$errors->get('company_name')" class="mt-2" />
                    </div>

                    <!-- Map -->
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-8 mt-6">
                        <h3 class="text-2xl font-semibold text-indigo-600 dark:text-indigo-300 mb-6">Lokasi Tempat Latihan Industri</h3>

                        <p id="location-warning" style="color: red; font-weight: bold; margin-top: 10px;">
                            Nota: Lokasi anda mungkin tidak tepat bergantung kepada peranti, pelayar, dan rangkaian anda.<br>
                            Sila gunakan Penanda (biru) untuk menetapkan lokasi.<br>
                            *Penanda merah hanya memaparkan lokasi yang dicari.
                        </p>

                        <div id="map" style="width: 100%; height: 400px;"></div><br>

                        <!-- Instruction for moving the pin -->
                        <p class="text-gray-700 dark:text-gray-300 mb-4">
                            Anda boleh menggerakkan penanda di peta ke lokasi yang dikehendaki dengan menyeret penanda ke tempat yang tepat.
                        </p>
                        <p class="text-gray-700 dark:text-gray-300 mb-4">
                            Atau menggunakan 'Search Bar' di dalam map yang disediakan.
                        </p>

                        <!-- Button to pinpoint current location -->
                        <div class="mt-4">
                            <button id="currentLocationBtn" type="button"
                                class="bg-indigo-600 text-white py-2 px-4 rounded-xl shadow-md hover:bg-indigo-500 transition duration-200">
                                Pinpoint Lokasi Semasa
                            </button>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-8 mt-6 hidden">
                            <div class="flex flex-col">
                                <label for="latitude" class="text-lg text-gray-700 dark:text-gray-300 mb-2">Latitude</label>
                                <input type="text" id="latitude" name="latitude"
                                    value="{{ old('latitude', $terima->first()->latitude ?? '') }}" readonly
                                    class="p-4 rounded-lg border-2 border-gray-300 dark:border-gray-600 bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200 placeholder-gray-400 dark:placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            </div>

                            <div class="flex flex-col">
                                <label for="longitude" class="text-lg text-gray-700 dark:text-gray-300 mb-2">Longitude</label>
                                <input type="text" id="longitude" name="longitude"
                                    value="{{ old('longitude', $terima->first()->longitude ?? '') }}" readonly
                                    class="p-4 rounded-lg border-2 border-gray-300 dark:border-gray-600 bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200 placeholder-gray-400 dark:placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            </div>
                        </div>
                    </div>

                    <!-- Muat Naik Borang BLI-04 -->
                    <div class="space-y-2">
                        <label for="dokumen_terima" class="block text-gray-700 dark:text-gray-300 font-medium">
                            Borang BLI-04 (Borang Lapor Diri di Latihan Industri)
                        </label>
                        <div class="relative">
                            <input type="file" name="dokumen_terima" id="dokumen_terima" accept=".pdf,.doc,.docx" required
                                class="w-full bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-xl p-4 text-gray-800 dark:text-gray-200 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                        </div>
                        <x-input-error :messages="$errors->get('dokumen_terima')" class="mt-2" />
                    </div>

                    <!-- Butang Hantar -->
                    <div class="space-y-4">
                        <button type="submit"
                            class="w-full bg-indigo-600 text-white py-3 rounded-xl shadow-md hover:bg-indigo-500 transition duration-300 flex justify-center items-center">
                            Hantar Borang
                        </button>
                    </div>
                </form>
            </div>

            <!-- Seksyen Permohonan yang Dihantar -->
            <div class="bg-white dark:bg-gray-800 shadow-xl rounded-xl p-8">
                <div class="mb-6 flex justify-between items-center">
                    <h3 class="text-2xl font-semibold text-gray-800 dark:text-gray-100">
                        Borang Yang Telah Dihantar
                    </h3>
                </div>

                <!-- Senarai Borang yang Dihantar -->
                @if($terima->isEmpty())
                <p class="text-gray-500 dark:text-gray-400">Anda belum menghantar sebarang borang.</p>
                @else
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-gray-50 dark:bg-gray-700 rounded-xl shadow-md text-left">
                        <thead class="bg-indigo-600 text-white">
                            <tr>
                                <th class="px-6 py-3 text-sm font-medium uppercase">No Pelajar</th>
                                <th class="px-6 py-3 text-sm font-medium uppercase">Nama</th>
                                <th class="px-6 py-3 text-sm font-medium uppercase">Borang BLI-04</th>
                                <th class="px-6 py-3 text-sm font-medium uppercase">Tarikh</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-600">
                            @foreach ($terima as $item)
                            <tr class="hover:bg-gray-100 dark:hover:bg-gray-800 transition duration-200">
                                <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-100">{{ $item->user_id }}</td>
                                <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-100">{{ $item->name }}</td>
                                <td class="px-6 py-4 text-sm">
                                    @if($item->dokumen_terima)
                                    <a href="{{ asset('storage/dokumen/' . $item->dokumen_terima) }}"
                                        class="text-indigo-500 underline hover:text-indigo-400" target="_blank">
                                        Lihat Borang BLI-04
                                    </a>
                                    @else
                                    <span class="text-gray-500">Tiada Dokumen</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-300">{{ \Carbon\Carbon::parse($item->date)->format('d/m/Y') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
            </div>

        </div>
    </div>

    <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css?v={{ time() }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css?v={{ time() }}">
    <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js?v={{ time() }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Fallback coordinates if geolocation is unavailable
            var defaultLatitude = parseFloat("3.1390"); // Default Latitude
            var defaultLongitude = parseFloat("101.6869"); // Default Longitude

            // Initialize map with default coordinates
            var map = L.map('map').setView([defaultLatitude, defaultLongitude], 13);

            // Add OpenStreetMap tile layer
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            // Add a draggable marker (for pinpoint location only)
            var marker = L.marker([defaultLatitude, defaultLongitude], {
                draggable: true
            }).addTo(map);

            // Update latitude and longitude inputs when marker is dragged
            marker.on('dragend', function() {
                var position = marker.getLatLng();
                if (document.getElementById('latitude') && document.getElementById('longitude')) {
                    document.getElementById('latitude').value = position.lat.toFixed(7);
                    document.getElementById('longitude').value = position.lng.toFixed(7);
                }
            });

            // Initialize geocoder (search bar)
            var geocoder = L.Control.Geocoder.nominatim();
            var geocodeControl = new L.Control.Geocoder({
                geocoder: geocoder
            }).addTo(map);

            // Temporary marker for search results
            var searchResultMarker;

            // Pinpoint current location on button click
            var currentLocationBtn = document.getElementById('currentLocationBtn');
            if (currentLocationBtn) {
                currentLocationBtn.addEventListener('click', function() {
                    if (navigator.geolocation) {
                        navigator.geolocation.getCurrentPosition(
                            function(position) {
                                var userLatitude = position.coords.latitude;
                                var userLongitude = position.coords.longitude;

                                // Update map and marker to user's location
                                map.setView([userLatitude, userLongitude], 15);
                                marker.setLatLng([userLatitude, userLongitude]);

                                // Update input fields with real-time location
                                if (document.getElementById('latitude') && document.getElementById('longitude')) {
                                    document.getElementById('latitude').value = userLatitude.toFixed(7);
                                    document.getElementById('longitude').value = userLongitude.toFixed(7);
                                }
                            },
                            function(error) {
                                // Handle geolocation errors
                                let errorMessage = "Tidak dapat mengakses lokasi anda. ";
                                switch (error.code) {
                                    case error.PERMISSION_DENIED:
                                        errorMessage += "Anda tidak memberi kebenaran untuk akses lokasi.";
                                        break;
                                    case error.POSITION_UNAVAILABLE:
                                        errorMessage += "Maklumat lokasi tidak tersedia.";
                                        break;
                                    case error.TIMEOUT:
                                        errorMessage += "Permintaan lokasi tamat masa.";
                                        break;
                                    default:
                                        errorMessage += "Ralat tidak diketahui.";
                                }
                                console.error("Error getting location: ", error.message);
                                alert(errorMessage);

                                // Fallback to default location if geolocation fails
                                map.setView([defaultLatitude, defaultLongitude], 13);
                                marker.setLatLng([defaultLatitude, defaultLongitude]);
                            }, {
                                enableHighAccuracy: true, // Request higher accuracy
                                timeout: 10000, // Set timeout duration
                                maximumAge: 0 // Don't use cached location
                            }
                        );
                    } else {
                        alert("Pelayar anda tidak menyokong Geolocation.");
                    }
                });
            }

            var redIcon = L.icon({
                iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-red.png',
                shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/images/marker-shadow.png',
                iconSize: [25, 41],
                iconAnchor: [12, 41],
                shadowSize: [41, 41]
            });

            // Update map view on search result selection and display a red marker
            geocodeControl.on('markgeocode', function(event) {
                var latLng = event.geocode.center;

                // Remove the previous search result marker if it exists
                if (searchResultMarker) {
                    map.removeLayer(searchResultMarker);
                }

                // Add a new red marker at the search result location
                searchResultMarker = L.marker(latLng, {
                    icon: redIcon
                }).addTo(map);

                // Update map view to the search result location
                map.setView(latLng, 15);

                // Optionally update input fields (if you want to display the search result's coordinates)
                if (document.getElementById('latitude') && document.getElementById('longitude')) {
                    document.getElementById('latitude').value = latLng.lat.toFixed(7);
                    document.getElementById('longitude').value = latLng.lng.toFixed(7);
                }
            });
        });

        window.addEventListener('load', function() {
            // Clear localStorage and sessionStorage when the page reloads
            localStorage.clear();
            sessionStorage.clear();
        });
    </script>

    <style>
        /* Ensure the text color is black */
        #map {
            width: 100%;
            height: 500px;
        }

        /* Button styling */
        .btn {
            padding: 10px 15px;
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
            margin: 10px 0;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        /* Set text color for the map control (search bar) */
        .leaflet-container .leaflet-control-geocoder input,
        .leaflet-container .leaflet-control-geocoder-result {
            color: black !important;
        }

        /* Ensure that the text in the map controls like zoom is also black */
        .leaflet-control-container .leaflet-bar {
            color: black !important;
        }
    </style>

</x-app-layout>