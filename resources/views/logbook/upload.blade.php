<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-4xl text-white leading-tight">
            {{ __('Paparan Logbook') }}
        </h2>
    </x-slot>

    <div class="py-12 min-h-screen">
        <div class="max-w-5xl mx-auto bg-gray-900 rounded-3xl shadow-2xl p-8 sm:p-12 text-gray-200 space-y-12">

            <!-- Section: Introduction -->
            <div class="text-center space-y-4">
                <h3 class="text-xl font-bold">Selamat Datang ke Paparan Logbook</h3>
                <p class="text-gray-400">
                    Halaman ini membolehkan anda memuat naik, dan memuat turun logbook anda.
                    Pastikan anda mengemaskini logbook setiap minggu untuk rekod yang lebih baik.
                </p>
            </div>

            <!-- Success and Error Messages -->
            @if (session('success'))
            <div class="bg-green-600 text-green-100 p-4 rounded-xl shadow-lg">
                <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
            </div>
            @endif

            @if ($errors->any())
            <div class="bg-red-600 text-red-100 p-4 rounded-xl shadow-lg">
                <i class="fas fa-exclamation-circle mr-2"></i>Terdapat ralat:
                <ul class="list-disc list-inside mt-2">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <!-- Section: Logbook Upload Form -->
            <div class="bg-gray-800 rounded-2xl p-8 shadow-md">
                <h3 class="text-lg font-semibold text-gray-200 mb-6">Muat Naik Logbook Baru</h3>
                <form id="logbookUploadForm" action="{{ route('logbook.upload.post') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    <div>
                        <label for="logbook" class="block text-gray-200 font-medium mb-2">Pilih Fail Logbook (PDF):</label>
                        <input type="file" name="logbook" id="logbook" accept=".pdf,.doc,.docx" required class="block w-full bg-gray-700 text-gray-300 border border-gray-600 rounded-lg p-3 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    </div>
                    <button type="submit" class="w-full flex items-center justify-center bg-indigo-600 text-white py-3 rounded-lg shadow-md hover:bg-indigo-500 transition duration-200 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        <i class="fas fa-upload mr-2"></i>Muat Naik Logbook
                    </button>
                </form>
            </div>

            <!-- Section: Display Current Logbook -->
            <div class="bg-gray-800 rounded-2xl p-8 shadow-md">
                @if (Auth::user()->logbook)
                <h3 class="text-lg font-semibold text-gray-200 mb-6">Logbook Terkini Anda</h3>
                @if (pathinfo(Auth::user()->logbook, PATHINFO_EXTENSION) == 'pdf')
                <iframe src="{{ asset('storage/' . Auth::user()->logbook) }}" class="w-full h-[500px] rounded-lg shadow-md" frameborder="0"></iframe>
                <div class="text-center mt-4">
                    <a href="{{ asset('storage/' . Auth::user()->logbook) }}" target="_blank" class="inline-flex items-center bg-blue-600 text-white py-3 px-8 rounded-lg shadow-md hover:bg-blue-500 transition duration-200">
                        <i class="fas fa-download mr-2"></i>Muat Turun PDF Logbook
                    </a>
                </div>
                @else
                <div id="wordEditorContainer" class="h-[500px] border border-gray-600 rounded-lg overflow-auto bg-gray-800">
                    <div id="wordEditor" contenteditable="true" class="p-4 text-gray-200 bg-gray-800 h-full overflow-y-auto">
                        <!-- Placeholder for Word document editor -->
                    </div>
                </div>
                <div class="mt-6 space-y-4">
                    <a href="{{ asset('storage/' . Auth::user()->logbook) }}" target="_blank" class="block text-center text-blue-400 underline">
                        Muat Turun Fail Logbook
                    </a>
                </div>
                @endif
                @else
                <div class="text-center">
                    <p class="text-gray-400">Tiada logbook dimuat naik. Sila muat naik fail logbook untuk menggunakannya.</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>