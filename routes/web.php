<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('welcome');
});

// Grupa tras wymagająca autoryzacji
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Post routes
    Route::prefix('posts')->group(function () {
        Route::get('/', [PostController::class, 'index'])->name('posts.index');
        Route::get('/create', [PostController::class, 'create'])->name('posts.create');
        Route::post('/', [PostController::class, 'store'])->name('posts.store');
        Route::get('{id}', [PostController::class, 'show'])->name('posts.show');
        Route::get('{id}/edit', [PostController::class, 'edit'])->name('posts.edit');
        Route::put('{id}', [PostController::class, 'update'])->name('posts.update');

        // Usuń middleware checkrole z usuwania postów
        Route::delete('{id}', [PostController::class, 'destroy'])->name('posts.destroy');
    });

    // Comment routes
    Route::prefix('posts/{post}/comments')->group(function () {
        Route::get('/', [CommentController::class, 'create'])->name('comments.create');
        Route::post('/', [CommentController::class, 'store'])->name('comments.store');
    });

    Route::prefix('comments')->group(function () {
        Route::get('{id}', [CommentController::class, 'editOrDelete'])->name('comments.editOrDelete');
        Route::put('{id}', [CommentController::class, 'update'])->name('comments.update');
        
        // Usuń middleware checkrole z usuwania komentarzy
        Route::delete('{id}', [CommentController::class, 'destroy'])->name('comments.destroy');
    });

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Wymagaj auth.php na końcu
require __DIR__.'/auth.php';
