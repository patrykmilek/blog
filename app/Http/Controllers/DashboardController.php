<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->take(6)->get();

        // Przekazujemy posty do widoku 'dashboard'
        return view('dashboard', compact('posts'));
    }
}

