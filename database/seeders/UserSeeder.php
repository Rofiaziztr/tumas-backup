<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Hapus user lama untuk menghindari duplikasi
        User::query()->delete();

        User::create([
            'name' => 'Evelyn Chevalier',
            'email' => 'evelyn@example.com',
            'password' => Hash::make('password'),
            'reminder_days_before' => 3, // Default pengingat 3 hari
        ]);

        User::create([
            'name' => 'Rofi (Admin)',
            'email' => 'rofi@example.com',
            'password' => Hash::make('password'),
            'reminder_days_before' => 7, // User ini ingin diingatkan 7 hari sebelumnya
        ]);
    }
}
