<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Permohonan Pelajar') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md overflow-hidden">

                <!-- Form to Edit Application -->
                <form action="{{ route('mohon.update', $mohon->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="user_id" value="{{ $mohon->user_id }}">

                    @if ($errors->any())
                    <div class="bg-red-500 text-white p-4 rounded-md">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <!-- Document Upload Section (separate) -->
                    <div class="mb-6">
                        <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-100">SLI - 01</h3>
                        <div class="mt-4">
                            <input type="file" id="dokumen_mohon" name="dokumen_mohon" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm" />
                        </div>
                        <div class="mt-2">
                            @if($mohon->dokumen_mohon)
                            <a href="{{ asset('storage/'.$mohon->dokumen_mohon) }}" target="_blank"
                                class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-600 transition duration-300 ease-in-out">
                                -> Tekan untuk paparkan Borang SLI - 01 <-
                                    </a>
                                    @else
                                    <span class="text-gray-500">No Document</span>
                                    @endif
                        </div>
                    </div>

                    <!-- Student Information Section (Dropdown Button) -->
                    <div class="mb-6">
                        <button type="button" class="w-full text-left px-4 py-2 bg-indigo-600 text-white font-medium rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 flex items-center justify-between" id="toggleStudentInfo">
                            <span>Maklumat Permohonan Pelajar</span>
                            <svg id="dropdownIcon" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>

                        <div id="studentInfo" class="mt-4 hidden">
                            <div>
                                <label for="user_id" class="block text-gray-200 font-medium mb-2">No Pelajar</label>
                                <p class="text-gray-400 text-sm mt-1">Contoh: 2015665547</p>
                                <x-text-input id="user_id" name="user_id" type="text" class="block w-full mt-1" value="{{ $mohon->user_id }}" required />
                            </div>

                            <div>
                                <label for="name" class="block text-gray-200 font-medium mb-2">Nama Penuh</label>
                                <p class="text-gray-400 text-sm mt-1">Ditulis dengan huruf besar, contoh: SITI AISYAH BT MUHAMMAD</p>
                                <x-text-input id="name" name="name" type="text" class="block w-full mt-1" value="{{ $mohon->name }}" required />
                            </div>

                            <div>
                                <label for="no_ic" class="block text-gray-200 font-medium mb-2">No Kad Pengenalan</label>
                                <p class="text-gray-400 text-sm mt-1">Format: xxxxxx-xx-xxxx, sila letak simbol '-'</p>
                                <x-text-input id="no_ic" name="no_ic" type="text" class="block w-full mt-1" value="{{ $mohon->no_ic }}" required />
                            </div>

                            <div>
                                <label for="phone_number" class="block text-gray-200 font-medium mb-2">No Telefon Bimbit</label>
                                <p class="text-gray-400 text-sm mt-1">Format: 012-345 6789, sila letak simbol '-'</p>
                                <x-text-input id="phone_number" name="phone_number" type="text" class="block w-full mt-1" value="{{ $mohon->phone_number }}" required />
                                @error('phone_number')
                                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="email" class="block text-gray-200 font-medium mb-2">Email</label>
                                <p class="text-gray-400 text-sm mt-1">Ditulis dengan huruf kecil, contoh: intern@abcd.com</p>
                                <x-text-input id="email" name="email" type="email" class="block w-full mt-1" value="{{ $mohon->email }}" readonly />
                            </div>

                            <div>
                                <label for="student_course" class="block text-gray-200 font-medium mb-2">Program</label>
                                <p class="text-gray-400 text-sm mt-1"></p>
                                <select id="student_course" name="student_course" class="block w-full mt-1 bg-gray-800 text-gray-100 border border-gray-700 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent" required>
                                    <option value="{{ $mohon->student_course }}" disabled selected>{{ $mohon->student_course }}</option>
                                    <option value="CS230 - Bachelor of Computer Science (Hons.)">CS230 - Bachelor of Computer Science (Hons.)</option>
                                    <option value="CS245 - Bachelor of Computer Science (Hons.) Data Communication and Networking">CS245 - Bachelor of Computer Science (Hons.) Data Communication and Networking</option>
                                    <option value="CS246 - Bachelor of Information Technology (Hons.) Information Systems Engineering">CS246 - Bachelor of Information Technology (Hons.) Information Systems Engineering</option>
                                    <option value="CS251 - Bachelor of Computer Science (Hons.) Netcentric Computing">CS251 - Bachelor of Computer Science (Hons.) Netcentric Computing</option>
                                    <option value="CS253 - Bachelor of Computer Science (Hons.) Multimedia Computing">CS253 - Bachelor of Computer Science (Hons.) Multimedia Computing</option>
                                    <option value="CS255 - Bachelor of Computer Science (Hons.) Computer Networks">CS255 - Bachelor of Computer Science (Hons.) Computer Networks</option>
                                    <option value="CS266 - Bachelor of Information Technology (Hons.) Information Systems Engineering">CS266 - Bachelor of Information Technology (Hons.) Information Systems Engineering</option>
                                </select>
                            </div>

                            <div>
                                <label for="part" class="block text-gray-200 font-medium mb-2">Semester Ketika LI</label>
                                <p class="text-gray-400 text-sm mt-1"></p>
                                <select id="part" name="part" class="block w-full mt-1 bg-gray-800 text-gray-100 border border-gray-700 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent" required>
                                    <option value="{{ $mohon->part }}" disabled selected>{{ $mohon->part }}</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                </select>
                            </div>

                            <div>
                                <label for="pointer" class="block text-gray-200 font-medium mb-2">CGPA</label>
                                <p class="text-gray-400 text-sm mt-1"></p>
                                <x-text-input id="pointer" name="pointer" type="text" class="block w-full mt-1" value="{{ $mohon->pointer }}" required />
                            </div>

                            <div>
                                <label for="student_address" class="block text-gray-200 font-medium mb-2">Alamat Menyurat</label>
                                <p class="text-gray-400 text-sm mt-1">Ditulis dengan huruf besar, contoh: NO 12, JALAN YAKIN 3/4, TAMAN ROS, 56789 MERLIMAU, MELAKA</p>
                                <textarea id="student_address" name="student_address" rows="3" class="block w-full mt-1 bg-gray-800 text-gray-100 p-3 rounded-lg">{{ $mohon->student_address }}</textarea>
                            </div>

                            <div>
                                <label for="parents" class="block text-gray-200 font-medium mb-2">Nama Penjaga</label>
                                <p class="text-gray-400 text-sm mt-1">Ditulis dengan huruf besar, contoh: SITI AISYAH BT MUHAMMAD</p>
                                <x-text-input id="parents" name="parents" type="text" class="block w-full mt-1" value="{{ $mohon->parents }}" required />
                            </div>

                            <div>
                                <label for="parents_address" class="block text-gray-200 font-medium mb-2">Alamat Penjaga</label>
                                <p class="text-gray-400 text-sm mt-1">Ditulis dengan huruf besar, contoh: NO 12, JALAN YAKIN 3/4, TAMAN ROS, 56789 MERLIMAU, MELAKA</p>
                                <textarea id="parents_address" name="parents_address" rows="3" class="block w-full mt-1 bg-gray-800 text-gray-100 p-3 rounded-lg">{{ $mohon->parents_address }}</textarea>
                            </div>

                            <div>
                                <label for="parents_number" class="block text-gray-200 font-medium mb-2">No Telefon Penjaga</label>
                                <p class="text-gray-400 text-sm mt-1">Format: 012-345 6789, sila letak simbol '-'</p>
                                <x-text-input id="parents_number" name="parents_number" type="text" class="block w-full mt-1" value="{{ $mohon->parents_number }}" required />
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="mb-4">
                        <button type="submit" class="inline-flex items-center px-6 py-2 bg-indigo-600 text-white font-medium rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            Kemas Kini
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Toggle the visibility of the student information section
        document.getElementById('toggleStudentInfo').addEventListener('click', function() {
            const studentInfo = document.getElementById('studentInfo');
            if (studentInfo.classList.contains('hidden')) {
                studentInfo.classList.remove('hidden');
            } else {
                studentInfo.classList.add('hidden');
            }
        });
    </script>

</x-app-layout>