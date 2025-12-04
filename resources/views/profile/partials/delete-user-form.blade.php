<section class="space-y-6 max-w-4xl mx-auto p-6 bg-gray-800 rounded-lg shadow-xl">
    <header class="text-center text-white">
        <h2 class="text-2xl font-semibold">
            {{ __('Padam Akaun') }}
        </h2>
        <p class="mt-2 text-sm text-gray-400">
            {{ __('Sekali akaun anda dipadam, semua data dan sumber yang berkaitan akan dipadamkan secara kekal.') }}<br>{{ __('Sila pastikan ini adalah keputusan akhir anda.') }}
        </p>
    </header>

    <div class="text-center mt-4">
        <x-danger-button
            x-data="{}"
            x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
            class="px-6 py-3 rounded-md text-white bg-red-600 hover:bg-red-700 transition duration-200">{{ __('Padam Akaun') }}</x-danger-button>
    </div>

    <!-- Modal for confirmation -->
    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="bg-gray-900 p-6 rounded-lg shadow-xl">
            @csrf
            @method('delete')

            <h2 class="text-lg font-semibold text-red-600">
                {{ __('Anda Pasti?') }}
            </h2>
            <p class="mt-2 text-sm text-gray-300">
                {{ __('Akaun ini akan dipadamkan secara kekal. Semua data dan sumber yang berkaitan akan hilang selamanya. Sila masukkan kata laluan untuk mengesahkan keputusan anda.') }}
            </p>

            <div class="mt-6">
                <x-input-label for="password" value="{{ __('Kata Laluan') }}" class="sr-only" />
                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-3/4 mx-auto px-4 py-3 rounded-md border border-gray-600 bg-gray-800 text-white focus:outline-none focus:ring-2 focus:ring-red-600"
                    placeholder="{{ __('Kata Laluan') }}" />
                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2 text-sm text-red-400" />
            </div>

            <div class="mt-6 flex justify-between">
                <x-secondary-button
                    x-on:click="$dispatch('close')"
                    class="px-4 py-2 rounded-md text-gray-300 bg-gray-600 hover:bg-gray-500 transition duration-150">
                    {{ __('Batal') }}
                </x-secondary-button>

                <x-danger-button class="px-4 py-2 rounded-md text-white bg-red-700 hover:bg-red-800 transition duration-200">
                    {{ __('Padam Akaun') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>