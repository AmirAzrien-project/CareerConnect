<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Generate Resume') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-6 bg-gray-100 dark:bg-gray-900">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
                <form action="{{ route('resume.generate') }}" method="POST">
                    @csrf
                    <div class="space-y-4">
                        <div>
                            <label class="block text-gray-700 dark:text-gray-300">Name:</label>
                            <input type="text" name="name" required class="mt-1 block w-full border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                        </div>
                        <div>
                            <label class="block text-gray-700 dark:text-gray-300">Email:</label>
                            <input type="email" name="email" required class="mt-1 block w-full border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                        </div>
                        <div>
                            <label class="block text-gray-700 dark:text-gray-300">Phone:</label>
                            <input type="text" name="phone" required class="mt-1 block w-full border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                        </div>
                        <div>
                            <label class="block text-gray-700 dark:text-gray-300">Education:</label>
                            <textarea name="education" required class="mt-1 block w-full border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"></textarea>
                        </div>
                        <div>
                            <label class="block text-gray-700 dark:text-gray-300">Experience:</label>
                            <textarea name="experience" required class="mt-1 block w-full border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"></textarea>
                        </div>
                        <div>
                            <label class="block text-gray-700 dark:text-gray-300">Skills:</label>
                            <textarea name="skills" required class="mt-1 block w-full border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"></textarea>
                        </div>
                        <button type="submit" class="mt-4 bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-500 transition duration-200">
                            Generate Resume
                        </button>
                    </div>
                </form>

                @if(isset($data))
                <h2 class="mt-6 text-2xl font-semibold text-gray-800 dark:text-gray-200">Your Resume:</h2>
                <div class="mt-4 text-gray-800 dark:text-gray-200 space-y-2">
                    <p><strong>Name:</strong> {{ $data['name'] }}</p>
                    <p><strong>Email:</strong> {{ $data['email'] }}</p>
                    <p><strong>Phone:</strong> {{ $data['phone'] }}</p>

                    <h2 class="mt-4 text-xl font-semibold">Education</h2>
                    <p>{{ $data['education'] }}</p>

                    <h2 class="mt-4 text-xl font-semibold">Experience</h2>
                    <p>{{ $data['experience'] }}</p>

                    <h2 class="mt-4 text-xl font-semibold">Skills</h2>
                    <p>{{ $data['skills'] }}</p>

                    <h2 class="mt-4 text-xl font-semibold">Download Links</h2>
                    <p><a href="{{ asset($docxPath) }}" class="text-blue-600 underline">Download Word Document</a></p>
                    <p><a href="{{ asset($pdfPath) }}" class="text-blue-600 underline">Download PDF</a></p>
                </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>