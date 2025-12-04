<x-app-layout>
    <style>
        option:disabled {
            background-color: #f0f0f0;
            /* Light gray background */
        }
    </style>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
                <form action="{{ route('users.update', $selectedUser->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Personal Information Section -->
                    <fieldset class="mb-6">
                        <legend class="font-semibold text-lg text-gray-800 dark:text-gray-200">Personal Information</legend>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div class="mb-4">
                                <x-input-label for="name" :value="__('Name')" class="flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m-3-3H9"></path>
                                    </svg>
                                    Name
                                </x-input-label>
                                <input type="text" name="name" value="{{ $selectedUser->name }}" class="form-input mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600" placeholder="Enter name" />
                            </div>

                            <div class="mb-4">
                                <x-input-label for="email" :value="__('Email')" class="flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 6c0 2.209-1.791 4-4 4s-4-1.791-4-4 1.791-4 4-4 4 1.791 4 4z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14c-4.418 0-8 2.686-8 6v2h16v-2c0-3.314-3.582-6-8-6z"></path>
                                    </svg>
                                    Email
                                </x-input-label>
                                <input type="email" name="email" value="{{ $selectedUser->email }}" class="form-input mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600" placeholder="Enter email" />
                            </div>

                            <div class="mb-4">
                                <x-input-label for="phone_number" :value="__('Phone Number')" class="flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m-3-3H9"></path>
                                    </svg>
                                    Phone Number
                                </x-input-label>
                                <input type="text" name="phone_number" value="{{ $selectedUser->phone_number }}" class="form-input mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600" placeholder="Enter phone number" />
                            </div>
                            <div class="mb-4">
                                <x-input-label for="type" :value="__('Role')" class="flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m0 0l4-4m-4 4l-4-4"></path>
                                    </svg>
                                    Role
                                </x-input-label>
                                <select name="type" class="form-select mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600" required>
                                    <option value="1" {{ $selectedUser->type == 1 ? 'selected' : '' }}>Pelajar</option>
                                    <option value="2" {{ $selectedUser->type == 2 ? 'selected' : '' }}>Pensyarah</option>
                                    <option value="3" {{ $selectedUser->type == 3 ? 'selected' : '' }}>Penyelia</option>
                                </select>
                            </div>
                        </div>
                    </fieldset>

                    <!-- Internship Section -->
                    <fieldset class="mb-6">
                        <legend class="font-semibold text-lg text-gray-800 dark:text-gray-200">Internship</legend>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div class="mb-4">
                                <x-input-label for="student_course" :value="__('Course')" class="flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m-3-3H9"></path>
                                    </svg>
                                    Course
                                </x-input-label>
                                <select id="student_course" name="student_course" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600">
                                    <option value="" disabled selected>Select Course</option>
                                    <option value="CS230 - Bachelor of Computer Science (Hons.)" {{ old('student_course', $selectedUser->student_course) == 'CS230 - Bachelor of Computer Science (Hons.)' ? 'selected' : '' }}>
                                        CS230 - Bachelor of Computer Science (Hons.)
                                    </option>
                                    <option value="CS245 - Bachelor of Computer Science (Hons.) Data Communication And Networking" {{ old('student_course', $selectedUser->student_course) == 'CS245 - Bachelor of Computer Science (Hons.) Data Communication And Networking' ? 'selected' : '' }}>
                                        CS245 - Bachelor of Computer Science (Hons.) Data Communication And Networking
                                    </option>
                                    <option value="CS246 - Bachelor of Information Technology (Hons.) Information Systems Engineering" {{ old('student_course', $selectedUser->student_course) == 'CS246 - Bachelor of Information Technology (Hons.) Information Systems Engineering' ? 'selected' : '' }}>
                                        CS246 - Bachelor of Information Technology (Hons.) Information Systems Engineering
                                    </option>
                                    <option value="CS251 - Bachelor of Computer Science (Hons.) Netcentric Computing" {{ old('student_course', $selectedUser->student_course) == 'CS251 - Bachelor of Computer Science (Hons.) Netcentric Computing' ? 'selected' : '' }}>
                                        CS251 - Bachelor of Computer Science (Hons.) Netcentric Computing
                                    </option>
                                    <option value="CS253 - Bachelor of Computer Science (Hons.) Multimedia Computing" {{ old('student_course', $selectedUser->student_course) == 'CS253 - Bachelor of Computer Science (Hons.) Multimedia Computing' ? 'selected' : '' }}>
                                        CS253 - Bachelor of Computer Science (Hons.) Multimedia Computing
                                    </option>
                                    <option value="CS255 - Bachelor of Computer Science (Hons.) Data Communication and Networking" {{ old('student_course', $selectedUser->student_course) == 'CS255 - Bachelor of Computer Science (Hons.) Data Communication and Networking' ? 'selected' : '' }}>
                                        CS255 - Bachelor of Computer Science (Hons.) Data Communication and Networking
                                    </option>
                                    <option value="CS266 - Bachelor of Information Technology (Hons.) Information Systems Engineering" {{ old('student_course', $selectedUser->student_course) == 'CS266 - Bachelor of Information Technology (Hons.) Information Systems Engineering' ? 'selected' : '' }}>
                                        CS266 - Bachelor of Information Technology (Hons.) Information Systems Engineering
                                    </option>
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('student_course')" />
                            </div>

                            <div class="mb-4">
                                <x-input-label for="faculty" :value="__('Faculty')" class="flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m-3-3H9"></path>
                                    </svg>
                                    Faculty
                                </x-input-label>
                                <select name="faculty" class="form-select mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600">
                                    <option value="" {{ old('faculty', $selectedUser->faculty) == null ? 'selected' : '' }}>Tiada</option>
                                    <option value="Kolej Pengajian Pengkomputeran, Informatik dan Matematik" {{ old('faculty', $selectedUser->faculty) == 'Kolej Pengajian Pengkomputeran, Informatik dan Matematik' ? 'selected' : '' }}>
                                        Kolej Pengajian Pengkomputeran, Informatik dan Matematik
                                    </option>
                                    <option value="Fakulti Perladangan dan Agroteknologi" {{ old('faculty', $selectedUser->faculty) == 'Fakulti Perladangan dan Agroteknologi' ? 'selected' : '' }}>
                                        Fakulti Perladangan dan Agroteknologi
                                    </option>
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('faculty')" />
                            </div>

                            <div class="mb-4">
                                <x-input-label for="part" :value="__('Part')" class="flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m-3-3H9"></path>
                                    </svg>
                                    Part
                                </x-input-label>
                                <input type="text" name="part" value="{{ old('part', $selectedUser->part) }}" class="form-input mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600" placeholder="Enter part" />
                                <x-input-error class="mt-2" :messages="$errors->get('part')" />
                            </div>

                            <div class="mb-4">
                                <x-input-label for="advisor" :value="__('Advisor')" class="flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m-3-3H9"></path>
                                    </svg>
                                    Advisor
                                </x-input-label>
                                <input type="text" name="advisor" value="{{ $selectedUser->advisor }}" class="form-input mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600" placeholder="Enter advisor" />
                            </div>

                            <!-- Internship Placement Section -->
                            <div class="mb-4">
                                <x-input-label for="internship" :value="__('Internship Placement')" class="flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m-3-3H9"></path>
                                    </svg>
                                    Internship Placement
                                </x-input-label>
                                <select name="internship" class="form-select mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600">
                                    <option value="" {{ old('internship', $selectedUser->internship_id) == null ? 'selected' : '' }}>
                                        (Hanya untuk pelajar)
                                    </option>
                                    @foreach($internships as $internship)
                                    <option value="{{ $internship->id }}"
                                        {{ $selectedUser->id == $internship->user_id ? 'selected' : '' }}>
                                        @if($internship->user_id)
                                        {{ $internship->company_name }} (Taken by: {{ $internship->user->name }})
                                        @else
                                        {{ $internship->company_name }} (Available)
                                        @endif
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-4">
                                <x-input-label for="graduation_year" :value="__('Graduation Year')" class="flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m-3-3H9"></path>
                                    </svg>
                                    Graduation Year
                                </x-input-label>

                                @php
                                $currentYear = date("Y");
                                $years = range($currentYear - 3, $currentYear); // Adjust the range as needed
                                @endphp

                                <select name="graduation_year" id="graduation_year" class="form-select mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600">
                                    <option value="">(Hanya untuk pelajar)</option>
                                    @foreach ($years as $year)
                                    <option value="{{ $year }}" {{ old('graduation_year', $selectedUser->graduation_year) == $year ? 'selected' : '' }}>
                                        {{ $year }}
                                    </option>
                                    @endforeach
                                </select>

                                <x-input-error class="mt-2" :messages="$errors->get('graduation_year')" />
                            </div>
                        </div>
                    </fieldset>

                    <!-- Address Section -->
                    <fieldset class="mb-6">
                        <legend class="font-semibold text-lg text-gray-800 dark:text-gray-200">Address</legend>
                        <div class="mb-4">
                            <x-input-label for="location" :value="__('Address')" class="flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m0 0l4-4m-4 4l-4-4"></path>
                                </svg>
                                Address
                            </x-input-label>
                            <input type="text" name="location" value="{{ $selectedUser->location }}" class="form-input mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600" placeholder="Enter address" />
                        </div>
                        <div class="mb-4">
                            <x-input-label for="city" :value="__('City')" class="flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m0 0l4-4m-4 4l-4-4"></path>
                                </svg>
                                City
                            </x-input-label>
                            <select id="city" name="city" class="form-select mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600">
                                <option value="">Select City</option>
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('city')" />
                        </div>
                        <div class="mb-4">
                            <x-input-label for="state" :value="__('State')" class="flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m0 0l4-4m-4 4l-4-4"></path>
                                </svg>
                                State
                            </x-input-label>
                            <select id="state" name="state" class="form-select mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600" onchange="updateCities()">
                                <option value="">Select State</option>
                                <option value="Johor" {{ old('state', $selectedUser->state) == 'Johor' ? 'selected' : '' }}>Johor</option>
                                <option value="Kedah" {{ old('state', $selectedUser->state) == 'Kedah' ? 'selected' : '' }}>Kedah</option>
                                <option value="Kelantan" {{ old('state', $selectedUser->state) == 'Kelantan' ? 'selected' : '' }}>Kelantan</option>
                                <option value="Malacca" {{ old('state', $selectedUser->state) == 'Malacca' ? 'selected' : '' }}>Malacca</option>
                                <option value="Negeri Sembilan" {{ old('state', $selectedUser->state) == 'Negeri Sembilan' ? 'selected' : '' }}>Negeri Sembilan</option>
                                <option value="Pahang" {{ old('state', $selectedUser->state) == 'Pahang' ? 'selected' : '' }}>Pahang</option>
                                <option value="Penang" {{ old('state', $selectedUser->state) == 'Penang' ? 'selected' : '' }}>Penang</option>
                                <option value="Perak" {{ old('state', $selectedUser->state) == 'Perak' ? 'selected' : '' }}>Perak</option>
                                <option value="Perlis" {{ old('state', $selectedUser->state) == 'Perlis' ? 'selected' : '' }}>Perlis</option>
                                <option value="Sabah" {{ old('state', $selectedUser->state) == 'Sabah' ? 'selected' : '' }}>Sabah</option>
                                <option value="Sarawak" {{ old('state', $selectedUser->state) == 'Sarawak' ? 'selected' : '' }}>Sarawak</option>
                                <option value="Selangor" {{ old('state', $selectedUser->state) == 'Selangor' ? 'selected' : '' }}>Selangor</option>
                                <option value="Terengganu" {{ old('state', $selectedUser->state) == 'Terengganu' ? 'selected' : '' }}>Terengganu</option>
                                <option value="Kuala Lumpur" {{ old('state', $selectedUser->state) == 'Kuala Lumpur' ? 'selected' : '' }}>Kuala Lumpur</option>
                                <option value="Labuan" {{ old('state', $selectedUser->state) == 'Labuan' ? 'selected' : '' }}>Labuan</option>
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('state')" />
                        </div>
                    </fieldset>
                    <div class="mt-6">
                        <x-primary-button>
                            {{ __('Update User') }}
                        </x-primary-button>
                    </div>
                </form>

                <br>
                <br>

                <div class="bg-gray-900 rounded-2xl shadow-xl p-8 sm:p-10 text-gray-200">
                    <h3 class="text-2xl font-semibold mb-4">Upload Documents for {{ $selectedUser->name }}</h3>

                    <!-- Unified Upload Form -->
                    <form action="{{ route('documents.upload', $selectedUser->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Resume Upload -->
                        <div class="mb-6">
                            <label for="resume" class="block text-gray-200 font-medium mb-2">(PDF) Resume</label>
                            <input type="file" name="resume" id="resume" accept="application/pdf" class="border border-gray-700 rounded-lg p-3 w-full bg-gray-800 text-gray-100 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                        </div>

                        <!-- Cover Letter Upload -->
                        <div class="mb-6">
                            <label for="cover_letter" class="block text-gray-200 font-medium mb-2">(PDF) Cover Letter</label>
                            <input type="file" name="cover_letter" id="cover_letter" accept=".pdf,.doc,.docx" class="border border-gray-700 rounded-lg p-3 w-full bg-gray-800 text-gray-100 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                        </div>

                        <!-- Logbook Upload -->
                        <div class="mb-6">
                            <label for="logbook" class="block text-gray-200 font-medium mb-2">(PDF) Logbook</label>
                            <input type="file" name="logbook" id="logbook" accept=".pdf,.doc,.docx" class="border border-gray-700 rounded-lg p-3 w-full bg-gray-800 text-gray-100 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="w-full bg-indigo-600 text-white py-2 rounded-lg hover:bg-indigo-500 transition duration-200 shadow-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            Upload Documents
                        </button>
                    </form>

                    <!-- Display Current Documents -->
                    <div class="mt-8">
                        <!-- Display Resume -->
                        @if ($selectedUser->resume)
                        <h2 class="mt-6 text-lg font-semibold text-gray-100">Current Resume for {{ $selectedUser->name }}:</h2>
                        <div class="mt-4 bg-gray-800 rounded-lg p-4 shadow-inner">
                            <iframe src="{{ asset($selectedUser->resume) }}" class="w-full h-[400px] rounded-lg shadow-md" frameborder="0">
                                Your browser does not support PDFs. Please download the PDF to view it:
                                <a href="{{ asset($selectedUser->resume) }}">Download PDF</a>
                            </iframe>
                        </div>
                        @else
                        <p class="mt-4 text-gray-300">This user has not uploaded a resume yet.</p>
                        @endif

                        <!-- Display Cover Letter -->
                        @if ($selectedUser->cover_letter)
                        <h2 class="mt-6 text-lg font-semibold text-gray-100">Current Cover Letter for {{ $selectedUser->name }}:</h2>
                        <div class="mt-4 bg-gray-800 rounded-lg p-4 shadow-inner">
                            @if (pathinfo($selectedUser->cover_letter, PATHINFO_EXTENSION) == 'pdf')
                            <iframe src="{{ asset($selectedUser->cover_letter) }}" class="w-full h-[400px] rounded-lg shadow-md" frameborder="0">
                                Your browser does not support PDFs. Please download the PDF to view it:
                                <a href="{{ asset($selectedUser->cover_letter) }}">Download PDF</a>
                            </iframe>
                            @else
                            <div id="coverLetterEditorContainer" class="h-[400px] border border-gray-600 rounded-lg overflow-auto">
                                <div id="coverLetterEditor" contenteditable="true" class="p-4 text-gray-200 bg-gray-800 h-full overflow-y-auto">
                                    <!-- Word document content will be loaded here -->
                                </div>
                            </div>
                            <a href="{{ asset($selectedUser->cover_letter) }}" class="text-blue-400 underline mt-2 block">Download Cover Letter Document</a>
                            @endif
                        </div>
                        @else
                        <p class="mt-4 text-gray-300">This user has not uploaded a cover letter yet.</p>
                        @endif

                        <!-- Display Logbook -->
                        @if ($selectedUser->logbook)
                        <h2 class="mt-6 text-lg font-semibold text-gray-100">Current Logbook for {{ $selectedUser->name }}:</h2>
                        <div class="mt-4 bg-gray-800 rounded-lg p-4 shadow-inner">
                            @if (pathinfo($selectedUser->logbook, PATHINFO_EXTENSION) == 'pdf')
                            <iframe src="{{ asset($selectedUser->logbook) }}" class="w-full h-[400px] rounded-lg shadow-md" frameborder="0">
                                Your browser does not support PDFs. Please download the PDF to view it:
                                <a href="{{ asset($selectedUser->logbook) }}">Download PDF</a>
                            </iframe>
                            @else
                            <div id="logbookEditorContainer" class="h-[400px] border border-gray-600 rounded-lg overflow-auto">
                                <div id="logbookEditor" contenteditable="true" class="p-4 text-gray-200 bg-gray-800 h-full overflow-y-auto">
                                    <!-- Word document content will be loaded here -->
                                </div>
                            </div>
                            <a href="{{ asset($selectedUser->logbook) }}" class="text-blue-400 underline mt-2 block">Download Logbook Document</a>
                            @endif
                        </div>
                        @else
                        <p class="mt-4 text-gray-300">This user has not uploaded a logbook yet.</p>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const stateSelect = document.getElementById('state');
        const citySelect = document.getElementById('city');
        const selectedCity = "{{ old('city', $selectedUser->city) }}";

        const citiesByState = {
            "Johor": ["Johor Bahru", "Kota Tinggi", "Batu Pahat"],
            "Kedah": ["Alor Setar", "Sungai Petani", "Langkawi"],
            "Kelantan": ["Kota Bharu", "Tumpat", "Pasir Mas"],
            "Malacca": ["Malacca City", "Alor Gajah", "Jasin"],
            "Negeri Sembilan": ["Seremban", "Port Dickson", "Nilai"],
            "Pahang": ["Kuantan", "Cameron Highlands", "Temerloh"],
            "Penang": ["George Town", "Butterworth", "Bayan Lepas"],
            "Perak": ["Ipoh", "Taiping", "Teluk Intan"],
            "Perlis": ["Kangar", "Arau", "Simpang Empat"],
            "Sabah": ["Kota Kinabalu", "Sandakan", "Tawau"],
            "Sarawak": ["Kuching", "Sibu", "Miri"],
            "Selangor": ["Shah Alam", "Subang Jaya", "Petaling Jaya"],
            "Terengganu": ["Kuala Terengganu", "Dungun", "Kemaman"],
            "Kuala Lumpur": ["KL City"],
            "Labuan": ["Labuan"],
            "Putrajaya": ["Putrajaya"],
        };

        function updateCities() {
            const selectedState = stateSelect.value;
            citySelect.innerHTML = '<option value="">Select City</option>'; // Reset city options

            if (citiesByState[selectedState]) {
                citiesByState[selectedState].forEach(city => {
                    const option = document.createElement('option');
                    option.value = city;
                    option.textContent = city;
                    if (city === selectedCity) {
                        option.selected = true;
                    }
                    citySelect.appendChild(option);
                });
            }
        }

        stateSelect.addEventListener('change', updateCities);

        // Trigger update when the page loads to populate cities for the selected state.
        updateCities();
    });
</script>