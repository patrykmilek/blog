<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Comment;

class CommentSeeder extends Seeder
{
    public function run()
    {
        // Dodaj przykładowe komentarze przy użyciu fabryki
        Comment::factory(10)->create();
    }
}
