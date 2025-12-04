<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('BLI-01 BORANG MAKLUMAT PERIBADI') }}
        </h2>
    </x-slot>

    <div class="">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Section: Header and Information -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-8 mb-12">
                <div class="">
                    <h3 class="text-2xl font-bold text-gray-100 leading-8">
                        CST688 / CST699: Latihan Industri<br>
                        Ijazah Sarjana Muda KPPIM<br>
                        Universiti Teknologi MARA<br>
                        Cawangan Melaka Kampus Jasin
                    </h3>
                    <br>
                    <p class="text-gray-300 text-lg mt-4 leading-relaxed">
                        Maklumat ini perlu diisi oleh pelajar bagi mengeluarkan surat iringan penyelaras untuk memohon penempatan LI.
                        <br class="my-2">
                        Mohon isikan butiran dengan lengkap mengikut contoh yang disertakan.
                        <br class="my-2">
                        Sekian, Terima Kasih.
                    </p>
                </div>
                <br>
                <!-- Scroll to Bottom Button -->
                <button id="scrollToBottomBtn"
                    class="flex items-center bg-indigo-600 text-white py-3 px-5 rounded-lg hover:bg-indigo-500 transition duration-300 shadow-lg">
                    <svg class="w-6 h-6 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
            </div>

            <!-- Success Message -->
            @if (session('success'))
            <div class="bg-green-500 text-green-100 p-4 rounded-lg shadow-md mb-6">
                <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
            </div>
            @endif

            <!-- Form Section -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-8 mb-12">

                <!-- Section Pelajar -->
                <div class="mb-12">
                    <!-- Section Wrapper -->
                    <div class="bg-green-800 bg-opacity-20 border-l-8 border-green-600 p-8 rounded-lg shadow-lg">
                        <!-- Section Heading -->
                        <div class="flex items-center space-x-4 mb-4">
                            <div class="text-green-600">
                                <i class="fas fa-user-graduate fa-2x"></i>
                            </div>
                            <h2 id="studentInfo" class="text-3xl font-bold text-gray-200">
                                Maklumat Peribadi Pelajar
                            </h2>
                        </div>
                        <!-- Section Description -->
                        <p class="text-lg text-gray-300 mb-4">
                            Sila pastikan maklumat peribadi anda diisi dengan tepat untuk memudahkan proses pengurusan.
                        </p>
                    </div>
                </div>

                <form action="{{ route('mohon.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Error Message -->
                    @if ($errors->any())
                    <div class="bg-red-500 text-white p-4 rounded-lg mb-6">
                        <i class="fas fa-exclamation-triangle mr-2"></i>
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <!-- Input Fields Section -->
                    <div class="space-y-6">

                        <!-- No Pelajar -->
                        <div>
                            <label for="user_id" class="block text-gray-200 font-medium mb-2">No Pelajar</label>
                            <p class="text-gray-400 text-sm mt-1">Contoh: 2015665547</p>
                            <x-text-input id="user_id" name="user_id" type="text" class="block w-full mt-2 bg-gray-800 text-gray-100 p-4 rounded-lg" value="{{ Auth::user()->user_id }}" required />
                        </div>

                        <!-- Nama Penuh -->
                        <div>
                            <label for="name" class="block text-gray-200 font-medium mb-2">Nama Penuh</label>
                            <p class="text-gray-400 text-sm mt-1">Ditulis dengan huruf besar, contoh: SITI AISYAH BT MUHAMMAD</p>
                            <x-text-input id="name" name="name" type="text" class="block w-full mt-2 bg-gray-800 text-gray-100 p-4 rounded-lg" value="{{ Auth::user()->name }}" oninput="this.value = this.value.toUpperCase();" required />
                        </div>

                        <!-- No Kad Pengenalan -->
                        <div>
                            <label for="no_ic" class="block text-gray-200 font-medium mb-2">No Kad Pengenalan</label>
                            <p class="text-gray-400 text-sm mt-1">Format: xxxxxx-xx-xxxx, sila letak simbol '-'</p>
                            <x-text-input id="no_ic" name="no_ic" type="text" class="block w-full mt-2 bg-gray-800 text-gray-100 p-4 rounded-lg" value="{{ old('no_ic', Auth::user()->no_ic) }}" required />
                        </div>

                        <!-- No Telefon Bimbit -->
                        <div>
                            <label for="phone_number" class="block text-gray-200 font-medium mb-2">No Telefon Bimbit</label>
                            <p class="text-gray-400 text-sm mt-1">Format: 012-345 6789, sila letak simbol '-'</p>
                            <x-text-input id="phone_number" name="phone_number" type="text" class="block w-full mt-2 bg-gray-800 text-gray-100 p-4 rounded-lg" value="{{ Auth::user()->phone_number }}" required />
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-gray-200 font-medium mb-2">Email</label>
                            <p class="text-gray-400 text-sm mt-1">Ditulis dengan huruf kecil, contoh: intern@abcd.com</p>
                            <x-text-input id="email" name="email" type="email" class="block w-full mt-2 bg-gray-800 text-gray-100 p-4 rounded-lg" value="{{ Auth::user()->email }}" required />
                        </div>

                        <!-- Program -->
                        <div>
                            <label for="student_course" class="block text-gray-200 font-medium mb-2">Program</label>
                            <select id="student_course" name="student_course" class="block w-full mt-2 bg-gray-800 text-gray-100 border border-gray-700 rounded-lg p-4 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent" required>
                                <!-- <option value="{{ Auth::user()->student_course }}" disabled selected>{{ Auth::user()->student_course }}</option> -->
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

                        <!-- Semester -->
                        <div>
                            <label for="part" class="block text-gray-200 font-medium mb-2">Semester Ketika LI</label>
                            <select id="part" name="part" class="block w-full mt-2 bg-gray-800 text-gray-100 border border-gray-700 rounded-lg p-4 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent" required>
                                <option value="" disabled selected>Sila Pilih</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                            </select>
                        </div>

                        <!-- CGPA -->
                        <div>
                            <label for="pointer" class="block text-gray-200 font-medium mb-2">CGPA</label>
                            <x-text-input id="pointer" name="pointer" type="text" class="block w-full mt-2 bg-gray-800 text-gray-100 p-4 rounded-lg" required />
                        </div>

                        <!-- Alamat Menyurat -->
                        <div>
                            <label for="student_address" class="block text-gray-200 font-medium mb-2">Alamat Menyurat</label>
                            <textarea id="student_address" name="student_address" rows="3" class="block w-full mt-2 bg-gray-800 text-gray-100 p-4 rounded-lg" value=""></textarea>
                        </div>

                        <br><br><br>

                        <!-- Section Penjaga -->
                        <div class="mt-16 mb-12">
                            <!-- Section Wrapper -->
                            <div class="bg-indigo-800 bg-opacity-20 border-l-8 border-indigo-600 p-8 rounded-lg shadow-lg">
                                <!-- Section Heading -->
                                <div class="flex items-center space-x-4 mb-4">
                                    <div class="text-indigo-600">
                                        <i class="fas fa-user-shield fa-2x"></i>
                                    </div>
                                    <h2 id="parentsInfo" class="text-3xl font-bold text-gray-200">
                                        Maklumat Penjaga
                                    </h2>
                                </div>
                                <!-- Section Description -->
                                <p class="text-lg text-gray-300 mb-4">
                                    Sila isi maklumat penjaga anda dengan lengkap dan tepat. Maklumat ini penting untuk sebarang keperluan kecemasan.
                                </p>
                            </div>
                        </div>

                        <!-- Nama Penjaga -->
                        <div class="mt-8">
                            <label for="parents" class="block text-gray-200 font-medium mb-2">Nama Penjaga</label>
                            <p class="text-gray-400 text-sm mt-1">Ditulis dengan huruf besar, contoh: SITI AISYAH BT MUHAMMAD</p>
                            <x-text-input id="parents" name="parents" type="text" class="block w-full mt-2 bg-gray-800 text-gray-100 p-4 rounded-lg" oninput="this.value = this.value.toUpperCase();" required />
                        </div>

                        <!-- No Telefon Penjaga -->
                        <div class="mt-6">
                            <label for="parents_number" class="block text-gray-200 font-medium mb-2">No Telefon Penjaga</label>
                            <p class="text-gray-400 text-sm mt-1">Format: 012-345 6789, sila letak simbol '-'</p>
                            <x-text-input id="parents_number" name="parents_number" type="text" class="block w-full mt-2 bg-gray-800 text-gray-100 p-4 rounded-lg" />
                        </div>

                        <!-- Alamat Penjaga -->
                        <div class="mt-6">
                            <label for="parents_address" class="block text-gray-200 font-medium mb-2">Alamat Penjaga</label>
                            <textarea id="parents_address" name="parents_address" rows="3" class="block w-full mt-2 bg-gray-800 text-gray-100 p-4 rounded-lg"></textarea>
                        </div>

                        <!-- Section Footer -->
                        <div class="mt-8">
                            <div class="bg-indigo-600 h-1 rounded-full"></div>
                        </div>

                    </div>
                    <br>
                    <!-- Butang Hantar -->
                    <div class="flex justify-center">
                        <button type="submit" class="w-full flex items-center justify-center bg-indigo-600 text-white py-4 rounded-2xl hover:bg-indigo-500 transition duration-300 shadow-xl">
                            Hantar Borang
                        </button>
                    </div>

                </form>
            </div>

            <!-- Table Section -->
            @if(Auth::user()->user == 1) <!-- Check if the logged-in user is 'user=1' -->
            <div class="bg-white dark:bg-gray-800 shadow-2xl rounded-3xl p-10">
                <h3 class="text-2xl font-semibold text-gray-800 dark:text-gray-100 mb-8">Data Pelajar</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-gray-50 dark:bg-gray-700 rounded-2xl shadow-md text-left">
                        <thead class="bg-indigo-600 text-white">
                            <tr>
                                <th class="px-6 py-4 text-sm font-medium uppercase">No Pelajar</th>
                                <th class="px-6 py-4 text-sm font-medium uppercase">Nama Penuh</th>
                                <th class="px-6 py-4 text-sm font-medium uppercase">No Kad Pengenalan</th>
                                <th class="px-6 py-4 text-sm font-medium uppercase">No Telefon Bimbit</th>
                                <th class="px-6 py-4 text-sm font-medium uppercase">Program</th>
                                <th class="px-6 py-4 text-sm font-medium uppercase">CGPA</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-600">
                            @foreach($mohons as $mohon)
                            <tr class="text-gray-800 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-800 transition-all duration-200">
                                <td class="px-6 py-4">{{ $mohon->user_id }}</td>
                                <td class="px-6 py-4">{{ $mohon->name }}</td>
                                <td class="px-6 py-4">{{ $mohon->no_ic }}</td>
                                <td class="px-6 py-4">{{ $mohon->phone_number }}</td>
                                <td class="px-6 py-4">{{ $mohon->student_course }}</td>
                                <td class="px-6 py-4">{{ $mohon->pointer }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endif

        </div>
    </div>

    <!-- JavaScript untuk Scroll Ke Bawah -->
    <script>
        document.getElementById('scrollToBottomBtn').addEventListener('click', function() {
            window.scrollTo({
                top: document.body.scrollHeight,
                behavior: 'smooth'
            });
        });
    </script>
</x-app-layout>