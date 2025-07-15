<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Task;
use App\Models\User;
use Carbon\Carbon;

class TaskSeeder extends Seeder
{
    public function run(): void
    {
        Task::query()->delete();

        // Ambil SEMUA user yang ada di database
        $users = User::all();

        $courses = [
            'Visualisasi Data',
            'Pemrograman Web Lanjut',
            'Rekayasa Perangkat Lunak',
            'Basis Data Lanjut',
            'Kecerdasan Buatan',
            'Interaksi Manusia & Komputer',
            'Jaringan Komputer Lanjut',
            'Metodologi Penelitian'
        ];

        $semesterStart = Carbon::create(2025, 2, 10);
        $semesterEnd = Carbon::create(2025, 7, 25);
        $today = Carbon::now();

        // Untuk setiap user, generate tugas satu semester
        foreach ($users as $user) {
            $this->generateSemesterTasksForUser($user, $courses, $semesterStart, $semesterEnd, $today);
        }
    }

    private function generateSemesterTasksForUser(User $user, array $courses, Carbon $semesterStart, Carbon $semesterEnd, Carbon $today): void
    {
        for ($date = $semesterStart->copy(); $date->lessThanOrEqualTo($semesterEnd); $date->addWeek()) {
            foreach ($courses as $course) {
                if (rand(1, 100) <= 60) {
                    $taskTypes = ['Tugas Mingguan', 'Laporan Praktikum', 'Studi Kasus', 'Presentasi Kelompok'];
                    $categoryTypes = ['Tugas', 'Laporan', 'Studi Kasus', 'Projek'];
                    $randomIndex = array_rand($taskTypes);
                    $taskTitle = $taskTypes[$randomIndex] . ' - ' . $course;
                    $taskCategory = $categoryTypes[$randomIndex];
                    $deadline = $date->copy()->addDays(rand(7, 10));

                    if ($deadline->lessThan($today)) {
                        $status = (rand(1, 100) <= 90) ? 'completed' : 'in_progress';
                    } elseif ($deadline->diffInDays($today) <= $user->reminder_days_before) {
                        $status = 'in_progress';
                    } else {
                        $status = 'todo';
                    }

                    $priorities = ['low', 'medium', 'high'];
                    $priority = $priorities[array_rand($priorities)];

                    Task::create([
                        'user_id' => $user->id,
                        'title' => $taskTitle . ' (Minggu ke-' . $date->weekOfYear . ')',
                        'description' => 'Deskripsi untuk ' . $taskTitle,
                        'course' => $course,
                        'category' => $taskCategory,
                        'deadline' => $deadline,
                        'priority' => $priority,
                        'status' => $status,
                        'created_at' => $date,
                        'updated_at' => $date,
                    ]);
                }
            }
        }
    }
}
