<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    public function run()
    {
        // Pobierz pierwszego użytkownika
        $user = User::first();

        // Upewnij się, że użytkownik istnieje przed tworzeniem postów
        if ($user) {
            Post::create([
                'user_id' => $user->id,
                'title' => 'Drugi post',
                'content' => 'To jest treść drugiego posta.',
            ]);

            Post::create([
                'user_id' => $user->id,
                'title' => 'Trzeci post',
                'content' => 'To jest treść trzeciego posta.',
            ]);
        } else {
            // Zaloguj błąd lub stwórz domyślnego użytkownika
            echo "Brak użytkowników do przypisania postów.";
        }
    }
}
