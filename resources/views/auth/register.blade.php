<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" class="">
        @csrf
        <div class="bg-gray-50 dark:bg-gray-900 min-h-screen flex items-center justify-center p-6 rounded-lg">
            <div class="bg-white dark:bg-gray-800 shadow-xl rounded-lg w-full max-w-4xl">
                <!-- Section 1: Maklumat Peribadi -->
                <div class="p-8 border-b border-gray-200 dark:border-gray-700">
                    <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100 mb-4">
                        {{ __('Maklumat Peribadi') }}
                    </h2>

                    <!-- Nama Penuh -->
                    <div class="mb-4">
                        <x-input-label for="name" :value="__('Nama Penuh')" />
                        <x-text-input id="name" type="text" name="name" :value="old('name')" required
                            class="block w-full bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-100 rounded-lg py-3 px-4 focus:ring-2 focus:ring-indigo-500 shadow-sm"
                            oninput="this.value = this.value.toUpperCase();" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- Kad Pengenalan -->
                    <div class="mb-4">
                        <x-input-label for="no_ic" :value="__('Kad Pengenalan')" />
                        <x-text-input id="no_ic" type="text" name="no_ic" :value="old('no_ic')"
                            class="block w-full bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-100 rounded-lg py-3 px-4 focus:ring-2 focus:ring-indigo-500 shadow-sm" />
                        <x-input-error :messages="$errors->get('no_ic')" class="mt-2" />
                        <p class="text-sm text-gray-600 dark:text-gray-400">Tanpa '-'</p>
                    </div>

                    <!-- Nombor Telefon -->
                    <div class="mb-4">
                        <x-input-label for="phone_number" :value="__('Nombor Telefon')" />
                        <x-text-input id="phone_number" type="text" name="phone_number" :value="old('phone_number')"
                            class="block w-full bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-100 rounded-lg py-3 px-4 focus:ring-2 focus:ring-indigo-500 shadow-sm" />
                        <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
                    </div>

                    <!-- Alamat Rumah -->
                    <div class="mb-4">
                        <x-input-label for="location" :value="__('Taman')" />
                        <x-text-input id="location" type="text" name="location" :value="old('location')"
                            class="block w-full bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-100 rounded-lg py-3 px-4 focus:ring-2 focus:ring-indigo-500 shadow-sm" />
                        <x-input-error :messages="$errors->get('location')" class="mt-2" />
                    </div>

                    <!-- Bandar -->
                    <div class="mb-4">
                        <x-input-label for="city" :value="__('Bandar')" />
                        <x-text-input id="city" type="text" name="city" :value="old('city')"
                            class="block w-full bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-100 rounded-lg py-3 px-4 focus:ring-2 focus:ring-indigo-500 shadow-sm" />
                        <x-input-error :messages="$errors->get('city')" class="mt-2" />
                    </div>

                    <!-- Negeri -->
                    <div class="mb-4">
                        <x-input-label for="state" :value="__('Negeri')" />
                        <select id="state" name="state"
                            class="block w-full bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-100 rounded-lg py-3 px-4 focus:ring-2 focus:ring-indigo-500 shadow-sm">
                            <option value="" disabled selected>{{ __('Pilih Negeri') }}</option>
                            <option value="Johor" {{ old('state') == 'Johor' ? 'selected' : '' }}>Johor</option>
                            <option value="Kedah" {{ old('state') == 'Kedah' ? 'selected' : '' }}>Kedah</option>
                            <option value="Kelantan" {{ old('state') == 'Kelantan' ? 'selected' : '' }}>Kelantan</option>
                            <option value="Melaka" {{ old('state') == 'Melaka' ? 'selected' : '' }}>Melaka</option>
                            <option value="Negeri Sembilan" {{ old('state') == 'Negeri Sembilan' ? 'selected' : '' }}>Negeri Sembilan</option>
                            <option value="Pahang" {{ old('state') == 'Pahang' ? 'selected' : '' }}>Pahang</option>
                            <option value="Penang" {{ old('state') == 'Penang' ? 'selected' : '' }}>Penang</option>
                            <option value="Perak" {{ old('state') == 'Perak' ? 'selected' : '' }}>Perak</option>
                            <option value="Perlis" {{ old('state') == 'Perlis' ? 'selected' : '' }}>Perlis</option>
                            <option value="Selangor" {{ old('state') == 'Selangor' ? 'selected' : '' }}>Selangor</option>
                            <option value="Terengganu" {{ old('state') == 'Terengganu' ? 'selected' : '' }}>Terengganu</option>
                            <option value="Sabah" {{ old('state') == 'Sabah' ? 'selected' : '' }}>Sabah</option>
                            <option value="Sarawak" {{ old('state') == 'Sarawak' ? 'selected' : '' }}>Sarawak</option>
                            <option value="Wilayah Persekutuan Kuala Lumpur" {{ old('state') == 'Wilayah Persekutuan Kuala Lumpur' ? 'selected' : '' }}>Wilayah Persekutuan Kuala Lumpur</option>
                            <option value="Wilayah Persekutuan Labuan" {{ old('state') == 'Wilayah Persekutuan Labuan' ? 'selected' : '' }}>Wilayah Persekutuan Labuan</option>
                            <option value="Wilayah Persekutuan Putrajaya" {{ old('state') == 'Wilayah Persekutuan Putrajaya' ? 'selected' : '' }}>Wilayah Persekutuan Putrajaya</option>
                        </select>
                        <x-input-error :messages="$errors->get('state')" class="mt-2" />
                    </div>
                </div>

                <!-- Section 2: Maklumat Akaun -->
                <div class="p-8">
                    <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100 mb-4">
                        {{ __('Maklumat Akaun') }}
                    </h2>

                    <!-- Role -->
                    <div class="mb-4">
                        <x-input-label for="type" :value="__('Peranan')" />
                        <select id="type" name="type"
                            class="block w-full bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-100 rounded-lg py-3 px-4 focus:ring-2 focus:ring-indigo-500 shadow-sm">
                            <option value="1">Pelajar</option>
                            <option value="2">Pensyarah</option>
                            <option value="3">Penyelia</option>
                        </select>
                        <x-input-error :messages="$errors->get('type')" class="mt-2" />
                    </div>

                    <!-- Email -->
                    <div class="mb-4">
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" type="email" name="email" :value="old('email')" required
                            class="block w-full bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-100 rounded-lg py-3 px-4 focus:ring-2 focus:ring-indigo-500 shadow-sm" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div class="mb-4">
                        <x-input-label for="password" :value="__('Katalaluan')" />
                        <x-text-input id="password" type="password" name="password" required autocomplete="new-password"
                            class="block w-full bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-100 rounded-lg py-3 px-4 focus:ring-2 focus:ring-indigo-500 shadow-sm" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Confirm Password -->
                    <div class="mb-4">
                        <x-input-label for="password_confirmation" :value="__('Sahkan Katalaluan')" />
                        <x-text-input id="password_confirmation" type="password" name="password_confirmation"
                            class="block w-full bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-100 rounded-lg py-3 px-4 focus:ring-2 focus:ring-indigo-500 shadow-sm" />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="p-8 border-t border-gray-200 dark:border-gray-700">
                    <div class="flex justify-end">
                        <x-primary-button class="py-2 px-6">
                            {{ __('Daftar') }}
                        </x-primary-button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</x-guest-layout>