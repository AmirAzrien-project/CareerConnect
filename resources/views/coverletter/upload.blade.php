<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-5xl text-indigo-400 leading-tight">
            {{ __('Paparan Cover Letter') }}
        </h2>
    </x-slot>

    <div class="py-12 min-h-screen">
        <div class="max-w-5xl mx-auto bg-gray-800 rounded-3xl shadow-3xl p-10 sm:p-12 text-gray-200">

            <!-- Section Header -->
            <div class="text-center mb-12">
                <h3 class="text-2xl font-semibold text-indigo-500 mb-4">Cover Letter</h3>
                <p class="text-gray-400 text-lg">Sila hubungi PA anda untuk maklumat lanjut tentang permohonan.</p>
            </div>

            <!-- Success and Error Messages -->
            @if (session('success'))
            <div class="bg-green-600 text-white p-4 rounded-lg mb-6 shadow-xl">
                <p>{{ session('success') }}</p>
            </div>
            @endif

            @if ($errors->any())
            <div class="bg-red-600 text-white p-4 rounded-lg mb-6 shadow-xl">
                <ul class="list-disc pl-6">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <!-- Cover Letter Display Section -->
            <div class="space-y-6">
                @if (Auth::user()->cover_letter)
                <div class="bg-gray-800 rounded-lg p-8 shadow-lg">
                    <h3 class="text-xl font-semibold text-gray-100 mb-4">Cover Letter Anda Sekarang</h3>
                    <iframe src="{{ asset('storage/cover_letters/' . Auth::user()->cover_letter) }}" class="w-full h-[700px] rounded-lg shadow-md" frameborder="0"></iframe>
                    <div class="text-center mt-6">
                        <a href="{{ asset('storage/cover_letters/' . Auth::user()->cover_letter) }}" class="inline-block bg-indigo-500 text-white py-3 px-8 rounded-lg shadow hover:bg-indigo-600 transition duration-200">
                            <i class="fas fa-download mr-2"></i> Muat Turun PDF Cover Letter
                        </a>
                    </div>
                </div>
                @else
                <div class="text-center bg-gray-800 rounded-lg p-12 shadow-md">
                    <p class="mt-2">Tiada borang dimuat naik. Untuk pertanyaan lanjut, hubungi PA anda atau rujuk kepada bahagian bantuan.</p>
                </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>