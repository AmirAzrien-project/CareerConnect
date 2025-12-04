<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <!-- Background with Image applied to the entire body -->
    <div class="bg-cover bg-center min-h-screen">
        <!-- Instruction Section -->
        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="rounded-lg shadow-lg p-6 bg-white dark:bg-gray-800">
                    <h3 class="text-lg font-semibold text-indigo-700 dark:text-indigo-300 mb-4">Selamat Datang ke CareerConnect</h3>
                    <p class="text-gray-600 dark:text-gray-400 mb-4">
                        Berikut adalah panduan untuk navigasi laman ini:
                    </p>
                    <ul class="list-disc list-inside text-gray-600 dark:text-gray-400">
                        <li><strong>Borang Utama:</strong> Isi, muat naik, dan semak dokumen yang diperlukan sebelum melakukan permohonan.</li>
                        <li><strong>Borang Peribadi:</strong> Isi dan semak maklumat pelajar berdasarkan program pengajian.</li>
                        <li><strong>Senarai Pengguna:</strong> Semak maklumat pengguna yang terlibat.</li>
                    </ul>
                    <p class="mt-4 text-gray-600 dark:text-gray-400">Gunakan navigasi di atas untuk akses cepat ke bahagian-bahagian yang diperlukan.</p>
                </div>
            </div>
        </div>

        <!-- Logged-in User Info and Documents Section Side by Side -->
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mt-0"> <!-- Grid layout -->

                    <!-- Profile Section with Unique Horizontal & Vertical Layout -->
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-xl p-8 max-w-6xl mx-auto space-y-12">
                        <h3 class="text-3xl font-bold text-gray-800 dark:text-white mb-6 flex items-center space-x-3">
                            <i class="fas fa-user-circle text-[#2A74D6] text-4xl"></i>
                            <span>Maklumat Profil Anda</span>
                        </h3>

                        <!-- Horizontal Layout for First Set of Info (Profile Overview) -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <!-- Profile Overview Card -->
                            <div class="bg-[#E8F4FD] dark:bg-gray-700 rounded-lg p-6 flex items-center space-x-4 shadow-md transition-transform transform hover:scale-105 hover:shadow-xl hover:bg-[]">
                                <i class="fas fa-id-card text-[#2A74D6] text-3xl"></i>
                                <div>
                                    <span class="text-gray-600 dark:text-gray-300 font-semibold">No Pelajar</span>
                                    <p class="text-gray-800 dark:text-gray-200">{{ Auth::user()->user_id }}</p>
                                </div>
                            </div>

                            <div class="bg-[#E8F4FD] dark:bg-gray-700 rounded-lg p-6 shadow-md transition-transform transform hover:scale-105 hover:shadow-xl hover:bg-[]">
                                <i class="fas fa-user text-[#2A74D6] text-2xl"></i>
                                <div>
                                    <span class="text-gray-600 dark:text-gray-300 font-semibold">Nama Penuh</span>
                                    <p class="text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</p>
                                </div>
                            </div>

                            <div class="bg-[#E8F4FD] dark:bg-gray-700 rounded-lg p-6 shadow-md transition-transform transform hover:scale-105 hover:shadow-xl hover:bg-[]">
                                <i class="fas fa-envelope text-[#2A74D6] text-2xl"></i>
                                <div>
                                    <span class="text-gray-600 dark:text-gray-300 font-semibold">Emel</span>
                                    <p class="text-gray-800 dark:text-gray-200">{{ Auth::user()->email }}</p>
                                </div>
                            </div>

                            <div class="bg-[#E8F4FD] dark:bg-gray-700 rounded-lg p-6 shadow-md transition-transform transform hover:scale-105 hover:shadow-xl hover:bg-[]">
                                <i class="fas fa-phone-alt text-[#2A74D6] text-2xl"></i>
                                <div>
                                    <span class="text-gray-600 dark:text-gray-300 font-semibold">Nombor Telefon</span>
                                    <p class="text-gray-800 dark:text-gray-200">{{ Auth::user()->phone_number }}</p>
                                </div>
                            </div>

                        </div>

                        <!-- Vertical Layout for Other Info (Contact & Academic) -->
                        <div class="grid grid-cols-1 md:grid-cols-1 gap-4 mt-8">
                            <!-- Personal Details Column -->
                            <div class="space-y-8">
                                <div class="bg-[#E8F4FD] dark:bg-gray-700 rounded-lg p-6 shadow-md transition-transform transform hover:scale-105 hover:shadow-xl hover:bg-[]">
                                    <i class="fas fa-book text-[#2A74D6] text-2xl"></i>
                                    <div>
                                        <span class="text-gray-600 dark:text-gray-300 font-semibold">Program Pengajian</span>
                                        <p class="text-gray-800 dark:text-gray-200">{{ Auth::user()->student_course }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Academic Info Column -->
                        <div class="space-y-8">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-8">

                                <div class="bg-[#E8F4FD] dark:bg-gray-700 rounded-lg p-6 shadow-md transition-transform transform hover:scale-105 hover:shadow-xl hover:bg-[]">
                                    <i class="fas fa-calendar-alt text-[#2A74D6] text-2xl"></i>
                                    <div>
                                        <span class="text-gray-600 dark:text-gray-300 font-semibold">Semester</span>
                                        <p class="text-gray-800 dark:text-gray-200">{{ Auth::user()->part }}</p>
                                    </div>
                                </div>

                                <div class="bg-[#E8F4FD] dark:bg-gray-700 rounded-lg p-6 shadow-md transition-transform transform hover:scale-105 hover:shadow-xl hover:bg-[]">
                                    <i class="fas fa-chalkboard-teacher text-[#2A74D6] text-2xl"></i>
                                    <div>
                                        <span class="text-gray-600 dark:text-gray-300 font-semibold">Penasihat Akademik</span>
                                        <p class="text-gray-800 dark:text-gray-200">{{ Auth::user()->advisor }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Documents Section on the Right -->
                    <div class="space-y-6">

                        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl">
                            <div class="p-8">
                                <h3 class="text-3xl font-extrabold text-white mb-6">
                                    <i class="fas fa-folder-open text-yellow-400"></i> Dokumen Permohonan
                                </h3>
                                <div class="bg-white rounded-lg shadow-md p-6 space-y-6">
                                    @if ($coverLetter)
                                    <div class="flex items-center justify-between p-4 border border-gray-200 rounded-lg hover:shadow-lg">
                                        <div>
                                            <h4 class="text-lg font-semibold text-gray-800">
                                                <i class="fas fa-file text-blue-500"></i> {{ $coverLetter }}
                                            </h4>
                                            <p class="text-sm text-gray-500">
                                                File tersedia untuk dimuat turun.
                                            </p>
                                        </div>
                                        <a href="{{ asset('storage/cover_letters/' . $coverLetter) }}"
                                            class="inline-block px-4 py-2 text-sm font-medium text-white bg-blue-500 rounded-lg shadow-md hover:bg-blue-600"
                                            target="_blank">
                                            Lihat Dokumen
                                        </a>
                                    </div>
                                    @else
                                    <p class="text-center text-gray-500 text-lg font-medium">
                                        Dokumen anda belum dimuat naik. Sila hubungi PA.
                                    </p>
                                    @endif
                                </div>
                            </div>
                        </div>


                        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl">
                            <div class="max-w-4xl mx-auto">
                                <div class="bg-gray-800 text-white rounded-lg shadow-lg overflow-hidden">
                                    <div class="p-8">
                                        <h3 class="text-3xl font-bold mb-6">
                                            <i class="fas fa-folder text-indigo-500"></i> Dokumen Peribadi
                                        </h3>
                                        <div class="space-y-8">
                                            <!-- Resume -->
                                            <div class="flex items-center justify-between p-4 bg-gray-700 rounded-md hover:bg-gray-600 transition">
                                                <div class="flex items-center gap-4">
                                                    <i class="fas fa-file-alt text-indigo-500 text-4xl"></i>
                                                    <div>
                                                        <h4 class="text-lg font-semibold">Resume</h4>
                                                        @if (Auth::user()->resume)
                                                        <p class="text-sm text-gray-400">Resume anda telah dimuat naik.</p>
                                                        @else
                                                        <p class="text-sm text-gray-500">Tiada resume dimuat naik.</p>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div>
                                                    @if (Auth::user()->resume)
                                                    <a href="{{ asset('storage/' . Auth::user()->resume) }}" class="text-indigo-500 hover:text-indigo-400 text-sm">
                                                        <i class="fas fa-eye"></i> Lihat
                                                    </a>
                                                    @else
                                                    <a href="#" class="text-indigo-500 hover:text-indigo-400 text-sm">
                                                        <i class="fas fa-upload"></i> Muat Naik
                                                    </a>
                                                    @endif
                                                </div>
                                            </div>

                                            <!-- Cover Letter -->
                                            <div class="flex items-center justify-between p-4 bg-gray-700 rounded-md hover:bg-gray-600 transition">
                                                <div class="flex items-center gap-4">
                                                    <i class="fas fa-file-signature text-purple-500 text-4xl"></i>
                                                    <div>
                                                        <h4 class="text-lg font-semibold">Cover Letter</h4>
                                                        @if (Auth::user()->cover_letter)
                                                        <p class="text-sm text-gray-400">Cover letter anda telah dimuat naik.</p>
                                                        @else
                                                        <p class="text-sm text-gray-500">Tiada cover letter dimuat naik.</p>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div>
                                                    @if (Auth::user()->cover_letter)
                                                    <a href="{{ asset('storage/cover_letters/' . Auth::user()->cover_letter) }}" class="text-purple-500 hover:text-purple-400 text-sm">
                                                        <i class="fas fa-eye"></i> Lihat
                                                    </a>
                                                    @else
                                                    <a href="#" class="text-purple-500 hover:text-purple-400 text-sm">
                                                        <i class="fas fa-upload"></i> Muat Naik
                                                    </a>
                                                    @endif
                                                </div>
                                            </div>

                                            <!-- Log Book -->
                                            <div class="flex items-center justify-between p-4 bg-gray-700 rounded-md hover:bg-gray-600 transition">
                                                <div class="flex items-center gap-4">
                                                    <i class="fas fa-book text-teal-500 text-4xl"></i>
                                                    <div>
                                                        <h4 class="text-lg font-semibold">Log Book</h4>
                                                        @if (Auth::user()->logbook)
                                                        <p class="text-sm text-gray-400">Log book anda telah dimuat naik.</p>
                                                        @else
                                                        <p class="text-sm text-gray-500">Tiada log book dimuat naik.</p>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div>
                                                    @if (Auth::user()->logbook)
                                                    <a href="{{ asset('storage/' . Auth::user()->logbook) }}" class="text-teal-500 hover:text-teal-400 text-sm">
                                                        <i class="fas fa-eye"></i> Lihat
                                                    </a>
                                                    @else
                                                    <a href="#" class="text-teal-500 hover:text-teal-400 text-sm">
                                                        <i class="fas fa-upload"></i> Muat Naik
                                                    </a>
                                                    @endif
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>

    </div>
</x-app-layout>