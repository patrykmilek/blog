<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased bg-gray-100 dark:bg-gray-900">
        <!-- Nagłówek z opcjami -->
        <header class="bg-gray-200 dark:bg-gray-800 py-4">
            <div class="max-w-6xl mx-auto px-6 lg:px-8 flex justify-between items-center">
                <div>
                    <a href="{{ url('/') }}" class="text-lg font-bold text-gray-900 dark:text-white">My App</a>
                </div>
                <nav class="space-x-4">
                    <!-- Zostawiamy tylko opcje Login, Register, i Post -->
                    @auth
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="text-gray-900 dark:text-white hover:underline">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-900 dark:text-white hover:underline">Login</a>
                        <a href="{{ route('register') }}" class="text-gray-900 dark:text-white hover:underline">Register</a>
                    @endauth
                    <a href="{{ route('posts.index') }}" class="text-gray-900 dark:text-white hover:underline">Post</a>
                </nav>
            </div>
        </header>

        <!-- Treść na środku strony -->
        <div class="relative flex items-center justify-center min-h-screen">
            <div class="text-center">
                <h1 class="text-4xl font-bold text-gray-900 dark:text-white">
                    Welcome to my recruitment page!
                </h1>
            </div>
        </div>
    </body>
</html>
