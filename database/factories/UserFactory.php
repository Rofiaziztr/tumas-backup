<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected static ?string $password;

    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            // Gunakan password yang sama untuk semua user factory agar mudah diingat saat testing
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
            // Beri nilai acak untuk preferensi reminder
            'reminder_days_before' => fake()->numberBetween(1, 7),
        ];
    }

    public function unverified(): static
    {
        return $this->state(fn(array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
