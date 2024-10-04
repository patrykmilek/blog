<!-- comments/editOrDelete.blade.php -->

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
                        <button type="submit" class="text-gray-900 dark:text-white hover:underline">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-gray-900 dark:text-white hover:underline">Login</a>
                    <a href="{{ route('register') }}" class="text-gray-900 dark:text-white hover:underline">Register</a>
                @endauth
            </nav>
        </div>
    </header>

    <!-- Formularz do edytowania komentarza -->
    <div class="relative flex items-center justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">
        <div class="max-w-4xl mx-auto p-6 bg-white dark:bg-gray-800 shadow-md rounded-lg">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-6 text-center">Edit Comment</h1>

            <!-- Formularz edytowania komentarza -->
<div class="flex flex-col items-center justify-center">
    <form action="{{ route('comments.update', $comment->id) }}" method="POST" class="w-full max-w-lg">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="comment" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Comment</label>
            <textarea name="comment" id="comment" rows="4" class="mt-1 block w-full p-2 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-900 dark:text-white">{{ old('comment', $comment->comment) }}</textarea>
            @error('comment')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="flex justify-center">
            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-lg shadow">Update Comment</button>
        </div>
    </form>

    <!-- Formularz usunięcia komentarza -->
    <div class="mt-6">
        <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this comment?')" class="w-full max-w-lg">
            @csrf
            @method('DELETE')
            <div class="flex justify-center">
                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600">Delete Comment</button>
            </div>
        </form>
    </div>
</div>

