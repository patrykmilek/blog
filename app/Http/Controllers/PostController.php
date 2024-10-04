<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PostController extends Controller
{
    use AuthorizesRequests;

    /**
     * Wyświetlanie wszystkich postów (z paginacją)
     */
    public function index()
    {
        $posts = Post::latest()->paginate(10); // Paginacja 10 postów na stronę
        return view('posts.index', compact('posts'));
    }

    /**
     * Wyświetlanie pojedynczego posta
     */
    public function show($id)
    {
        $post = Post::with('comments')->findOrFail($id); // Pobiera post oraz jego komentarze
        return view('posts.show', compact('post'));
    }

    /**
     * Formularz tworzenia nowego posta (tylko dla zalogowanych użytkowników)
     */
    public function create()
    {
        $this->authorize('create', Post::class); // Autoryzacja dostępu do tworzenia postów
        return view('posts.create');
    }

    /**
     * Zapisanie nowego posta (tylko dla zalogowanych użytkowników)
     */
    public function store(Request $request)
    {
        $this->authorize('create', Post::class); // Autoryzacja przed zapisaniem posta

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'user_id' => Auth::id(), // Przypisanie posta do zalogowanego użytkownika
        ]);

        return redirect()->route('posts.index')->with('success', 'Post added successfully.');
    }

    /**
     * Formularz edycji posta (tylko dla właściciela posta)
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);

        // Autoryzacja: sprawdzenie, czy użytkownik jest właścicielem posta
        $this->authorize('update', $post);

        return view('posts.edit', compact('post'));
    }

    /**
     * Aktualizacja posta (tylko dla właściciela posta)
     */
    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);

        // Autoryzacja: sprawdzenie, czy użytkownik może zaktualizować posta
        $this->authorize('update', $post);

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $post->update($request->only(['title', 'content']));

        return redirect()->route('posts.index')->with('success', 'Post updated successfully.');
    }

    /**
     * Usunięcie posta (tylko dla właściciela posta)
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        // Autoryzacja: sprawdzenie, czy użytkownik może usunąć posta
        $this->authorize('delete', $post);

        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Post deleted successfully.');
    }
}
