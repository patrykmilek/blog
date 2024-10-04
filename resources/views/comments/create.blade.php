@extends('layouts.app')

@section('content')
    <!-- Nagłówek z opcjami -->
    <header class="bg-gray-200 dark:bg-gray-800 py-4">
        <div class="max-w-6xl mx-auto px-6 lg:px-8 flex justify-between items-center">
            <div>
                <a href="{{ url('/') }}" class="text-lg font-bold text-gray-900 dark:text-white">My App</a>
            </div>
            <nav class="space-x-4">
                @auth
                    <a href="{{ route('posts.index') }}" class="text-gray-900 dark:text-white hover:underline">All Posts</a>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-gray-900 dark:text-white hover:underline">
                            Logout
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-gray-900 dark:text-white hover:underline">Login</a>
                    <a href="{{ route('register') }}" class="text-gray-900 dark:text-white hover:underline">Register</a>
                @endauth
            </nav>
        </div>
    </header>

    <!-- Formularz do dodawania komentarza -->
    <div class="relative flex items-center justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">
        <div class="max-w-4xl mx-auto p-6 bg-white dark:bg-gray-800 shadow-md rounded-lg">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-6 text-center">Add a Comment</h1>

            <form action="{{ route('comments.store', $post->id) }}" method="POST">
                @csrf

                <!-- Pole komentarza -->
                <div class="mb-4">
                    <label for="comment" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Comment</label>
                    <textarea name="comment" id="comment" rows="4" class="mt-1 block w-full p-2 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-900 dark:text-white" required>{{ old('comment') }}</textarea>
                    @error('comment')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Przyciski akcji -->
                <div class="flex justify-end">
                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-lg shadow">
                        Add Comment
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
