<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Buat 1 user dengan role 'user'
        User::factory()->user()->create([
            'username' => 'user',
            'email' => 'user@example.com',
        ]);

        // Buat 10 user dengan role 'user'
        User::factory()->count(10)->create();

        // Buat 1 user dengan role 'admin'
        User::factory()->admin()->create([
            'username' => 'adminuser',
            'email' => 'admin@example.com',
        ]);
    }
}
