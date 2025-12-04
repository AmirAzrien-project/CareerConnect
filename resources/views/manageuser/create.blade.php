<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-4xl text-gradient leading-tight">
            {{ __('Tambah Pengguna Baharu') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-2">

                <!-- Success Message Notification -->
                @if(session('success'))
                <div class="bg-green-500 text-white p-4 rounded-lg mb-6">
                    <p>{{ session('success') }}</p>
                </div>
                @endif

                <!-- Form Section -->
                <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                    <!-- <form action="{{ route('register') }}" method="POST" enctype="multipart/form-data" class="space-y-8"> -->
                    @csrf

                    <!-- Personal Information Section -->
                    <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-lg">
                        <h3 class="text-2xl font-semibold text-gradient mb-4">Maklumat Pengguna</h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Role -->
                            <div>
                                <label class="block text-white text-lg mb-2">Peranan</label>
                                <select name="type" class="form-select w-full bg-gray-700 text-white rounded-lg py-3 px-4 shadow-lg focus:outline-none" required>
                                    <option value="1">Pelajar</option>
                                    <option value="2">Pensyarah</option>
                                    <option value="3">Penyelia</option>
                                </select>
                            </div>

                            <!-- Full Name -->
                            <div>
                                <label class="block text-white text-lg mb-2">Nama Penuh</label>
                                <input type="text" name="name" class="form-input w-full bg-gray-700 text-white rounded-lg py-3 px-4 shadow-lg focus:outline-none" oninput="this.value = this.value.toUpperCase();" required />
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                            <!-- IC Number -->
                            <div>
                                <label class="block text-white text-lg mb-2">Kad Pengenalan</label>
                                <input type="text" name="no_ic" class="form-input w-full bg-gray-700 text-white rounded-lg py-3 px-4 shadow-lg focus:outline-none" />
                            </div>

                            <!-- Email -->
                            <div>
                                <label class="block text-white text-lg mb-2">Email</label>
                                <input type="email" name="email" class="form-input w-full bg-gray-700 text-white rounded-lg py-3 px-4 shadow-lg focus:outline-none" required />
                            </div>

                            <!-- Phone Number -->
                            <div>
                                <label class="block text-white text-lg mb-2">Nombor Telefon</label>
                                <input type="text" name="phone_number" class="form-input w-full bg-gray-700 text-white rounded-lg py-3 px-4 shadow-lg focus:outline-none" required />
                            </div>

                            <!-- Password -->
                            <div>
                                <label class="block text-white text-lg mb-2">Katalaluan</label>
                                <input type="password" name="password" class="form-input w-full bg-gray-700 text-white rounded-lg py-3 px-4 shadow-lg focus:outline-none" required />
                            </div>
                        </div>
                    </div>

                    <!-- Home Address Section -->
                    <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-lg mt-8">
                        <h3 class="text-2xl font-semibold text-gradient mb-4">Alamat Rumah</h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Location -->
                            <div>
                                <label class="block text-white text-lg mb-2">Taman</label>
                                <input type="text" name="location" class="form-input w-full bg-gray-700 text-white rounded-lg py-3 px-4 shadow-lg focus:outline-none" required />
                            </div>

                            <!-- City -->
                            <div>
                                <label class="block text-white text-lg mb-2">Bandar</label>
                                <input type="text" name="city" class="form-input w-full bg-gray-700 text-white rounded-lg py-3 px-4 shadow-lg focus:outline-none" required />
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                            <!-- State -->
                            <div>
                                <label class="block text-white text-lg mb-2">Negeri</label>
                                <select name="state" class="form-select w-full bg-gray-700 text-white rounded-lg py-3 px-4 shadow-lg focus:outline-none" required>
                                    <option value="" disabled selected>Pilih Negeri</option>
                                    <option value="Johor">Johor</option>
                                    <option value="Kedah">Kedah</option>
                                    <option value="Kelantan">Kelantan</option>
                                    <option value="Melaka">Melaka</option>
                                    <option value="Negeri Sembilan">Negeri Sembilan</option>
                                    <option value="Pahang">Pahang</option>
                                    <option value="Penang">Penang</option>
                                    <option value="Perak">Perak</option>
                                    <option value="Perlis">Perlis</option>
                                    <option value="Selangor">Selangor</option>
                                    <option value="Terengganu">Terengganu</option>
                                    <option value="Sabah">Sabah</option>
                                    <option value="Sarawak">Sarawak</option>
                                    <option value="Wilayah Persekutuan Kuala Lumpur">Wilayah Persekutuan Kuala Lumpur</option>
                                    <option value="Wilayah Persekutuan Labuan">Wilayah Persekutuan Labuan</option>
                                    <option value="Wilayah Persekutuan Putrajaya">Wilayah Persekutuan Putrajaya</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Academic Information Section 
                    <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-lg mt-8">
                        <h3 class="text-2xl font-semibold text-gradient mb-4">Maklumat Akademik (Pelajar)</h3>

                        <div>
                            <x-input-label for="student_course" class="text-white text-lg" :value="__('Kursus')" />
                            <select id="student_course" name="student_course" class="mt-2 w-full bg-gray-700 text-white rounded-lg py-3 px-4 shadow-lg focus:outline-none">
                                <option value="" disabled selected>Pilih kursus</option>
                                <option value="CS230 - Bachelor of Computer Science (Hons.)" {{ old('student_course') == 'CS230 - Bachelor of Computer Science (Hons.)' ? 'selected' : '' }}>
                                    CS230 - Bachelor of Computer Science (Hons.)
                                </option>
                                <option value="CS245 - Bachelor of Computer Science (Hons.) Data Communication And Networking" {{ old('student_course') == 'CS245 - Bachelor of Computer Science (Hons.) Data Communication And Networking' ? 'selected' : '' }}>
                                    CS245 - Bachelor of Computer Science (Hons.) Data Communication And Networking
                                </option>
                                <option value="CS246 - Bachelor of Information Technology (Hons.) Information Systems Engineering" {{ old('student_course') == 'CS246 - Bachelor of Information Technology (Hons.) Information Systems Engineering' ? 'selected' : '' }}>
                                    CS246 - Bachelor of Information Technology (Hons.) Information Systems Engineering
                                </option>
                                <option value="CS251 - Bachelor of Computer Science (Hons.) Netcentric Computing" {{ old('student_course') == 'CS251 - Bachelor of Computer Science (Hons.) Netcentric Computing' ? 'selected' : '' }}>
                                    CS251 - Bachelor of Computer Science (Hons.) Netcentric Computing
                                </option>
                                <option value="CS253 - Bachelor of Computer Science (Hons.) Multimedia Computing" {{ old('student_course') == 'CS253 - Bachelor of Computer Science (Hons.) Multimedia Computing' ? 'selected' : '' }}>
                                    CS253 - Bachelor of Computer Science (Hons.) Multimedia Computing
                                </option>
                                <option value="CS255 - Bachelor of Computer Science (Hons.) Data Communication and Networking" {{ old('student_course') == 'CS255 - Bachelor of Computer Science (Hons.) Data Communication and Networking' ? 'selected' : '' }}>
                                    CS255 - Bachelor of Computer Science (Hons.) Data Communication and Networking
                                </option>
                                <option value="CS266 - Bachelor of Information Technology (Hons.) Information Systems Engineering" {{ old('student_course') == 'CS266 - Bachelor of Information Technology (Hons.) Information Systems Engineering' ? 'selected' : '' }}>
                                    CS266 - Bachelor of Information Technology (Hons.) Information Systems Engineering
                                </option>
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('student_course')" />
                        </div>
                    </div>-->

                    <!-- Submit Button -->
                    <div class="flex justify-center items-center mt-8">
                        <x-primary-button class="text-white bg-gradient-to-r from-teal-500 to-blue-500 py-3 px-8 rounded-full hover:bg-teal-600 transition duration-300 ease-in-out transform hover:scale-105">
                            {{ __('Tambah Pengguna') }}
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-3 inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14M12 5l7 7-7 7" />
                            </svg>
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>