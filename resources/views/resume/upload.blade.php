<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-4xl text-gray-100 leading-tight">
            {{ __('Paparan Resume') }}
        </h2>
    </x-slot>

    <div class="py-12 min-h-screen">
        <div class="max-w-5xl mx-auto bg-gray-900 rounded-3xl shadow-2xl p-10 text-gray-200">

            <!-- Current Resume Section -->
            <div class="bg-gray-800 rounded-xl p-8 shadow-lg mb-10">
                <h4 class="text-2xl font-semibold text-indigo-300 mb-4">Resume Semasa Anda</h4>
                @if (Auth::user()->resume)
                <p class="text-gray-400 mb-4">Berikut adalah resume yang disimpan dalam profil anda. Anda boleh melihat, memuat turun, atau menggantikan dengan muat naik baru.</p>
                <div class="mt-4 bg-gray-700 rounded-lg p-4 shadow-inner">
                    <!-- Embed PDF with iframe -->
                    <iframe src="{{ asset('storage/' . Auth::user()->resume) }}" class="w-full h-[500px] rounded-lg shadow-md" frameborder="0">
                        Pelayar anda tidak menyokong PDF. Sila muat turun PDF untuk melihatnya:
                        <a href="{{ asset('storage/' . Auth::user()->resume) }}" class="text-indigo-400 hover:underline">Muat Turun PDF</a>
                    </iframe>
                </div>
                @else
                <p class="text-gray-300">Anda belum memuat naik resume. Gunakan bahagian muat naik di bawah untuk menambah resume anda.</p>
                @endif
            </div>

            <!-- File Upload Section -->
            <div class="bg-gray-800 rounded-xl p-8 mb-10 shadow-lg">

                <!-- Display success or error messages -->
                @if (session('success'))
                <div class="bg-green-500 text-green-100 p-3 rounded-lg mb-4 shadow-md">
                    <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
                </div>
                @endif

                @if ($errors->any())
                <div class="bg-red-500 text-red-100 p-3 rounded-lg mb-4 shadow-md">
                    <i class="fas fa-exclamation-triangle mr-2"></i>
                    <strong>Ralat:</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif


                <!-- Upload Form -->
                <form action="{{ route('resume.upload') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label for="resume" class="block text-gray-300 font-medium mb-2">Pilih Fail Resume (PDF):</label>
                        <input type="file" name="resume" id="resume" accept="application/pdf" required class="border border-gray-700 rounded-lg p-3 w-full bg-gray-800 text-gray-100 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                    </div>
                    <button type="submit" class="mt-4 w-full bg-indigo-600 text-white py-2 rounded-lg hover:bg-indigo-500 transition duration-200 shadow-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        <i class="fas fa-upload mr-2"></i> Muat Naik Resume
                    </button>
                </form>
            </div>

            <!-- Helpful Tips Section -->
            <div class="bg-gray-800 rounded-xl p-8 shadow-lg">
                <h4 class="text-2xl font-semibold text-indigo-300 mb-4">Tips Menyediakan Resume</h4>
                <ul class="list-disc pl-6 space-y-2 text-gray-300">
                    <li>Pastikan maklumat peribadi anda lengkap dan terkini.</li>
                    <li>Sertakan pengalaman kerja atau latihan yang relevan dengan jawatan yang dipohon.</li>
                    <li>Gunakan format yang bersih dan mudah dibaca.</li>
                    <li>Jangan lupa untuk menyebut kemahiran utama dan pencapaian anda!</li>
                </ul>
            </div>

        </div>
    </div>
</x-app-layout>