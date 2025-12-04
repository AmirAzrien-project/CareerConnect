<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-gray-900 antialiased bg-gray-100 dark:bg-gray-900">

    <div class="h-screen bg-cover bg-center flex items-center justify-center overflow-hidden" style="background-image: url('{{ asset('images/background.jpeg') }}');">

        <!-- Logo Section -->
        <div class="mb-8">
            <a href="/">
                <x-application-logo class="w-24 h-24 fill-current text-blue-600" />
            </a>
        </div>

        <!-- Main Container with padding -->
        <div class="w-full sm:max-w-[550px] lg:max-w-[550px] px-6 sm:px-8 py-6 shadow-xl rounded-xl" style="background-color: #111827; color: #ffffff;">

            <!-- Form Section -->
            <div>
                {{ $slot }}
            </div>

            <!-- Footer Section -->
            <div class="mt-6 text-center text-gray-600 dark:text-gray-400">
                <p class="text-sm">&copy; 2024 CareerConnect. Semua Hak Cipta Terpelihara.</p>
            </div>
        </div>

    </div>

</body>

</html>