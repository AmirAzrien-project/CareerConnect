<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Cover Letters') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 dark:bg-gray-900">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md overflow-hidden">
                @if (Auth::user()->type === 1)
                <!-- Student View -->
                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">Your Cover Letter</h3>
                @if ($coverLetterPath)
                <p class="mt-4 text-gray-700 dark:text-gray-300">
                    <a href="{{ asset($coverLetterPath) }}" target="_blank"
                        class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-600 transition duration-300">
                        View Cover Letter
                    </a>
                </p>
                @else
                <p class="mt-4 text-gray-700 dark:text-gray-300">No cover letter uploaded.</p>
                @endif
                @elseif (Auth::user()->type === 2)
                <!-- Admin View -->
                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">All Cover Letters</h3>
                <table class="min-w-full table-auto divide-y divide-gray-200 dark:divide-gray-700 mt-4">
                    <thead class="bg-indigo-600 text-white">
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-medium">ID</th>
                            <th class="px-6 py-3 text-left text-sm font-medium">Name</th>
                            <th class="px-6 py-3 text-left text-sm font-medium">Email</th>
                            <th class="px-6 py-3 text-left text-sm font-medium">Program</th>
                            <th class="px-6 py-3 text-left text-sm font-medium">Cover Letter</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800">
                        @foreach ($users as $user)
                        <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                            <td class="px-6 py-4 text-sm font-medium text-gray-800 dark:text-gray-300">{{ $user->id }}</td>
                            <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-300">{{ $user->name }}</td>
                            <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-300">{{ $user->email }}</td>
                            <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-300">{{ $user->student_course }}</td>
                            <td class="px-6 py-4 text-sm font-medium">
                                <a href="{{ asset('storage/' . $user->cover_letter) }}" target="_blank"
                                    class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-600 transition duration-300">
                                    View Cover Letter
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>