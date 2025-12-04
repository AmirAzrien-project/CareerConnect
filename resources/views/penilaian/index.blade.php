<x-app-layout>
    <x-slot name="header">
        <h2 class="text-4xl font-extrabold text-indigo-900 dark:text-indigo-300 text-center tracking-tight">
            {{ __('Penilaian Pelajar') }}
        </h2>
    </x-slot>

    <div class="py-16">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-12">

            <!-- Section 1: Student Information -->
            <div class="bg-white dark:bg-gray-800 p-8 rounded-xl shadow-lg border-l-4 border-indigo-500">
                <h3 class="text-2xl font-bold mb-6 text-indigo-600">Maklumat Pelajar</h3>
                <form action="{{ route('penilaian.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Student ID -->
                    <div class="mb-6">
                        <label for="student_id" class="block text-lg font-medium text-gray-700 dark:text-gray-300">
                            ID Pelajar
                        </label>
                        <input type="text" name="student_id" id="student_id"
                            value="{{ old('student_id', Auth::user()->user_id) }}"
                            class="text-black mt-2 p-3 w-full border-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 transition duration-300 ease-in-out"
                            readonly>
                        @error('student_id')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>
            </div>

            <!-- Section 2: Failsatu and Statussatu -->
            <div class="bg-white dark:bg-gray-800 p-8 rounded-xl shadow-md border-l-4 border-teal-500">
                <h3 class="text-xl font-semibold mb-4 text-teal-600">BLI-05: Penilaian Penyelia Industri</h3>
                <div class="mb-6">
                    <label for="failsatu" class="block text-lg font-medium text-gray-700 dark:text-gray-300">
                        Muat Naik Fail
                    </label>
                    <input type="file" name="failsatu" id="failsatu"
                        class="mt-2 p-3 w-full border-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 transition duration-300 ease-in-out">
                    @if (!empty($penilaian->failsatu))
                    <p class="mt-3 text-sm text-gray-600">
                        Fail Dimuat Naik:
                        <a href="{{ asset('storage/' . $penilaian->failsatu) }}" target="_blank" class="text-teal-600 underline">
                            {{ basename($penilaian->failsatu) }}
                        </a>
                    </p>
                    @endif
                </div>
                <div class="mt-3">
                    <span class="text-sm text-gray-600">Status:</span>
                    <p class="text-gray-900 dark:text-white">{{ ucfirst($penilaian->statussatu ?? 'Not Started') }}</p>
                </div>
            </div>

            <!-- Section 3: Faildua and Statusdua -->
            <div class="bg-white dark:bg-gray-800 p-8 rounded-xl shadow-md border-l-4 border-blue-500">
                <h3 class="text-xl font-semibold mb-4 text-blue-600">BLI-07: Penilaian Pelajar</h3>
                <div class="mb-6">
                    <label for="faildua" class="block text-lg font-medium text-gray-700 dark:text-gray-300">
                        Muat Naik Fail
                    </label>
                    <input type="file" name="faildua" id="faildua"
                        class="mt-2 p-3 w-full border-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300 ease-in-out">
                    @if (!empty($penilaian->faildua))
                    <p class="mt-3 text-sm text-gray-600">
                        Fail Dimuat Naik:
                        <a href="{{ asset('storage/' . $penilaian->faildua) }}" target="_blank" class="text-blue-600 underline">
                            {{ basename($penilaian->faildua) }}
                        </a>
                    </p>
                    @endif
                </div>
                <div class="mt-3">
                    <span class="text-sm text-gray-600">Status:</span>
                    <p class="text-gray-900 dark:text-white">{{ ucfirst($penilaian->statusdua ?? 'Not Started') }}</p>
                </div>
            </div>

            <!-- Section 4: Failtiga and Failempat -->
            <div class="bg-white dark:bg-gray-800 p-8 rounded-xl shadow-md border-l-4 border-purple-500">
                <h3 class="text-xl font-semibold mb-4 text-purple-600">BLI-06: Penilaian Lawatan (PA)</h3>
                <h3 class="text-xl font-semibold mb-4 text-purple-600">BLI-08: Penyelia Akademik</h3>

                <!-- Failtiga Section -->
                <div class="mb-6">
                    <label for="failtiga" class="block text-lg font-medium text-gray-700 dark:text-gray-300">
                        Muat Naik Fail (BLI-06)
                    </label>
                    <input type="file" name="failtiga" id="failtiga"
                        class="mt-2 p-3 w-full border-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 transition duration-300 ease-in-out">
                    @if (!empty($penilaian->failtiga))
                    <p class="mt-3 text-sm text-gray-600">
                        Fail Dimuat Naik:
                        <a href="{{ asset('storage/' . $penilaian->failtiga) }}" target="_blank" class="text-purple-600 underline">
                            {{ basename($penilaian->failtiga) }}
                        </a>
                    </p>
                    @endif
                </div>

                <!-- Failempat Section -->
                <div class="mb-6">
                    <label for="failempat" class="block text-lg font-medium text-gray-700 dark:text-gray-300">
                        Muat Naik Fail (BLI-08)
                    </label>
                    <input type="file" name="failempat" id="failempat"
                        class="mt-2 p-3 w-full border-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 transition duration-300 ease-in-out">
                    @if (!empty($penilaian->failempat))
                    <p class="mt-3 text-sm text-gray-600">
                        Fail Dimuat Naik:
                        <a href="{{ asset('storage/' . $penilaian->failempat) }}" target="_blank" class="text-purple-600 underline">
                            {{ basename($penilaian->failempat) }}
                        </a>
                    </p>
                    @endif
                </div>

                <div class="mt-3">
                    <span class="text-sm text-gray-600">Status:</span>
                    <p class="text-gray-900 dark:text-white">{{ ucfirst($penilaian->statustiga ?? 'Not Started') }}</p>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="text-center mt-8">
                <button type="submit"
                    class="bg-teal-600 text-white py-3 px-10 rounded-lg shadow-lg hover:bg-teal-700 transition duration-300 ease-in-out transform hover:scale-105 font-semibold tracking-wide">
                    Kemaskini Penilaian
                </button>
            </div>
            </form>

        </div>
    </div>
</x-app-layout>