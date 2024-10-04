@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900 py-8">
        <div class="container mx-auto">
            <h1 class="text-3xl font-semibold text-center text-gray-800 dark:text-white mb-8">Dashboard</h1>

            <!-- Sekcja z przyciskami -->
            <div id="app">
                <dashboard-buttons></dashboard-buttons> <!-- Wstawiamy nasz komponent Vue -->
            </div>

            <!-- Ostatnio dodane posty -->
            <div class="mt-8">
                <h2 class="text-2xl font-semibold text-gray-800 dark:text-white mb-4">Ostatnio dodane posty</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach ($posts as $post)
                        <div class="p-4 bg-white dark:bg-gray-800 shadow rounded-lg">
                            <h3 class="text-xl font-semibold dark:text-white">{{ $post->title }}</h3>
                            <p class="text-gray-600 dark:text-gray-300 mt-2">{{ \Illuminate\Support\Str::limit($post->content, 100) }}</p>
                            <a href="{{ route('posts.show', $post->id) }}" class="text-blue-500 dark:text-blue-400 hover:underline mt-4 block">Czytaj więcej</a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
