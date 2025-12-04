<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Permohonan Penempatan') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Section: Heading -->
            <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-2xl p-10 mb-12">
                <h3 class="text-2xl font-semibold text-gray-900 dark:text-gray-100 leading-8 mb-4 bg-indigo-50 dark:bg-indigo-900 p-4 rounded-xl">
                    Borang Permohonan Latihan Industri
                </h3>
                <p class="text-lg text-gray-700 dark:text-gray-300 mb-8">
                    Sila lampirkan <span class="font-semibold text-indigo-600">Resume</span>,
                    <span class="font-semibold text-indigo-600">Borang SLI-01</span>, dan kedua-dua borang di bawah
                    <span class="font-semibold text-indigo-600">(SLI-02 & BLI-02)</span> sebelum melakukan permohonan.
                </p>
                <div class="mb-6 p-4 bg-gray-800 border border-gray-700 rounded-lg shadow-lg">
                    @foreach ($mohons as $mohon)
                    @if($mohon->user && $mohon->user->cover_letter)
                    <!-- If cover letter exists -->
                    <div class="mb-4">
                        <h3 class="text-xl font-bold text-gray-200 mb-2">
                            ⚠️ Penting: Borang SLI-01 Anda Telah Disediakan!
                        </h3>
                        <p class="text-lg text-gray-400 mb-3">
                            Borang SLI-01 (Cover Letter) dari pihak pengurusan UITM telah disediakan.
                            Sila semak dan muat turun dokumen ini untuk tindakan lanjut.
                        </p>
                        <a href="{{ asset('storage/cover_letters/' . $mohon->user->cover_letter) }}"
                            class="px-4 py-2 bg-green-700 text-gray-200 font-semibold rounded-md hover:bg-gray-600 hover:underline"
                            target="_blank">
                            👉 Lihat Borang SLI-01 Anda
                        </a>
                    </div>
                    @else
                    <!-- If cover letter does not exist -->
                    <div class="mb-4">
                        <h3 class="text-lg font-bold text-red-500 mb-2">
                            ⚠️ Penting: Borang SLI-01 Anda Belum Dimuat Naik
                        </h3>
                        <p class="text-gray-400">
                            Anda belum memuat naik resume atau dokumen permohonan yang diperlukan.
                            Sila lengkapkan proses ini segera.
                        </p>
                    </div>
                    @endif
                    @endforeach
                </div>
            </div>


            <!-- Loop through records -->
            @foreach ($mohon3Records as $index => $record)
            <div class="space-y-8">

                <!-- Flex Container for Dokumen 2 and Dokumen 3 -->
                <div class="flex space-x-8">

                    <!-- Dokumen 2 (SLI - 02) -->
                    <div class="flex-1 bg-white dark:bg-gray-800 rounded-3xl p-8 shadow-lg mb-8 hover:bg-indigo-50 dark:hover:bg-indigo-900 transition duration-300 ease-in-out">
                        <div class="flex justify-between items-center mb-6">
                            <h4 class="text-xl font-semibold text-gray-900 dark:text-gray-100">Borang SLI - 02</h4>
                            <button type="button" class="flex items-center text-indigo-600 hover:text-indigo-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M5 13l4 4L19 7"></path>
                                </svg>
                                Lihat Borang
                            </button>
                        </div>
                        <div class="flex items-center space-x-4 mb-6">
                            @if (in_array(asset('storage/dokumen/' . $record->dokumen2), $dokumen2_paths))
                            <div class="w-full h-[700px]">
                                <iframe src="{{ asset('storage/dokumen/' . $record->dokumen2) }}" width="100%" height="100%" frameborder="0" class="rounded-md shadow-lg"></iframe>
                            </div>
                            @else
                            <span class="text-red-500">Dokumen belum dimuat naik</span>
                            @endif
                        </div>
                    </div>

                    <!-- Dokumen 3 (BLI - 02) -->
                    <div class="flex-1 bg-white dark:bg-gray-800 rounded-3xl p-8 shadow-lg mb-8 hover:bg-indigo-50 dark:hover:bg-indigo-900 transition duration-300 ease-in-out">
                        <div class="flex justify-between items-center mb-6">
                            <h4 class="text-xl font-semibold text-gray-900 dark:text-gray-100">Borang BLI - 02</h4>
                            <button type="button" class="flex items-center text-indigo-600 hover:text-indigo-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M5 13l4 4L19 7"></path>
                                </svg>
                                Lihat Borang
                            </button>
                        </div>
                        <div class="flex items-center space-x-4 mb-6">
                            @if (in_array(asset('storage/dokumen/' . $record->dokumen3), $dokumen3_paths))
                            <div class="w-full h-[700px]">
                                <iframe src="{{ asset('storage/dokumen/' . $record->dokumen3) }}" width="100%" height="100%" frameborder="0" class="rounded-md shadow-lg"></iframe>
                            </div>
                            @else
                            <span class="text-red-500">Dokumen belum dimuat naik</span>
                            @endif
                        </div>
                    </div>

                </div> <!-- End of Flex Container -->

            </div>
            @endforeach

        </div>
    </div>
</x-app-layout>