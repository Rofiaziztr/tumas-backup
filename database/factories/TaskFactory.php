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
        // Daftar data yang mungkin untuk dipilih secara acak
        $courses = ['IMK', 'PWF', 'RPL', 'Basis Data', 'Jaringan Komputer', 'AI'];
        $categories = ['Tugas', 'Kuis', 'UTS', 'UAS', 'Projek', 'Lainnya'];
        $priorities = ['low', 'medium', 'high'];
        $statuses = ['todo', 'in_progress']; // Kita tidak ingin factory membuat data 'completed' secara acak

        return [
            'user_id' => User::factory(), // Secara default, buat user baru atau bisa di-override
            'title' => 'Tugas ' . $this->faker->bs(),
            'description' => $this->faker->sentence(15),
            'course' => $this->faker->randomElement($courses),
            'category' => $this->faker->randomElement($categories),
            'deadline' => Carbon::now()->addDays($this->faker->numberBetween(5, 60)),
            'priority' => $this->faker->randomElement($priorities),
            'status' => $this->faker->randomElement($statuses),
        ];
    }
}
