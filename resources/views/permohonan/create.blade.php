<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Permohonan Internship') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-100 dark:bg-gray-900">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
                <form action="{{ route('permohonan.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Company Name -->
                    <div class="mb-4">
                        <x-input-label for="company_name" :value="__('Company Name')" />
                        <x-text-input id="company_name" name="company_name" type="text" class="block w-full mt-1" value="{{ old('company_name') }}" required />
                        <x-input-error :messages="$errors->get('company_name')" class="mt-2" />
                    </div>

                    <!-- Company Location -->
                    <div class="mb-4">
                        <x-input-label for="company_location" :value="__('Company Location')" />
                        <x-text-input id="company_location" name="company_location" type="text" class="block w-full mt-1" value="{{ old('company_location') }}" required />
                        <x-input-error :messages="$errors->get('company_location')" class="mt-2" />
                    </div>

                    <!-- Company City -->
                    <div class="mb-4">
                        <x-input-label for="company_city" :value="__('Company City')" />
                        <x-text-input id="company_city" name="company_city" type="text" class="block w-full mt-1" value="{{ old('company_city') }}" />
                        <x-input-error :messages="$errors->get('company_city')" class="mt-2" />
                    </div>

                    <!-- Company State -->
                    <div class="mb-4">
                        <x-input-label for="company_state" :value="__('Company State')" />
                        <x-text-input id="company_state" name="company_state" type="text" class="block w-full mt-1" value="{{ old('company_state') }}" />
                        <x-input-error :messages="$errors->get('company_state')" class="mt-2" />
                    </div>

                    <div class="space-y-6 mb-10">
                        <h3 class="text-lg font-semibold text-gray-100">Upload Your Document (PDF)</h3>
                        <form id="documentUploadForm" action="{{ route('permohonan.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                            @csrf
                            <div class="mb-6">
                                <label for="accepted_document" class="block text-gray-200 font-medium mb-2">Choose File:</label>
                                <input type="file" name="accepted_document" id="accepted_document" accept=".pdf,.doc,.docx" required class="border border-gray-700 rounded-lg p-3 w-full bg-gray-800 text-gray-100 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                            </div>
                            <button type="submit" class="w-full bg-indigo-600 text-white py-2 rounded-lg hover:bg-indigo-500 transition duration-200 shadow-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                Submit Form
                            </button>
                        </form>
                    </div>

                    <div class="mt-4">
                        <!--<x-primary-button>{{ __('Submit Application') }}</x-primary-button>-->
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>