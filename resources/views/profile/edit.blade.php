<x-app-layout>
    <x-slot name="header">
        <h2 class="text-4xl font-extrabold text-gradient bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 leading-tight">
            {{ __('Profil Pengguna') }}
        </h2>
    </x-slot>

    <div class="py-12 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-10">
            <!-- Profile Overview Section -->
            <div class="p-8 bg-black bg-opacity-60 text-gray-200 rounded-xl shadow-lg hover:shadow-2xl transition duration-300 transform hover:scale-105">
                <div class="space-y-6">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <!-- Password Change Section -->
            <div class="p-8 bg-black bg-opacity-60 text-gray-200 rounded-xl shadow-lg hover:shadow-2xl transition duration-300 transform hover:scale-105">
                <div class="space-y-6">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            @if(auth()->user()->type === 2) <!-- Check if the user is an admin (role=2) -->
            <!-- Delete Account Section -->
            <div class="p-8 bg-black bg-opacity-60 text-gray-200 rounded-xl shadow-lg hover:shadow-2xl transition duration-300 transform hover:scale-105">
                <div class="space-y-6">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
            @endif

        </div>
    </div>
</x-app-layout>