<x-guest-layout>
    <!-- Background Section with Image applied to the whole body -->
    <div class="bg-cover bg-center flex items-center justify-center overflow-hidden">

        <!-- Container for the content, adjusted for responsiveness with a black overlay for contrast -->
        <div class="w-full sm:max-w-lg lg:max-w-4xl px-6 py-8 bg-black bg-opacity-0 rounded-xl">

            <!-- Header Section with Title -->
            <div class="bg-white p-8 rounded-3xl shadow-xl">
                <div class="text-center">
                    <h1 class="text-5xl font-extrabold text-gray-800"><span class="text-blue-700">CareerConnect</span></h1>
                    <p class="mt-2 text-lg text-gray-600">Platform Latihan Industri UiTM</p>
                </div>
            </div>

            <!-- Form Container with White Background -->
            <div class="mt-8 bg-white p-8 rounded-lg shadow-xl">
                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <!-- Email Address -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Emel</label>
                        <input id="email"
                            class="mt-1 w-full border border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50"
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            required
                            autofocus
                            autocomplete="username"
                            placeholder="Masukkan emel anda">
                        @error('email')
                        <span class="text-sm text-red-500 mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">Katalaluan</label>
                        <input id="password"
                            class="mt-1 w-full border border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50"
                            type="password"
                            name="password"
                            required
                            autocomplete="current-password"
                            placeholder="Masukkan katalaluan anda">
                        @error('password')
                        <span class="text-sm text-red-500 mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input id="remember_me"
                                type="checkbox"
                                class="h-4 w-4 text-blue-600 focus:ring focus:ring-blue-500 border-gray-300 rounded"
                                name="remember">
                            <label for="remember_me" class="ml-2 text-sm text-gray-600">Remember Me</label>
                        </div>

                        @if (Route::has('password.request'))
                        <a class="text-sm text-blue-600 hover:text-blue-700 focus:outline-none focus:underline" href="{{ route('password.request') }}">
                            Lupa kata laluan?
                        </a>
                        @endif
                    </div>

                    <!-- Login Button -->
                    <button type="submit"
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-lg shadow-md transition duration-200 ease-in-out transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        Log Masuk <i class="fas fa-sign-in-alt ml-3"></i>
                    </button>
                </form><br>

                <!-- Login Button 
                @if (Route::has('register'))
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    {{ ('Dont have an account?') }}
                    <a href="{{ route('register') }}" class="text-blue-500 hover:underline">
                        {{ ('Register') }}
                    </a>
                </p>
                @endif
                -->

            </div>

        </div>
    </div>
</x-guest-layout>