<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-6xl text-gray-800 dark:text-gray-200 leading-tight text-center mb-8">
            {{ __('Kemas Kini Maklumat Pensyarah') }}
        </h2>
    </x-slot>

    <div class="py-16">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-2xl p-10 transform transition duration-500 ease-in-out hover:scale-105">

                <!-- Form Section -->
                <form action="{{ route('admin.update', $admin->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="space-y-8">
                        <!-- Admin Type (Pensyarah / Penyelia) -->
                        <div class="flex flex-col md:flex-row items-center space-y-4 md:space-y-0 md:space-x-4">
                            <i class="fas fa-user-tag text-xl text-gray-600 dark:text-gray-300"></i>
                            <label for="type" class="text-xl text-gray-800 dark:text-gray-200 w-full md:w-1/4">Jenis Pengguna:</label>
                            <select name="type" id="type" class="w-full md:w-3/4 p-4 rounded-lg bg-gray-100 dark:bg-gray-700 border-2 border-gray-300 dark:border-gray-600 text-gray-800 dark:text-gray-100 placeholder-gray-500 dark:placeholder-gray-300 focus:outline-none focus:border-indigo-600 focus:ring-1 focus:ring-indigo-600 transition">
                                <option value="2" {{ old('type', $admin->type) == 2 ? 'selected' : '' }}>Pensyarah</option>
                                <option value="3" {{ old('type', $admin->type) == 3 ? 'selected' : '' }}>Penyelia</option>
                            </select>
                        </div>

                        <!-- Admin Name -->
                        <div class="flex flex-col md:flex-row items-center space-y-4 md:space-y-0 md:space-x-4">
                            <i class="fas fa-user text-xl text-gray-600 dark:text-gray-300"></i>
                            <label for="name" class="text-xl text-gray-800 dark:text-gray-200 w-full md:w-1/4">Nama:</label>
                            <input type="text" id="name" name="name" value="{{ old('name', $admin->name) }}" class="w-full md:w-3/4 p-4 rounded-lg bg-gray-100 dark:bg-gray-700 border-2 border-gray-300 dark:border-gray-600 text-gray-800 dark:text-gray-100 placeholder-gray-500 dark:placeholder-gray-300 focus:outline-none focus:border-indigo-600 focus:ring-1 focus:ring-indigo-600 transition" oninput="this.value = this.value.toUpperCase();">
                        </div>

                        <!-- User ID -->
                        <div class="flex flex-col md:flex-row items-center space-y-4 md:space-y-0 md:space-x-4">
                            <i class="fas fa-id-badge text-xl text-gray-600 dark:text-gray-300"></i>
                            <label for="user_id" class="text-xl text-gray-800 dark:text-gray-200 w-full md:w-1/4">No ID:</label>
                            <input type="text" id="user_id" name="user_id" value="{{ old('user_id', $admin->user_id) }}" class="w-full md:w-3/4 p-4 rounded-lg bg-gray-100 dark:bg-gray-700 border-2 border-gray-300 dark:border-gray-600 text-gray-800 dark:text-gray-100 placeholder-gray-500 dark:placeholder-gray-300 focus:outline-none focus:border-indigo-600 focus:ring-1 focus:ring-indigo-600 transition">
                        </div>

                        <!-- Kad Pengenalan -->
                        <div class="flex flex-col md:flex-row items-center space-y-4 md:space-y-0 md:space-x-4">
                            <i class="fas fa-id-card text-xl text-gray-600 dark:text-gray-300"></i>
                            <label for="no_ic" class="text-xl text-gray-800 dark:text-gray-200 w-full md:w-1/4">Kad Pengenalan:</label>
                            <input type="text" id="no_ic" name="no_ic" value="{{ old('no_ic', $admin->no_ic) }}" class="w-full md:w-3/4 p-4 rounded-lg bg-gray-100 dark:bg-gray-700 border-2 border-gray-300 dark:border-gray-600 text-gray-800 dark:text-gray-100 placeholder-gray-500 dark:placeholder-gray-300 focus:outline-none focus:border-indigo-600 focus:ring-1 focus:ring-indigo-600 transition">
                        </div>

                        <!-- Admin Position -->
                        <div class="flex flex-col md:flex-row items-center space-y-4 md:space-y-0 md:space-x-4">
                            <i class="fas fa-briefcase text-xl text-gray-600 dark:text-gray-300"></i>
                            <label for="current_position" class="text-xl text-gray-800 dark:text-gray-200 w-full md:w-1/4">Jawatan:</label>
                            <input type="text" id="current_position" name="current_position" value="{{ old('current_position', $admin->current_position) }}" class="w-full md:w-3/4 p-4 rounded-lg bg-gray-100 dark:bg-gray-700 border-2 border-gray-300 dark:border-gray-600 text-gray-800 dark:text-gray-100 placeholder-gray-500 dark:placeholder-gray-300 focus:outline-none focus:border-indigo-600 focus:ring-1 focus:ring-indigo-600 transition">
                        </div>

                        <!-- Admin Email -->
                        <div class="flex flex-col md:flex-row items-center space-y-4 md:space-y-0 md:space-x-4">
                            <i class="fas fa-envelope text-xl text-gray-600 dark:text-gray-300"></i>
                            <label for="email" class="text-xl text-gray-800 dark:text-gray-200 w-full md:w-1/4">Email:</label>
                            <input type="email" id="email" name="email" value="{{ old('email', $admin->email) }}" class="w-full md:w-3/4 p-4 rounded-lg bg-gray-100 dark:bg-gray-700 border-2 border-gray-300 dark:border-gray-600 text-gray-800 dark:text-gray-100 placeholder-gray-500 dark:placeholder-gray-300 focus:outline-none focus:border-indigo-600 focus:ring-1 focus:ring-indigo-600 transition">
                        </div>

                        <!-- Admin Phone Number -->
                        <div class="flex flex-col md:flex-row items-center space-y-4 md:space-y-0 md:space-x-4">
                            <i class="fas fa-phone-alt text-xl text-gray-600 dark:text-gray-300"></i>
                            <label for="phone_number" class="text-xl text-gray-800 dark:text-gray-200 w-full md:w-1/4">No. Telefon:</label>
                            <input type="text" id="phone_number" name="phone_number" value="{{ old('phone_number', $admin->phone_number) }}" class="w-full md:w-3/4 p-4 rounded-lg bg-gray-100 dark:bg-gray-700 border-2 border-gray-300 dark:border-gray-600 text-gray-800 dark:text-gray-100 placeholder-gray-500 dark:placeholder-gray-300 focus:outline-none focus:border-indigo-600 focus:ring-1 focus:ring-indigo-600 transition">
                        </div>

                        <!-- Admin Location -->
                        <div class="flex flex-col md:flex-row items-center space-y-4 md:space-y-0 md:space-x-4">
                            <i class="fas fa-map-marker-alt text-xl text-gray-600 dark:text-gray-300"></i>
                            <label for="location" class="text-xl text-gray-800 dark:text-gray-200 w-full md:w-1/4">Alamat:</label>
                            <input type="text" id="location" name="location" value="{{ old('location', $admin->location) }}" class="w-full md:w-3/4 p-4 rounded-lg bg-gray-100 dark:bg-gray-700 border-2 border-gray-300 dark:border-gray-600 text-gray-800 dark:text-gray-100 placeholder-gray-500 dark:placeholder-gray-300 focus:outline-none focus:border-indigo-600 focus:ring-1 focus:ring-indigo-600 transition">
                        </div>

                        <!-- Admin City -->
                        <div class="flex flex-col md:flex-row items-center space-y-4 md:space-y-0 md:space-x-4">
                            <i class="fas fa-city text-xl text-gray-600 dark:text-gray-300"></i>
                            <label for="city" class="text-xl text-gray-800 dark:text-gray-200 w-full md:w-1/4">Bandar:</label>
                            <input type="text" id="city" name="city" value="{{ old('city', $admin->city) }}" class="w-full md:w-3/4 p-4 rounded-lg bg-gray-100 dark:bg-gray-700 border-2 border-gray-300 dark:border-gray-600 text-gray-800 dark:text-gray-100 placeholder-gray-500 dark:placeholder-gray-300 focus:outline-none focus:border-indigo-600 focus:ring-1 focus:ring-indigo-600 transition">
                        </div>

                        <!-- Admin State -->
                        <div class="flex flex-col md:flex-row items-center space-y-4 md:space-y-0 md:space-x-4">
                            <i class="fas fa-map text-xl text-gray-600 dark:text-gray-300"></i>
                            <label for="state" class="text-xl text-gray-800 dark:text-gray-200 w-full md:w-1/4">Negeri:</label>
                            <input type="text" id="state" name="state" value="{{ old('state', $admin->state) }}" class="w-full md:w-3/4 p-4 rounded-lg bg-gray-100 dark:bg-gray-700 border-2 border-gray-300 dark:border-gray-600 text-gray-800 dark:text-gray-100 placeholder-gray-500 dark:placeholder-gray-300 focus:outline-none focus:border-indigo-600 focus:ring-1 focus:ring-indigo-600 transition">
                        </div>

                        <!-- Admin Faculty -->
                        <div class="flex flex-col md:flex-row items-center space-y-4 md:space-y-0 md:space-x-4">
                            <i class="fas fa-building text-xl text-gray-600 dark:text-gray-300"></i>
                            <label for="faculty" class="text-xl text-gray-800 dark:text-gray-200 w-full md:w-1/4">Fakulti:</label>
                            <select name="faculty" id="faculty" class="w-full md:w-3/4 p-4 rounded-lg bg-gray-100 dark:bg-gray-700 border-2 border-gray-300 dark:border-gray-600 text-gray-800 dark:text-gray-100 placeholder-gray-500 dark:placeholder-gray-300 focus:outline-none focus:border-indigo-600 focus:ring-1 focus:ring-indigo-600 transition">
                                <option value="" disabled selected {{ old('faculty', $admin->faculty) == null ? 'selected' : '' }}>Tiada</option>
                                <option value="Kolej Pengajian Pengkomputeran, Informatik dan Matematik" {{ old('faculty', $admin->faculty) == 'Kolej Pengajian Pengkomputeran, Informatik dan Matematik' ? 'selected' : '' }}>
                                    Kolej Pengajian Pengkomputeran, Informatik dan Matematik
                                </option>
                                <option value="Fakulti Perladangan dan Agroteknologi" {{ old('faculty', $admin->faculty) == 'Fakulti Perladangan dan Agroteknologi' ? 'selected' : '' }}>
                                    Fakulti Perladangan dan Agroteknologi
                                </option>
                            </select>
                        </div>

                        <!-- Submit Button -->
                        <div class="flex justify-center mt-8">
                            <button type="submit" class="bg-indigo-600 text-white px-10 py-5 rounded-2xl shadow-lg hover:bg-indigo-500 transition duration-300 flex items-center space-x-3">
                                <i class="fas fa-save text-xl"></i>
                                <span>Kemas Kini Maklumat</span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>