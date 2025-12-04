<x-guest-layout>
    <div class="max-w-md mx-auto bg-white dark:bg-gray-800 shadow-md rounded-lg p-6 mt-10">
        <h1 class="text-xl font-bold text-gray-800 dark:text-gray-100 mb-4">
            {{ __('Welcome to Our Platform!') }}
        </h1>

        <p class="text-gray-600 dark:text-gray-400 text-sm mb-6">
            {{ __('Thank you for signing up! Before you can start using your account, please verify your email address by clicking the link we just sent to your email. If you didn\'t receive the email, don\'t worry! You can request another one below.') }}
        </p>

        @if (session('status') == 'verification-link-sent')
        <div class="mb-6 p-4 rounded-lg bg-green-100 text-green-700 dark:bg-green-800 dark:text-green-100">
            {{ __('A new verification link has been sent to the email address you provided during registration.') }}
        </div>
        @endif

        <div class="space-y-4">
            <form method="POST" action="{{ route('verification.send') }}" class="text-center">
                @csrf
                <x-primary-button class="w-full bg-indigo-600 hover:bg-indigo-700 text-white py-2 px-4 rounded">
                    {{ __('Resend Verification Email') }}
                </x-primary-button>
            </form>

            <form method="POST" action="{{ route('logout') }}" class="text-center">
                @csrf
                <button type="submit" class="w-full underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    {{ __('Log Out') }}
                </button>
            </form>
        </div>
    </div>

    <style>
        body {
            background: linear-gradient(to bottom, #f9f9f9, #e6e6e6);
        }

        @media (prefers-color-scheme: dark) {
            body {
                background: linear-gradient(to bottom, #1a202c, #2d3748);
            }
        }
    </style>
</x-guest-layout>