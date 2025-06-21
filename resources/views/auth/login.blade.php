<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.shared.title-meta', ['title' => "Login"])
    @include('layouts.shared.head-css')

    <!-- Alpine.js for toggle password -->
    <script src="//unpkg.com/alpinejs" defer></script>
</head>

<body class="bg-white">

<div class="min-h-screen w-screen flex justify-center items-center px-4">
    <div class="2xl:w-1/4 lg:w-1/3 md:w-1/2 w-full">
        <div class="bg-white border border-gray-200 rounded-lg shadow-md overflow-hidden">
            <div class="p-6">

                <!-- Logo -->
                <div class="mb-6 text-center">
                    <img class="h-10 mx-auto" src="{{ asset('images/logo-dark.png') }}" alt="STH Logo">
                </div>

                <!-- Heading -->
                <h2 class="text-xl font-bold text-center text-gray-800 mb-1">Selamat Datang</h2>
                <p class="text-sm text-center text-gray-500 mb-6">Silakan login untuk mengakses Billing STH Network.</p>

                <!-- Form -->
                <form method="POST" action="{{ route('login') }}" class="space-y-4">
                    @csrf

                    <!-- Email -->
                    <div>
                        <label for="LoggingEmailAddress" class="block text-sm font-medium text-gray-700 mb-1">
                            Email
                        </label>
                        <input id="LoggingEmailAddress" name="email" type="email"
                               class="w-full px-4 py-2 border border-gray-300 rounded-md bg-white text-black placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#ff8000] focus:border-[#ff8000]"
                               placeholder="Masukkan email" required>
                    </div>

                    <!-- Password with toggle -->
                    <div x-data="{ show: false }">
                        <label for="loggingPassword" class="block text-sm font-medium text-gray-700 mb-1">
                            Password
                        </label>
                        <div class="relative">
                            <input :type="show ? 'text' : 'password'" name="password" id="loggingPassword"
                                   class="w-full px-4 py-2 pr-10 border border-gray-300 rounded-md bg-white text-black placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#ff8000] focus:border-[#ff8000]"
                                   placeholder="Masukkan password" required>

                            <button type="button" @click="show = !show"
                                    class="absolute inset-y-0 right-0 flex items-center px-3 text-gray-500 focus:outline-none">
                                <!-- Eye icon -->
                                <svg x-show="!show" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                     viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                                <!-- Eye-slash icon -->
                                <svg x-show="show" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                     viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M13.875 18.825A10.05 10.05 0 0112 19c-4.477 0-8.268-2.943-9.542-7a9.964 9.964 0 012.276-4.106M4.145 4.145L19.855 19.855"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Remember + Forgot -->
                    <div class="flex items-center justify-between text-sm">
                        <label class="flex items-center gap-2">
                            <input type="checkbox" name="remember" class="form-checkbox text-[#ff8000]">
                            <span class="text-gray-700">Ingat saya</span>
                        </label>
                        <a href="{{ route('second', ['auth', 'recoverpw']) }}"
                           class="text-[#ff8000] hover:underline hover:text-[#e67300]">Lupa Password?</a>
                    </div>

                    <!-- Button -->
                    <button type="submit"
                            class="w-full bg-[#ff8000] text-white font-semibold py-2 rounded-md shadow hover:opacity-90 transition">
                        Masuk
                    </button>
                </form>

                <!-- Footer -->
                <p class="text-xs text-gray-400 text-center mt-6">© 2025 STH Network. All rights reserved.</p>
            </div>
        </div>
    </div>
</div>

</body>
</html>

