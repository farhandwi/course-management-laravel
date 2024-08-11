<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        return [
            'username' => $this->faker->userName,
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'email' => $this->faker->unique()->safeEmail,
            'password' => Hash::make('password'), // Default password
            'role' => 'user', // Default role is user
        ];
    }

    public function admin()
    {
        return $this->state([
            'role' => 'admin',
        ]);
    }

    public function user()
    {
        return $this->state([
            'role' => 'user',
        ]);
    }
}
