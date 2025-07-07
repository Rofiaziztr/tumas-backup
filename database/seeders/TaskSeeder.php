<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TaskSeeder extends Seeder
{
    public function run(): void
    {
        $priorities = ['low', 'medium', 'high'];
        $statuses = ['todo', 'in_progress', 'completed'];
        $categories = ['Tugas', 'Kuis', 'UTS', 'UAS', 'Projek', 'Lainnya'];

        $userIds = DB::table('users')->pluck('id');

        foreach (range(1, 50) as $i) {
            $isOverdue = rand(1, 10) <= 3;
            $deadline = $isOverdue
                ? Carbon::now()->subDays(rand(1, 5))
                : Carbon::now()->addDays(rand(1, 10));

            DB::table('tasks')->insert([
                'title' => "Tugas Dummy ke-$i",
                'description' => fake()->sentence(10),
                'course' => fake()->randomElement(['IMK', 'PWF', 'RPL']),
                'category' => fake()->randomElement($categories),
                'deadline' => $deadline,
                'priority' => fake()->randomElement($priorities),
                'status' => fake()->randomElement($statuses),
                'user_id' => $userIds->random(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
