<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-3xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Borang Maklum Balas - Borang Laporan Latihan Industri') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 space-y-12">

            <!-- Seksyen Penghantaran Borang -->
            <div class="bg-white dark:bg-gray-800 shadow-2xl rounded-3xl p-10 space-y-8">
                <div class="mb-6 flex justify-between items-center">
                    <h3 class="text-2xl font-semibold text-gray-800 dark:text-gray-100">
                        Muat Naik Dokumen Maklum Balas
                    </h3>
                    <button id="scrollToBottomBtn"
                        class="flex items-center bg-indigo-600 text-white py-3 px-5 rounded-lg hover:bg-indigo-500 transition duration-300 shadow-lg">
                        <svg class="w-6 h-6 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                </div>

                <!-- Instruction Section -->
                <div class="bg-indigo-100 dark:bg-indigo-600 text-gray-800 dark:text-gray-200 p-6 rounded-lg shadow-md">
                    <h4 class="text-lg font-semibold">Maklumat Penting Borang Maklum Balas</h4>
                    <ol class="list-decimal ml-6 space-y-2 text-sm">
                        <li>Isi borang maklum balas dengan lengkap.</li>
                        <li>Muat naik dokumen yang berkaitan dengan maklum balas anda.</li>
                        <li>Pastikan dokumen yang dimuat naik jelas dan dalam format yang diterima (PDF).</li>
                        <li>Klik "Hantar Borang" setelah selesai.</li>
                    </ol>
                </div>

                <!-- Mesej Kejayaan -->
                @if (session('success'))
                <div class="bg-green-100 border border-green-500 text-green-800 p-4 rounded-xl mb-6 shadow-lg">
                    {{ session('success') }}
                </div>
                @endif

                <!-- Borang Penghantaran -->
                <form action="{{ route('balas.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                    @csrf

                    <!-- ID Pelajar -->
                    <div>
                        <label for="user_id" class="block text-gray-700 dark:text-gray-300 font-medium mb-3">
                            No Pelajar
                        </label>
                        <x-text-input id="user_id" name="user_id" type="text" class="block w-full mt-1 p-4 rounded-2xl shadow-md border border-gray-300 dark:border-gray-600" value="{{ Auth::user()->user_id }}" required readonly />
                        <x-input-error :messages="$errors->get('user_id')" class="mt-2" />
                    </div>

                    <!-- Nama Penuh -->
                    <div>
                        <label for="name" class="block text-gray-700 dark:text-gray-300 font-medium mb-3">
                            Nama Penuh
                        </label>
                        <x-text-input id="name" name="name" type="text" class="block w-full mt-1 p-4 rounded-2xl shadow-md border border-gray-300 dark:border-gray-600" value="{{ Auth::user()->name }}" oninput="this.value = this.value.toUpperCase();" required readonly />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- Muat Naik BLI-03 -->
                    <div>
                        <label for="dokumen_balas" class="block text-gray-700 dark:text-gray-300 font-medium mb-3">
                            Borang BLI-03 (Borang Pengesahan Tempat Latihan Industri/Surat Tawaran)
                        </label>
                        <input type="file" name="dokumen_balas" id="dokumen_balas" accept=".pdf,.doc,.docx" required
                            class="w-full bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-2xl p-4 text-gray-800 dark:text-gray-200 focus:ring-2 focus:ring-indigo-500 focus:outline-none transition-all duration-300">
                    </div>

                    <!-- Muat Naik SLI-03/SLI-04 -->
                    <div>
                        <label for="dokumen2" class="block text-gray-700 dark:text-gray-300 font-medium mb-3">
                            Borang SLI-03 / SLI-04 (Borang Penerimaan/Penolakan Tempat Latihan Industri)
                        </label>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">
                            Sila hantar borang maklum balas SLI-03 atau SLI-04 ke tempat Latihan Industri yang berkaitan.
                        </p>
                        <input type="file" name="dokumen2" id="dokumen2" accept=".pdf,.doc,.docx" required
                            class="w-full bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-2xl p-4 text-gray-800 dark:text-gray-200 focus:ring-2 focus:ring-indigo-500 focus:outline-none transition-all duration-300">
                    </div>

                    <!-- Butang Hantar -->
                    <div class="flex justify-center">
                        <button type="submit" class="w-full flex items-center justify-center bg-indigo-600 text-white py-4 rounded-2xl hover:bg-indigo-500 transition duration-300 shadow-xl">
                            Hantar Borang
                        </button>
                    </div>
                </form>
            </div>

            <!-- Seksyen Permohonan Yang Telah Dihantar -->
            <div class="bg-white dark:bg-gray-800 shadow-2xl rounded-3xl p-10">
                <h3 class="text-2xl font-semibold text-gray-800 dark:text-gray-100 mb-8"> Borang Yang Telah Dihantar </h3>

                @if($balas->isEmpty())
                <p class="text-gray-500 dark:text-gray-400">Anda belum menghantar sebarang borang.</p>
                @else
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-gray-50 dark:bg-gray-700 rounded-2xl shadow-md text-left">
                        <thead class="bg-indigo-600 text-white">
                            <tr>
                                <th class="px-6 py-4 text-sm font-medium uppercase">No Pelajar</th>
                                <th class="px-6 py-4 text-sm font-medium uppercase">Nama</th>
                                <th class="px-6 py-4 text-sm font-medium uppercase">BLI-03</th>
                                <th class="px-6 py-4 text-sm font-medium uppercase">SLI-03/SLI-04</th>
                                <th class="px-6 py-4 text-sm font-medium uppercase">Tarikh</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-600">
                            @foreach ($balas as $item)
                            <tr class="text-gray-800 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-800 transition-all duration-200">
                                <td class="px-6 py-4">{{ $item->user_id }}</td>
                                <td class="px-6 py-4">{{ $item->name }}</td>
                                <td class="px-6 py-4">
                                    @if($item->dokumen_balas)
                                    <a href="{{ asset('storage/dokumen/' . $item->dokumen_balas) }}"
                                        class="text-indigo-500 underline hover:text-indigo-400" target="_blank">
                                        Lihat BLI-03
                                    </a>
                                    @else
                                    <span class="text-gray-500">Tiada Dokumen</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    @if($item->dokumen2)
                                    <a href="{{ asset('storage/dokumen/' . $item->dokumen2) }}"
                                        class="text-indigo-500 underline hover:text-indigo-400" target="_blank">
                                        Lihat SLI-03/SLI-04
                                    </a>
                                    @else
                                    <span class="text-gray-500">Tiada Dokumen</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">{{ \Carbon\Carbon::parse($item->date)->format('d/m/Y') }}</td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- JavaScript untuk Scroll Ke Bawah -->
    <script>
        document.getElementById('scrollToBottomBtn').addEventListener('click', function() {
            window.scrollTo({
                top: document.body.scrollHeight,
                behavior: 'smooth'
            });
        });
    </script>
</x-app-layout>