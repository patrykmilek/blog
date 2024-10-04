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
                    <a href="{{ route('posts.create') }}" class="text-gray-900 dark:text-white hover:underline">Post</a>
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

    <!-- Lista postów -->
    <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="text-center my-6">
                <h1 class="text-4xl font-bold text-gray-900 dark:text-white">Blog Posts</h1>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @forelse ($posts as $post)
                    <div class="p-6 bg-white dark:bg-gray-800 shadow-lg rounded-lg">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white">{{ $post->title }}</h3>
                        <p class="text-gray-600 dark:text-gray-400 mt-2">{{ \Illuminate\Support\Str::limit($post->content, 100) }}</p>
                        
                        <!-- Data utworzenia i właściciel posta -->
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">
                            Created on: {{ $post->created_at->format('d.m.Y H:i') }} by {{ $post->user->name }}
                        </p>

                        <!-- Data edycji posta (jeśli istnieje) -->
                        @if ($post->updated_at && $post->updated_at != $post->created_at)
                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">
                                Edited on: {{ $post->updated_at->format('d.m.Y H:i') }}
                            </p>
                        @endif

                        <a href="{{ route('posts.show', $post->id) }}" class="text-blue-500 hover:underline mt-4 block">Read more</a>

                        @can('update', $post)
                            <a href="{{ route('posts.edit', $post->id) }}" class="text-yellow-500 hover:underline mt-4 block">Edit post</a>
                        @endcan

                        @can('delete', $post)
                            <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="mt-2">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:underline">Delete post</button>
                            </form>
                        @endcan
                    </div>
                @empty
                    <div class="flex justify-center items-center min-h-screen">
                        <p class="text-gray-900 dark:text-white text-center">No posts</p>
                    </div>
                @endforelse
            </div>

            <!-- Paginacja -->
            <div class="mt-6">
                {{ $posts->links() }}
            </div>
        </div>
    </div>
@endsection
