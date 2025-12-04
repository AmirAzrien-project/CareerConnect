<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-3xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Paparan Data Pelajar') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-xl p-8 space-y-6">

                <!-- Profile Section -->
                <div class="flex flex-col md:flex-row items-center justify-between mb-8">
                    <div class="flex items-center space-x-6 mb-6 md:mb-0">
                        @if($student->profile_picture)
                        <img src="{{ asset('storage/' . $student->profile_picture) }}" alt="{{ $student->name }}'s profile picture" class="w-32 h-32 rounded-full border-4 border-indigo-600">
                        @else
                        <div class="w-32 h-32 rounded-full border-4 border-gray-400 bg-gray-200 flex items-center justify-center">
                            <span class="text-gray-600">Tiada Gambar</span>
                        </div>
                        @endif
                        <div>
                            <h3 class="text-4xl font-semibold text-gray-800 dark:text-gray-100">{{ $student->name }}</h3>
                            <p class="text-lg text-gray-500 dark:text-gray-300">{{ $student->student_course }}</p>
                        </div>
                    </div>
                </div>

                <!-- Personal Information Section -->
                <div class="space-y-6">
                    <div class="flex items-center space-x-4">
                        <i class="fas fa-envelope text-indigo-600"></i>
                        <p class="text-lg text-gray-800 dark:text-gray-100"><strong>Email:</strong> {{ $student->email }}</p>
                    </div>
                    <div class="flex items-center space-x-4">
                        <i class="fas fa-phone-alt text-indigo-600"></i>
                        <p class="text-lg text-gray-800 dark:text-gray-100"><strong>Telefon:</strong> {{ $student->phone_number }}</p>
                    </div>
                    <div class="flex items-center space-x-4">
                        <i class="fas fa-map-marker-alt text-indigo-600"></i>
                        <p class="text-lg text-gray-800 dark:text-gray-100"><strong>Alamat:</strong> {{ $student->location }}, {{ $student->city }}, {{ $student->state }}</p>
                    </div>
                    <div class="flex items-center space-x-4">
                        <i class="fas fa-graduation-cap text-indigo-600"></i>
                        <p class="text-lg text-gray-800 dark:text-gray-100"><strong>Program:</strong> {{ $student->student_course }}</p>
                    </div>
                    <div class="flex items-center space-x-4">
                        <i class="fas fa-signal text-indigo-600"></i>
                        <p class="text-lg text-gray-800 dark:text-gray-100"><strong>Semester:</strong> {{ $student->part }}</p>
                    </div>
                    <div class="flex items-center space-x-4">
                        <i class="fas fa-chalkboard-teacher text-indigo-600"></i>
                        <p class="text-lg text-gray-800 dark:text-gray-100"><strong>Penasihat Akademik:</strong> {{ $student->advisor }}</p>
                    </div>
                </div>

                <!-- Action Section -->
                <div class="mt-8 flex flex-col md:flex-row space-x-0 md:space-x-4 justify-center">
                    <!-- Back Button -->
                    <a href="{{ route('student.index') }}" class="bg-indigo-600 text-white px-6 py-3 rounded-full shadow-lg hover:bg-indigo-500 flex items-center space-x-2 transition duration-300">
                        <i class="fas fa-arrow-left"></i>
                        <span>Kembali</span>
                    </a>

                    <!-- Update Button (Admin only) -->
                    @if(Auth::user()->type == 2) <!-- Only show for admins -->
                    <a href="{{ route('student.edit', $student->id) }}" class="bg-yellow-500 text-white px-6 py-3 rounded-full shadow-lg hover:bg-yellow-400 flex items-center space-x-2 transition duration-300">
                        <i class="fas fa-edit"></i>
                        <span>Kemas Kini</span>
                    </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>