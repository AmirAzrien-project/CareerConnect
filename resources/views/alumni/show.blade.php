<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Paparan Data Alumni') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-100 dark:bg-gray-900">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
                <div class="flex items-center">
                    @if($alumni->profile_picture)
                    <img src="{{ asset('storage/' . $alumni->profile_picture) }}" alt="{{ $alumni->name }}'s profile picture" class="w-24 h-24 rounded-full border-2 border-blue-500 mr-4">
                    @else
                    <div class="w-24 h-24 rounded-full border-2 border-gray-400 bg-gray-200 flex items-center justify-center mr-4">
                        <span class="text-gray-600">No Image</span>
                    </div>
                    @endif
                    <h3 class="text-3xl font-bold text-gray-800 dark:text-gray-100">{{ $alumni->name }}</h3>
                </div>

                <div class="mt-4">
                    <p class="text-gray-600 dark:text-gray-400"><strong>Email:</strong> {{ $alumni->email }}</p>
                    <p class="text-gray-600 dark:text-gray-400"><strong>Phone:</strong> {{ $alumni->phone_number }}</p>
                    <p class="text-gray-600 dark:text-gray-400"><strong>Alamat:</strong> {{ $alumni->location }}, {{ $alumni->city }}, {{ $alumni->state }}</p>
                    <p class="text-gray-600 dark:text-gray-400"><strong>Tahun Graduasi:</strong> {{ $alumni->graduation_year }}</p>

                    @if($alumni->post)
                    <p class="text-gray-600 dark:text-gray-400"><strong>Latihan Praktikal:</strong> {{ $alumni->post->company_name }} - {{ $alumni->post->company_location }}, {{ $alumni->post->company_city }}, {{ $alumni->post->company_state }}</p>
                    @else
                    <p class="text-gray-600 dark:text-gray-400">No internship assigned</p>
                    @endif
                </div>

                <div class="mt-6 flex">
                    <!--<a href="{{ route('student.index') }}" class="text-blue-600 hover:underline mr-4">Kembali</a>-->
                    <a href="javascript:history.back()" class="text-blue-600 hover:underline mr-4">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>