<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-3xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Permohonan Penempatan') }}
        </h2>
    </x-slot>

    <div class="py-12 min-h-screen">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-8 space-y-8">
                <!-- Section: Introduction -->
                <div class="text-center space-y-2">
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-gray-100">SLI-02 & BLI-02</h3>
                    <p class="text-gray-600 dark:text-gray-400">Lengkapkan borang berikut untuk memohon penempatan latihan industri anda.</p>
                </div>

                <!-- Success Message -->
                @if (session('success'))
                <div class="bg-green-100 text-green-800 p-4 rounded-md flex items-center shadow">
                    <i class="fas fa-check-circle w-6 h-6 mr-2"></i>
                    <span>{{ session('success') }}</span>
                </div>
                @endif

                <!-- Validation Errors -->
                @if ($errors->any())
                <div class="bg-red-100 text-red-800 p-4 rounded-md flex items-center shadow">
                    <i class="fas fa-exclamation-circle w-6 h-6 mr-2"></i>
                    <div>
                        <ul class="list-disc pl-5">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @endif

                <!-- Form Start -->
                <form action="{{ route('mohon2.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                    @csrf

                    <!-- Dokumen 2 -->
                    <div class="border rounded-lg p-6 bg-gray-50 dark:bg-gray-700">
                        <h4 class="font-semibold text-lg text-gray-900 dark:text-gray-100 mb-4">Borang SLI - 02</h4>
                        <p class="text-gray-600 dark:text-gray-300 mb-2">Surat Permohonan Penempatan Pelajar</p>
                        <div class="space-y-4">
                            @if ($dokumen2)
                            <div class="flex items-center bg-green-100 text-green-800 p-3 rounded-lg shadow">
                                <i class="fas fa-check-circle w-5 h-5 mr-2"></i>
                                <span>Dokumen telah dimuat naik:</span>
                                <span class="ml-2 font-medium">{{ $dokumen2 }}</span>
                            </div>
                            <a href="{{ asset('storage/dokumen/'.$dokumen2) }}" target="_blank" class="block text-indigo-600 hover:underline">
                                <i class="fas fa-file-pdf mr-2"></i>Lihat Borang SLI - 02
                            </a>
                            @else
                            <div class="flex items-center bg-red-100 text-red-800 p-3 rounded-lg shadow">
                                <i class="fas fa-exclamation-circle w-5 h-5 mr-2"></i>
                                <span>Dokumen belum dimuat naik.</span>
                            </div>
                            @endif

                            <input type="file" name="dokumen2" id="dokumen2" class="block w-full p-3 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-indigo-500 shadow-sm" accept=".pdf,.doc,.docx" />
                            <p class="text-sm text-gray-500 dark:text-gray-400">Muat naik Borang SLI - 02 dalam format PDF. Pastikan dokumen jelas dan lengkap.</p>
                        </div>
                    </div>

                    <!-- Dokumen 3 -->
                    <div class="border rounded-lg p-6 bg-gray-50 dark:bg-gray-700">
                        <h4 class="font-semibold text-lg text-gray-900 dark:text-gray-100 mb-4">Borang BLI - 02</h4>
                        <p class="text-gray-600 dark:text-gray-300 mb-2">Borang Jawapan Penempatan Latihan Industri</p>
                        <div class="space-y-4">
                            @if ($dokumen3)
                            <div class="flex items-center bg-green-100 text-green-800 p-3 rounded-lg shadow">
                                <i class="fas fa-check-circle w-5 h-5 mr-2"></i>
                                <span>Dokumen telah dimuat naik:</span>
                                <span class="ml-2 font-medium">{{ $dokumen3 }}</span>
                            </div>
                            <a href="{{ asset('storage/dokumen/'.$dokumen3) }}" target="_blank" class="block text-indigo-600 hover:underline">
                                <i class="fas fa-file-pdf mr-2"></i>Lihat Borang BLI - 02
                            </a>
                            @else
                            <div class="flex items-center bg-red-100 text-red-800 p-3 rounded-lg shadow">
                                <i class="fas fa-exclamation-circle w-5 h-5 mr-2"></i>
                                <span>Dokumen belum dimuat naik.</span>
                            </div>
                            @endif

                            <input type="file" name="dokumen3" id="dokumen3" class="block w-full p-3 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-indigo-500 shadow-sm" accept=".pdf,.doc,.docx" />
                            <p class="text-sm text-gray-500 dark:text-gray-400">Muat naik Borang BLI - 02 dalam format PDF. Pastikan dokumen jelas dan lengkap.</p>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div>
                        <button type="submit" class="w-full bg-indigo-600 text-white py-3 rounded-lg hover:bg-indigo-500 transition duration-200 shadow-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            <i class="fas fa-paper-plane mr-2"></i> Muat Naik Borang
                        </button>
                    </div>
                </form>
                <!-- Form End -->
            </div>
        </div>
    </div>
</x-app-layout>