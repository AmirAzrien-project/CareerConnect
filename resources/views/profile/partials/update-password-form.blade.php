<section class="bg-gradient-to-r from-green-400 to-teal-500 py-12 rounded-3xl shadow-xl">
    <header class="text-center mb-12">
        <h2 class="text-5xl font-extrabold text-white tracking-wider">
            {{ __('Kemaskini Kata Laluan') }}
        </h2>
        <p class="mt-3 text-lg text-gray-200">
            {{ __('Pastikan akaun anda menggunakan kata laluan yang panjang dan rawak untuk keselamatan yang lebih baik.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="space-y-8 max-w-4xl mx-auto p-8 bg-gray-800 rounded-2xl shadow-lg">
        @csrf
        @method('put')

        <!-- Current Password Field -->
        <div>
            <x-input-label for="update_password_current_password" :value="__('Kata Laluan Semasa')" class="text-xl text-teal-400 font-semibold" />
            <x-text-input id="update_password_current_password" name="current_password" type="password" class="mt-2 block w-full p-5 rounded-2xl bg-gray-700 text-white focus:ring-4 focus:ring-teal-500" autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2 text-sm text-red-500" />
        </div>

        <!-- New Password Field -->
        <div>
            <x-input-label for="update_password_password" :value="__('Kata Laluan Baru')" class="text-xl text-teal-400 font-semibold" />
            <x-text-input id="update_password_password" name="password" type="password" class="mt-2 block w-full p-5 rounded-2xl bg-gray-700 text-white focus:ring-4 focus:ring-teal-500" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2 text-sm text-red-500" />
        </div>

        <!-- Password Confirmation Field -->
        <div>
            <x-input-label for="update_password_password_confirmation" :value="__('Sahkan Kata Laluan')" class="text-xl text-teal-400 font-semibold" />
            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="mt-2 block w-full p-5 rounded-2xl bg-gray-700 text-white focus:ring-4 focus:ring-teal-500" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2 text-sm text-red-500" />
        </div>

        <!-- Save Button Section -->
        <div class="flex justify-center items-center gap-6 mt-8">
            <x-primary-button class="py-3 px-10 rounded-full bg-gradient-to-r from-green-600 to-teal-500 hover:from-teal-400 hover:to-green-400 transition duration-300">
                {{ __('Simpan Perubahan') }}
            </x-primary-button>

            @if (session('status') === 'password-updated')
            <p
                x-data="{ show: true }"
                x-show="show"
                x-transition
                x-init="setTimeout(() => show = false, 2000)"
                class="text-sm text-green-500 font-semibold">{{ __('Kata Laluan Disimpan.') }}</p>
            @endif
        </div>

        <!-- Instructions Section -->
        <div class="mt-8 text-center">
            <p class="text-sm text-gray-400">
                {{ __('Pastikan kata laluan baru anda selamat, gunakan kombinasi huruf besar, huruf kecil, nombor, dan simbol.') }}
            </p>
        </div>
    </form>
</section>