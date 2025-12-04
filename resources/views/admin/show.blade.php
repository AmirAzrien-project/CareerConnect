<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-6xl text-gray-800 dark:text-gray-200 leading-tight text-center mb-8">
            {{ __('Paparan Data Pensyarah') }}
        </h2>
    </x-slot>

    <div class="py-16">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-2xl p-10 transform transition duration-500 ease-in-out hover:scale-105">

                <!-- Profile Section -->
                <div class="flex items-center justify-center mb-10 space-x-8">
                    <div class="space-y-4">
                        <h3 class="text-4xl font-semibold text-gray-800 dark:text-gray-100">{{ $admin->name }}</h3>
                        <p class="text-2xl text-indigo-600">{{ $admin->current_position }}</p>
                        <p class="text-lg text-gray-600 dark:text-gray-400">{{ $admin->faculty }}</p>
                    </div>
                </div>

                <!-- Profile Details Section -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-8 mb-12">
                    <div>
                        <p class="text-lg text-gray-600 dark:text-gray-400"><strong>Email:</strong> {{ $admin->email }}</p>
                        <p class="text-lg text-gray-600 dark:text-gray-400"><strong>No. Telefon:</strong> {{ $admin->phone_number }}</p>
                    </div>
                    <div>
                        <p class="text-lg text-gray-600 dark:text-gray-400"><strong>Alamat:</strong> {{ $admin->location }}, {{ $admin->city }}, {{ $admin->state }}</p>
                    </div>
                </div>

                <!-- Action Section -->
                <div class="mt-12 flex justify-between items-center">
                    <a href="{{ route('admin.index') }}" class="bg-gradient-to-r from-indigo-600 to-indigo-500 text-white px-10 py-5 rounded-2xl shadow-lg hover:bg-indigo-700 flex items-center space-x-5 transition duration-300 transform hover:scale-110">
                        <i class="fas fa-arrow-left text-xl"></i>
                        <span class="text-xl">Kembali</span>
                    </a>

                    <!-- Admin Actions -->
                    @if(Auth::user()->type == 2)
                    <div class="flex space-x-8">
                        <a href="{{ route('admin.edit', $admin->id) }}" class="bg-gradient-to-r from-yellow-500 to-yellow-400 text-white px-10 py-5 rounded-2xl shadow-lg hover:bg-yellow-600 flex items-center space-x-5 transition duration-300 transform hover:scale-110">
                            <i class="fas fa-edit text-xl"></i>
                            <span class="text-xl">Kemas Kini</span>
                        </a>

                        <!-- Delete Button with confirmation -->
                        <form action="{{ route('users.destroy', $admin->id) }}" method="POST" onsubmit="return confirm('Adakah anda pasti mahu memadam pengguna ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-gradient-to-r from-red-600 to-red-500 text-white px-10 py-5 rounded-2xl shadow-lg hover:bg-red-700 flex items-center space-x-5 transition duration-300 transform hover:scale-110">
                                <i class="fas fa-trash text-xl"></i>
                                <span class="text-xl">Padam</span>
                            </button>
                        </form>
                    </div>
                    @endif
                </div>

            </div>
        </div>
    </div>
</x-app-layout>