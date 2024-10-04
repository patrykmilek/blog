<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Sprawdź, czy użytkownik z tym e-mailem już istnieje
        if (!User::where('email', 'test@example.com')->exists()) {
            User::create([
                'name' => 'Test User',
                'email' => 'test@example.com',
                'password' => Hash::make('password'), // Dodaj hasło
            ]);
        } else {
            echo "Użytkownik z adresem test@example.com już istnieje.";
        }
    }
}
