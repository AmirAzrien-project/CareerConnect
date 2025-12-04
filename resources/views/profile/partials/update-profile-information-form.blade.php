<section class="bg-gradient-to-r from-indigo-600 to-purple-800 py-12 rounded-3xl shadow-2xl">
    <header class="text-center mb-12">
        <h2 class="text-5xl font-extrabold text-white tracking-wider">
            {{ __('Maklumat Profil') }}
        </h2>
        <p class="mt-3 text-lg text-gray-300">
            {{ __("Kemaskini maklumat peribadi anda untuk memastikan semuanya tepat dan terkini.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-8 max-w-4xl mx-auto p-8 bg-gray-900 rounded-2xl shadow-lg">
        @csrf
        @method('patch')

        <div class="space-y-6">

            <!-- No Phone Field -->
            <div>
                <x-input-label for="phone_number" :value="__('No Telefon')" class="text-xl text-indigo-400 font-semibold" />
                <x-text-input id="phone_number" name="phone_number" type="text" class="mt-2 block w-full p-5 rounded-2xl bg-gray-800 text-white focus:ring-4 focus:ring-indigo-500" :value="old('phone_number', $user->phone_number)" required autofocus autocomplete="phone_number" />
                <x-input-error class="mt-2 text-sm text-red-500" :messages="$errors->get('phone_number')" />
            </div>

            <!-- Email Field -->
            <div>
                <x-input-label for="email" :value="__('Emel')" class="text-xl text-indigo-400 font-semibold" />
                <x-text-input id="email" name="email" type="email" class="mt-2 block w-full p-5 rounded-2xl bg-gray-800 text-white focus:ring-4 focus:ring-indigo-500" :value="old('email', $user->email)" required autocomplete="username" />
                <x-input-error class="mt-2 text-sm text-red-500" :messages="$errors->get('email')" />

                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-6 text-center">
                    <p class="text-sm text-gray-400">
                        {{ __('Alamat emel anda belum disahkan.') }}
                    </p>

                    <button form="send-verification" class="mt-4 bg-indigo-600 text-white py-3 px-8 rounded-full text-lg hover:bg-indigo-500 transition duration-300">
                        {{ __('Hantar semula emel pengesahan') }}
                    </button>

                    @if (session('status') === 'verification-link-sent')
                    <p class="mt-4 text-sm text-green-500">
                        {{ __('Pautan pengesahan baru telah dihantar ke emel anda.') }}
                    </p>
                    @endif
                </div>
                @endif
            </div>
        </div>

        <!-- Save Button Section -->
        <div class="flex justify-center items-center gap-6 mt-8">
            <x-primary-button class="py-3 px-10 rounded-full bg-gradient-to-r from-teal-500 to-cyan-500 hover:from-teal-400 hover:to-cyan-400 transition duration-300">
                {{ __('Simpan Perubahan') }}
            </x-primary-button>

            @if (session('status') === 'profile-updated')
            <p
                x-data="{ show: true }"
                x-show="show"
                x-transition
                x-init="setTimeout(() => show = false, 2000)"
                class="text-sm text-green-500 font-semibold">{{ __('Tersimpan.') }}</p>
            @endif
        </div>

        <!-- Instructions Section -->
        <div class="mt-8 text-center">
            <p class="text-sm text-gray-400">
                {{ __('Jika anda menghadapi masalah atau memerlukan bantuan lebih lanjut, sila hubungi Pensyarah.') }}
            </p>
        </div>
    </form>
</section>