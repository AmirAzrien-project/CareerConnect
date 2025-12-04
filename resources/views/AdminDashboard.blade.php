<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="bg-cover bg-center min-h-screen py-8"> <!-- Background -->

        <!-- Instruction Section -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-8">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
                <h3 class="text-lg font-semibold text-indigo-700 dark:text-indigo-300 mb-4">Selamat Datang ke CareerConnect</h3>
                <p class="text-gray-600 dark:text-gray-400 mb-4">
                    Berikut adalah panduan untuk navigasi laman ini:
                </p>
                <ul class="list-disc list-inside text-gray-600 dark:text-gray-400">
                    <li><strong>Borang Utama:</strong> Isi, muat naik, dan semak dokumen yang diperlukan.</li>
                    <li><strong>Borang Peribadi:</strong> Isi dan semak maklumat pelajar berdasarkan program pengajian.</li>
                    <li><strong>Senarai Pengguna:</strong> Semak maklumat pengguna yang terlibat.</li>
                </ul>
                <p class="mt-4 text-gray-600 dark:text-gray-400">
                    Gunakan navigasi di atas untuk akses cepat ke bahagian-bahagian yang diperlukan.
                </p>
            </div>
        </div>

        <!-- Content Section -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-2 gap-8">

            <!-- Profile Section -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
                <h3 class="text-xl font-bold text-gray-800 dark:text-white mb-6 flex items-center space-x-3">
                    <i class="fas fa-user-circle text-[#2A74D6] text-3xl"></i>
                    <span>Maklumat Profil</span>
                </h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    @php
                    $profileData = [
                    ['icon' => 'fa-id-card', 'label' => 'No ID', 'value' => Auth::user()->user_id],
                    ['icon' => 'fa-user', 'label' => 'Nama Penuh', 'value' => Auth::user()->name],
                    ['icon' => 'fa-envelope', 'label' => 'Emel', 'value' => Auth::user()->email],
                    ['icon' => 'fa-phone-alt', 'label' => 'Nombor Telefon', 'value' => Auth::user()->phone_number],
                    ];
                    @endphp
                    @foreach ($profileData as $item)
                    <div class="bg-[#E8F4FD] dark:bg-gray-700 rounded-lg p-6 shadow-md hover:shadow-lg transition">
                        <i class="fas {{ $item['icon'] }} text-[#2A74D6] text-2xl mb-2"></i>
                        <div>
                            <span class="text-gray-600 dark:text-gray-300 font-semibold">{{ $item['label'] }}</span>
                            <p class="text-gray-800 dark:text-gray-200">{{ $item['value'] }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
                <h3 class="text-xl font-bold text-gray-800 dark:text-white mb-6 flex items-center space-x-3">
                    <i class="fas fa-user-circle text-[#2A74D6] text-3xl"></i>
                    <span>Maklumat Akademik</span>
                </h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    @php
                    $profileData = [
                    ['icon' => 'fa-graduation-cap', 'label' => 'Fakulti Pengajian', 'value' => Auth::user()->faculty],
                    ];
                    @endphp
                    @foreach ($profileData as $item)
                    <div class="bg-[#E8F4FD] dark:bg-gray-700 rounded-lg p-6 shadow-md hover:shadow-lg transition">
                        <i class="fas {{ $item['icon'] }} text-[#2A74D6] text-2xl mb-2"></i>
                        <div>
                            <span class="text-gray-600 dark:text-gray-300 font-semibold">{{ $item['label'] }}</span>
                            <p class="text-gray-800 dark:text-gray-200">{{ $item['value'] }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Pending Students Section -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 flex flex-col">
                <h3 class="text-xl font-bold text-yellow-600 dark:text-yellow-300 mb-4">Pelajar (Pending)</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full table-auto divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-yellow-500 text-white">
                            <tr>
                                <th class="px-4 py-3 text-left text-sm font-medium">Nama Pelajar</th>
                                <th class="px-4 py-3 text-left text-sm font-medium">No ID</th>
                                <th class="px-4 py-3 text-left text-sm font-medium">Program</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            @forelse ($studentsPending as $student)
                            <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                <td class="px-4 py-3 text-sm text-gray-800 dark:text-gray-300">{{ $student->student_name }}</td>
                                <td class="px-4 py-3 text-sm text-gray-800 dark:text-gray-300">{{ $student->user_id }}</td>
                                <td class="px-4 py-3 text-sm text-gray-800 dark:text-gray-300">{{ $student->student_course }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="text-center text-gray-800 dark:text-gray-300 py-4">
                                    Tiada pelajar dengan status "Pending".
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <!-- Pagination -->
                <div class="mt-4">
                    {{ $studentsPending->links() }}
                </div>
            </div>

            <!-- Complete Students Section -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 flex flex-col">
                <h3 class="text-xl font-bold text-green-600 dark:text-green-300 mb-4">Pelajar (Complete)</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full table-auto divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-green-500 text-white">
                            <tr>
                                <th class="px-4 py-3 text-left text-sm font-medium">Nama Pelajar</th>
                                <th class="px-4 py-3 text-left text-sm font-medium">No ID</th>
                                <th class="px-4 py-3 text-left text-sm font-medium">Program</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            @forelse ($studentsComplete as $student)
                            <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                <td class="px-4 py-3 text-sm text-gray-800 dark:text-gray-300">{{ $student->student_name }}</td>
                                <td class="px-4 py-3 text-sm text-gray-800 dark:text-gray-300">{{ $student->user_id }}</td>
                                <td class="px-4 py-3 text-sm text-gray-800 dark:text-gray-300">{{ $student->student_course }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="text-center text-gray-800 dark:text-gray-300 py-4">
                                    Tiada pelajar dengan status "Complete".
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <!-- Pagination -->
                <div class="mt-4">
                    {{ $studentsComplete->links() }}
                </div>
            </div>

        </div>
    </div>
</x-app-layout>