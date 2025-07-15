<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use Carbon\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Daftar mata kuliah Semester 4 yang realistis
        $courses = [
            'Visualisasi Data',
            'Pemrograman Web Lanjut',
            'Rekayasa Perangkat Lunak',
            'Basis Data Lanjut',
            'Kecerdasan Buatan',
            'Interaksi Manusia & Komputer',
            'Jaringan Komputer Lanjut'
        ];
        $categories = ['Tugas', 'Kuis', 'Projek', 'Studi Kasus'];
        $priorities = ['low', 'medium', 'high'];
        $statuses = ['todo', 'in_progress']; // Factory tidak membuat data 'completed'

        return [
            'user_id' => User::factory(), // Secara default, buat user baru
            'title' => $this->faker->randomElement(['Analisis', 'Laporan', 'Implementasi', 'Desain']) . ' ' . $this->faker->words(2, true),
            'description' => $this->faker->paragraph(2),
            'course' => $this->faker->randomElement($courses),
            'category' => $this->faker->randomElement($categories),
            'deadline' => Carbon::now()->addDays($this->faker->numberBetween(10, 90)),
            'priority' => $this->faker->randomElement($priorities),
            'status' => $this->faker->randomElement($statuses),
        ];
    }
}
