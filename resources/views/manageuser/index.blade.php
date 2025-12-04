<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('User Management') }}
            </h2>
            <!-- Search bar -->
        </div>
    </x-slot>

    <div class="py-12 bg-gray-100 dark:bg-gray-900">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex gap-6">
            <!-- User List (Left Sidebar) -->
            <div class="w-1/3 bg-white dark:bg-gray-800 rounded-lg shadow-lg p-4 overflow-y-auto h-[75vh]">
                <h3 class="text-lg font-bold text-gray-800 dark:text-gray-100">Registered Users</h3>

                <!-- Filter Form -->
                <form action="{{ route('users.index') }}" method="GET" class="mt-4 mb-4">
                    <label for="roleFilter" class="block text-gray-700 dark:text-gray-200 mb-2">Filter by Role:</label>
                    <select id="roleFilter" name="role" class="form-select rounded-full border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-500" onchange="this.form.submit()">
                        <option value="">All Users</option>
                        <option value="1" {{ request('role') == '1' ? 'selected' : '' }}>Students</option>
                        <option value="2" {{ request('role') == '2' ? 'selected' : '' }}>Admins</option>
                        <option value="3" {{ request('role') == '3' ? 'selected' : '' }}>Alumni</option>
                    </select>
                </form>

                <div class="mt-4">
                    @if($users->isEmpty())
                    <p class="text-gray-600 dark:text-gray-400">No users available.</p>
                    @else
                    @foreach($users as $user)
                    <a href="{{ route('users.show', $user->id) }}?role={{ request('role') }}" class="block border-b border-gray-200 dark:border-gray-700 mb-2 pb-2 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg p-2 transition">
                        <h2 class="font-semibold text-gray-800 dark:text-gray-100">{{ $user->name }}</h2>
                        <p class="text-sm text-gray-600 dark:text-gray-400">{{ $user->email }}</p>
                    </a>
                    @endforeach
                    @endif
                </div>
            </div>

            <!-- User Details (Right Side) -->
            <div class="w-2/3 p-6 bg-white dark:bg-gray-800 rounded-lg shadow-md">
                <h1 class="text-xl font-semibold text-gray-800 dark:text-gray-200">User Details</h1>
                <div class="mt-6 text-gray-800 dark:text-gray-200">
                    @if(isset($selectedUser))
                    <div class="p-6 bg-gradient-to-r from-blue-50 to-white dark:from-gray-700 dark:to-gray-800 rounded-lg shadow-md">
                        <div class="flex items-center gap-4 mb-4">
                            <div class="w-16 h-16 bg-blue-100 dark:bg-gray-700 rounded-full flex items-center justify-center">
                                <svg class="w-8 h-8 text-blue-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-4.41 0-8 1.79-8 4v2h16v-2c0-2.21-3.59-4-8-4z" />
                                </svg>
                            </div>
                            <div>
                                <h2 class="text-2xl font-bold">{{ $selectedUser->name }} - {{ \Carbon\Carbon::parse($selectedUser->end_date)->format('Ymd') }}</h2>
                                <span class="inline-block bg-blue-200 text-blue-800 dark:bg-gray-600 dark:text-gray-300 rounded-full px-3 py-1 text-xs">
                                    @if($selectedUser->type == 1)
                                    Student
                                    @elseif($selectedUser->type == 2)
                                    Admin
                                    @elseif($selectedUser->type == 3)
                                    Alumni
                                    @else
                                    Unknown
                                    @endif
                                </span>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div class="flex items-center gap-2">
                                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 21v-2a4 4 0 00-8 0v2m8-10a4 4 0 10-8 0 4 4 0 008 0z"></path>
                                </svg>
                                <span>Email: {{ $selectedUser->email }}</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6.62 10.79c.5-.5 1.28-.5 1.78 0l2.56 2.56c.5.5.5 1.28 0 1.78l-1.26 1.26c-2.18-1.14-4.5-3.36-5.64-5.54L4.43 8.46a1.26 1.26 0 0 1 .19-.18l1.26-1.26c.5-.5 1.28-.5 1.78 0l2.56 2.56zm10.94-1.52c-.51-.5-1.28-.5-1.78 0l-2.56 2.56c-.5.5-.5 1.28 0 1.78l1.26 1.26c2.18-1.14 4.5-3.36 5.64-5.54l-1.26-1.26a1.26 1.26 0 0 0-.19-.18zm-5.9 8.46c.38 0 .74-.2.96-.54l1.16-1.8c.1-.18.09-.4-.03-.58-.1-.18-.29-.27-.49-.27h-1.72a.83.83 0 0 0-.49.27c-.12.18-.13.4-.03.58l1.16 1.8c.22.34.58.54.96.54z" />
                                </svg>
                                <span>Phone: {{ $selectedUser->phone_number }}</span>
                            </div>
                            <!--<div class="flex items-center gap-2">
                                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21v-2a4 4 0 014-4h10a4 4 0 014 4v2"></path>
                                </svg>
                                <span>Address: {{ $selectedUser->location }}, {{ $selectedUser->city }}, {{ $selectedUser->state }}</span>
                            </div>-->
                            <div class="flex items-center gap-2">
                                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 18v-6a9 9 0 0118 0v6"></path>
                                </svg>
                                <span>Course: {{ $selectedUser->student_course }}</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m-3-3H9"></path>
                                </svg>
                                <span>Advisor: {{ $selectedUser->advisor }}</span>
                            </div>

                            <!--<div class="flex items-center gap-2">
                                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m-3-3H9"></path>
                                </svg>
                                <span>Semester: {{ $selectedUser->part }}</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m-3-3H9"></path>
                                </svg>
                                <span>Graduation Year: {{ $selectedUser->graduation_year }}</span>
                            </div>-->

                            <div class="mt-6 flex gap-4">
                                <a href="{{ route('student.show', $selectedUser->id) }}" class="inline-flex items-center bg-green-600 text-white py-2 px-4 rounded-full hover:bg-gray-500 transition duration-200">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 17l-1 4m4-4l1 4M6 6l12 12m0 0L6 6M9 9l1-1m5 5l1-1"></path>
                                    </svg>
                                    View
                                </a>
                                <a href="{{ route('users.edit', $selectedUser->id) }}" class="inline-flex items-center bg-blue-600 text-white py-2 px-4 rounded-full hover:bg-gray-500 transition duration-200">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 17l-1 4m4-4l1 4M6 6l12 12m0 0L6 6M9 9l1-1m5 5l1-1"></path>
                                    </svg>
                                    Edit
                                </a>
                                <form action="{{ route('users.destroy', $selectedUser->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center bg-red-600 text-white py-2 px-4 rounded-full hover:bg-red-500 transition duration-200">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                        @else
                        <p class="text-gray-600 dark:text-gray-400">Select a user from the list to view details.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
</x-app-layout>