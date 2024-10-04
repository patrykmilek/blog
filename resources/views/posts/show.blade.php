@extends('layouts.app')

@section('content')
    <!-- Nagłówek -->
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
                        <button type="submit" class="text-gray-900 dark:text-white hover:underline">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-gray-900 dark:text-white hover:underline">Login</a>
                    <a href="{{ route('register') }}" class="text-gray-900 dark:text-white hover:underline">Register</a>
                @endauth
            </nav>
        </div>
    </header>

    <!-- Sekcja posta -->
    <div class="relative flex items-center justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:pt-0">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 w-full">
            <!-- Treść posta rozciągnięta na szerokość -->
            <div class="bg-white dark:bg-gray-800 shadow-lg overflow-hidden sm:rounded-lg p-8 mb-8">
                <h1 class="text-5xl font-bold text-gray-900 dark:text-white mb-6">{{ $post->title }}</h1>
                <p class="text-xl text-gray-700 dark:text-gray-300">{{ $post->content }}</p>

                <!-- Przyciski edycji i usunięcia tylko dla właściciela posta -->
                @can('update', $post)
                    <div class="mt-6">
                        <a href="{{ route('posts.edit', $post->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded-md hover:bg-yellow-600">Edit post</a>
                    </div>
                @endcan

                @can('delete', $post)
                    <div class="mt-2">
                        <form action="{{ route('posts.destroy', $post->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this post?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600">Delete post</button>
                        </form>
                    </div>
                @endcan
            </div>

            <!-- Sekcja komentarzy -->
            <div class="bg-white dark:bg-gray-800 shadow-lg p-6 rounded-lg">
                <h2 class="text-3xl font-semibold text-gray-900 dark:text-white mb-6">Comments:</h2>

            @forelse($post->comments as $comment)
                <div class="border-b border-gray-300 dark:border-gray-700 pb-4 mb-4">
                    <p class="text-gray-600 dark:text-gray-400">{{ $comment->comment }}</p>
                        <p class="text-sm text-gray-500 dark:text-gray-500 mt-2">
                            Added by: <strong>{{ $comment->user->name }}</strong> 
                                on {{ $comment->created_at->format('d.m.Y') }} o {{ $comment->created_at->format('H:i') }}
                        </p>

                    <!-- Przycisk "Edit or Delete" (dla właściciela komentarza lub posta) -->
                    @if (Auth::id() === $comment->user_id || Auth::id() === $post->user_id)
                        <a href="{{ route('comments.editOrDelete', $comment->id) }}" class="text-yellow-500 hover:underline">Edit or Delete</a>
                    @endif
                </div>
            @empty
        <p class="text-gray-600 dark:text-gray-400">No comments.</p>
    @endforelse
</div>


            <!-- Przycisk dodaj komentarz -->
            @auth
                <div class="mt-6">
                    <a href="{{ route('comments.create', $post->id) }}" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Add comment</a>
                </div>
            @endauth
        </div>
    </div>
@endsection
