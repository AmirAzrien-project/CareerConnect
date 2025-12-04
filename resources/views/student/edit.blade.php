<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-4xl text-indigo-600 dark:text-indigo-300 tracking-wide">
            {{ __('Edit Profil Pelajar') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="">

                <!-- Personal Information Card -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-8 transition-transform transform hover:scale-105 duration-300 ease-in-out">
                    <h3 class="text-2xl font-semibold text-indigo-600 dark:text-indigo-300 mb-6">Maklumat Peribadi</h3>

                    <!-- Add Form Open Here -->
                    <form method="POST" action="{{ route('student.update', $user->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
                            <!-- No Pelajar -->
                            <div class="flex flex-col">
                                <label for="user_id" class="text-lg text-gray-700 dark:text-gray-300 mb-2">No Pelajar</label>
                                <input type="text" id="user_id" name="user_id" value="{{ old('user_id', $user->user_id) }}"
                                    class="p-4 rounded-lg border-2 border-gray-300 dark:border-gray-600 bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200 placeholder-gray-400 dark:placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition duration-300">
                            </div>

                            <!-- Kad Pengenalan -->
                            <div class="flex flex-col">
                                <label for="no_ic" class="text-lg text-gray-700 dark:text-gray-300 mb-2">Kad Pengenalan</label>
                                <input type="text" id="no_ic" name="no_ic" value="{{ old('no_ic', $user->no_ic) }}"
                                    class="p-4 rounded-lg border-2 border-gray-300 dark:border-gray-600 bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200 placeholder-gray-400 dark:placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition duration-300">
                            </div>

                            <!-- Nama Penuh -->
                            <div class="flex flex-col">
                                <label for="name" class="text-lg text-gray-700 dark:text-gray-300 mb-2">Nama Penuh</label>
                                <input type="text" name="name" value="{{ old('name', $user->name) }}"
                                    class="p-4 rounded-lg border-2 border-gray-300 dark:border-gray-600 bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200 placeholder-gray-400 dark:placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition duration-300" oninput="this.value = this.value.toUpperCase();">
                            </div>

                            <!-- Email -->
                            <div class="flex flex-col">
                                <label for="email" class="text-lg text-gray-700 dark:text-gray-300 mb-2">Emel</label>
                                <input type="email" name="email" value="{{ old('email', $user->email) }}"
                                    class="p-4 rounded-lg border-2 border-gray-300 dark:border-gray-600 bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200 placeholder-gray-400 dark:placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition duration-300">
                            </div>

                            <!-- No Telefon -->
                            <div class="flex flex-col">
                                <label for="phone_number" class="text-lg text-gray-700 dark:text-gray-300 mb-2">No Telefon</label>
                                <input type="text" id="phone_number" name="phone_number" value="{{ old('phone_number', $user->phone_number) }}"
                                    class="p-4 rounded-lg border-2 border-gray-300 dark:border-gray-600 bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200 placeholder-gray-400 dark:placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition duration-300">
                            </div>

                            <!-- Alamat -->
                            <div class="flex flex-col">
                                <label for="location" class="text-lg text-gray-700 dark:text-gray-300 mb-2">Alamat</label>
                                <input type="text" id="location" name="location" value="{{ old('location', $user->location) }}"
                                    class="p-4 rounded-lg border-2 border-gray-300 dark:border-gray-600 bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200 placeholder-gray-400 dark:placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition duration-300">
                            </div>

                            <!-- Bandar -->
                            <div class="flex flex-col">
                                <label for="city" class="text-lg text-gray-700 dark:text-gray-300 mb-2">Bandar</label>
                                <input type="text" id="city" name="city" value="{{ old('city', $user->city) }}"
                                    class="p-4 rounded-lg border-2 border-gray-300 dark:border-gray-600 bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200 placeholder-gray-400 dark:placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition duration-300">
                            </div>

                            <!-- State -->
                            <div class="flex flex-col">
                            <label for="student_course" class="text-lg text-gray-700 dark:text-gray-300 mb-2">Program</label>
                            <select id="student_course" name="student_course" class="p-4 rounded-lg bg-gray-100 dark:bg-gray-700 border-2 border-gray-300 dark:border-gray-600 text-gray-800 dark:text-gray-100 placeholder-gray-500 dark:placeholder-gray-300 focus:outline-none focus:border-indigo-600 focus:ring-1 focus:ring-indigo-600 transition duration-300">
                                <option value="" disabled selected>Pilih Program</option>
                                <option value="CS230 - Bachelor of Computer Science (Hons.)" {{ old('student_course', $user->student_course) == 'CS230 - Bachelor of Computer Science (Hons.)' ? 'selected' : '' }}>
                                    CS230 - Bachelor of Computer Science (Hons.)
                                </option>
                                <option value="CS245 - Bachelor of Computer Science (Hons.) Data Communication And Networking" {{ old('student_course', $user->student_course) == 'CS245 - Bachelor of Computer Science (Hons.) Data Communication And Networking' ? 'selected' : '' }}>
                                    CS245 - Bachelor of Computer Science (Hons.) Data Communication and Networking
                                </option>
                                <option value="CS246 - Bachelor of Information Technology (Hons.) Information Systems Engineering" {{ old('student_course', $user->student_course) == 'CS246 - Bachelor of Information Technology (Hons.) Information Systems Engineering' ? 'selected' : '' }}>
                                    CS246 - Bachelor of Information Technology (Hons.) Information Systems Engineering</option>
                                <option value="CS251 - Bachelor of Computer Science (Hons.) Netcentric Computing" {{ old('student_course', $user->student_course) == 'CS251 - Bachelor of Computer Science (Hons.) Netcentric Computing' ? 'selected' : '' }}>
                                    CS251 - Bachelor of Computer Science (Hons.) Netcentric Computing
                                </option>
                                <option value="CS253 - Bachelor of Computer Science (Hons.) Multimedia Computing" {{ old('student_course', $user->student_course) == 'CS253 - Bachelor of Computer Science (Hons.) Multimedia Computing' ? 'selected' : '' }}>
                                    CS253 - Bachelor of Computer Science (Hons.) Multimedia Computing
                                </option>
                                <option value="CS255 - Bachelor of Computer Science (Hons.) Data Communication and Networking" {{ old('student_course', $user->student_course) == 'CS255 - Bachelor of Computer Science (Hons.) Data Communication and Networking' ? 'selected' : '' }}>
                                    CS255 - Bachelor of Computer Science (Hons.) Data Communication and Networking
                                </option>
                                <option value="CS266 - Bachelor of Information Technology (Hons.) Information Systems Engineering" {{ old('student_course', $user->student_course) == 'CS266 - Bachelor of Information Technology (Hons.) Information Systems Engineering' ? 'selected' : '' }}>
                                    CS266 - Bachelor of Information Technology (Hons.) Information Systems Engineering
                                </option>
                            </select>
                        </div>

                        <!-- Semester -->
                        <div class="flex flex-col">
                            <label for="part" class="text-lg text-gray-700 dark:text-gray-300 mb-2">Semester</label>
                            <input type="text" name="part" value="{{ old('part', $user->part) }}"
                                class="p-4 rounded-lg border-2 border-gray-300 dark:border-gray-600 bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200 placeholder-gray-400 dark:placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition duration-300">
                        </div>

                        <!-- Penasihat Akademik -->
                        <div class="flex flex-col">
                            <label for="advisor" class="text-lg text-gray-700 dark:text-gray-300 mb-2">Penasihat Akademik</label>
                            <input type="text" id="advisor" name="advisor" value="{{ old('advisor', $user->advisor) }}"
                                class="p-4 rounded-lg border-2 border-gray-300 dark:border-gray-600 bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200 placeholder-gray-400 dark:placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition duration-300" oninput="this.value = this.value.toUpperCase();">
                        </div>

                        <!-- Submit Button -->
                        <div class="mt-8 text-center">
                            <button type="submit" 
                                class="bg-indigo-600 text-white p-4 rounded-lg shadow-lg hover:bg-indigo-500 flex items-center justify-center space-x-2 transition duration-300 transform hover:scale-105">
                                <i class="fas fa-save"></i>
                                <span>Simpan Perubahan</span>
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>