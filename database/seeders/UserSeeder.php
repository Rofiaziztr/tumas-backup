<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Hapus user lama untuk menghindari duplikasi
        User::query()->delete();

        // Buat user baru dengan data yang lebih realistis
        User::create([
            'name' => 'Ruvi Well',
            'email' => 'ruviwell@gmail.com',
            'password' => Hash::make('password'),
            'reminder_days_before' => 3, // Pengingat default 3 hari
        ]);

        User::create([
            'name' => 'Andi Perkasa',
            'email' => 'manusiasuper2999@gmail.com',
            'password' => Hash::make('password'),
            'reminder_days_before' => 5, // User ini ingin diingatkan 5 hari sebelumnya
        ]);

        User::factory()->count(55)->create();
    }
}
