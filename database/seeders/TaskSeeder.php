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
        // Hapus tugas lama untuk memastikan data bersih setiap kali seeding
        Task::query()->delete();

        $evelyn = User::where('email', 'evelyn@example.com')->first();
        $rofi = User::where('email', 'rofi@example.com')->first();

        // =================================================================
        // SKENARIO TUGAS UNTUK EVELYN (Reminder 3 Hari)
        // =================================================================
        if ($evelyn) {
            // 1. Tugas yang sudah TERLAMBAT
            Task::factory()->create([
                'user_id' => $evelyn->id,
                'title' => 'Laporan Praktikum Jaringan Komputer',
                'course' => 'Jaringan Komputer',
                'category' => 'Tugas',
                'deadline' => Carbon::now()->subDays(5),
                'priority' => 'high',
                'status' => 'in_progress',
            ]);

            // 2. Tugas MENDEKATI DEADLINE (sesuai reminder 3 hari)
            Task::factory()->create([
                'user_id' => $evelyn->id,
                'title' => 'Presentasi Proyek Perangkat Lunak',
                'course' => 'RPL',
                'category' => 'Projek',
                'deadline' => Carbon::now()->addDays(2),
                'priority' => 'high',
                'status' => 'todo',
            ]);
            Task::factory()->create([
                'user_id' => $evelyn->id,
                'title' => 'Kuis Dadakan Interaksi Manusia Komputer',
                'course' => 'IMK',
                'category' => 'Kuis',
                'deadline' => Carbon::now()->addHours(12),
                'priority' => 'medium',
                'status' => 'todo',
            ]);

            // 3. Tugas yang sudah SELESAI (tidak akan muncul di reminder)
            Task::factory()->create([
                'user_id' => $evelyn->id,
                'title' => 'Mengerjakan Modul 1',
                'course' => 'Basis Data',
                'category' => 'Tugas',
                'deadline' => Carbon::now()->subDays(10),
                'priority' => 'low',
                'status' => 'completed',
            ]);

            // 4. Tugas Normal (untuk mengisi daftar utama & pagination)
            for ($i = 1; $i <= 15; $i++) {
                Task::factory()->create([
                    'user_id' => $evelyn->id,
                    'title' => "Tugas Normal Evelyn ke-$i",
                    'course' => ['PWF', 'IMK', 'RPL', 'Basis Data'][array_rand(['PWF', 'IMK', 'RPL', 'Basis Data'])],
                    'deadline' => Carbon::now()->addDays(rand(10, 30)),
                ]);
            }
        }

        // =================================================================
        // SKENARIO TUGAS UNTUK ROFI (Reminder 7 Hari)
        // =================================================================
        if ($rofi) {
            // 1. Tugas MENDEKATI DEADLINE (sesuai reminder 7 hari)
            Task::factory()->create([
                'user_id' => $rofi->id,
                'title' => 'Proposal Skripsi BAB 1-3',
                'course' => 'Metodologi Penelitian',
                'category' => 'Projek',
                'deadline' => Carbon::now()->addDays(6), // Masuk dalam jangkauan 7 hari
                'priority' => 'high',
                'status' => 'in_progress',
            ]);

            // 2. Tugas Normal (untuk mengisi daftar utama)
            Task::factory()->create([
                'user_id' => $rofi->id,
                'title' => 'Mencari Jurnal Internasional',
                'course' => 'Metodologi Penelitian',
                'deadline' => Carbon::now()->addDays(20),
                'priority' => 'medium',
                'status' => 'todo',
            ]);
        }
    }
}
