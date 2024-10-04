<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function create(Post $post)
    {
        // Przekazanie postu do widoku dodawania komentarza
        return view('comments.create', compact('post'));
    }

    public function store(Request $request, Post $post)
{
    // Walidacja formularza
    $request->validate([
        'comment' => 'required|string|max:255',
    ]);

    // Tworzenie komentarza
    Comment::create([
        'post_id' => $post->id, // Przypisanie komentarza do posta
        'user_id' => Auth::id(), // Auth::id() tylko dla zalogowanego użytkownika
        'comment' => $request->comment,
    ]);

    // Przekierowanie z powrotem do posta
    return redirect()->route('posts.show', $post->id);
}
public function destroy($id)
{
    $comment = Comment::findOrFail($id);

    // Sprawdzenie uprawnień
    if (Auth::id() !== $comment->user_id && Auth::id() !== $comment->post->user_id) {
        return redirect()->back()->with('error', 'You are not authorized to delete this comment.');
    }

    $comment->delete();

    return redirect()->route('posts.show', $comment->post_id)->with('success', 'Comment deleted successfully.');
}

// CommentController.php

public function editOrDelete($id)
{
    $comment = Comment::findOrFail($id);

    // Sprawdzenie uprawnień (tylko właściciel komentarza lub posta)
    if (Auth::id() !== $comment->user_id && Auth::id() !== $comment->post->user_id) {
        return redirect()->back()->with('error', 'You are not authorized to edit or delete this comment.');
    }

    return view('comments.editOrDelete', compact('comment'));
}
public function update(Request $request, $id)
{
    $comment = Comment::findOrFail($id);

    // Sprawdzenie uprawnień
    if (Auth::id() !== $comment->user_id && Auth::id() !== $comment->post->user_id) {
        return redirect()->back()->with('error', 'You are not authorized to update this comment.');
    }

    // Walidacja
    $request->validate([
        'comment' => 'required|string|max:255',
    ]);

    // Aktualizacja komentarza
    $comment->update([
        'comment' => $request->comment,
    ]);

    return redirect()->route('posts.show', $comment->post_id)->with('success', 'Comment updated successfully.');
}


}
