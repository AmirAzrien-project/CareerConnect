<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Senarai Nama Alumni') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-100 dark:bg-gray-900">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
                <h3 class="text-lg font-bold text-gray-800 dark:text-gray-100"></h3>

                <div class="mt-4 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @if($users->isEmpty())
                    <p class="text-gray-600 dark:text-gray-400">No alumni available.</p>
                    @else
                    @foreach($users as $user)
                    <div class="bg-gray-50 dark:bg-gray-700 rounded-lg overflow-hidden shadow-lg transition-transform transform hover:scale-105">
                        <div class="p-4">
                            <h2 class="font-semibold text-lg text-gray-800 dark:text-gray-100">{{ $user->name }}</h2>
                            <p class="text-sm text-gray-600 dark:text-gray-400">{{ $user->email }}</p>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Tahun Graduasi: {{ $user->graduation_year }}</p>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Major: {{ $user->student_course }}</p>
                            <div class="mt-4">
                                <a href="{{ route('alumni.show', $user->id) }}" class="text-blue-600 dark:text-blue-400 hover:underline">View Profile</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>