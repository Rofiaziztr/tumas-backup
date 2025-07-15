<?php

namespace App\Providers;

use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        // FIX: Mengirim data ke sidebar, bukan hanya navbar
        View::composer('partials.sidebar', function ($view) {
            if (Auth::check() && Schema::hasTable('tasks')) {
                $user = Auth::user();
                // FIX: Ambil preferensi user untuk perhitungan yang akurat
                $reminderDays = $user->reminder_days_before ?? 3;

                // Hitung jumlah tugas TERLAMBAT
                $overdueCount = Task::where('user_id', $user->id)
                    ->where('deadline', '<', now()) // Gunakan timezone aplikasi
                    ->where('status', '!=', 'completed')
                    ->count();

                // FIX: Hitung jumlah tugas MENDEKATI DEADLINE menggunakan preferensi user
                $nearingCount = Task::where('user_id', $user->id)
                    ->where('status', '!=', 'completed')
                    ->whereBetween('deadline', [now(), now()->addDays($reminderDays)])
                    ->count();

                $reminderCount = $overdueCount + $nearingCount;

                $view->with([
                    'globalReminderCount' => $reminderCount,
                ]);
            } else {
                // Pastikan variabel ada meski user tidak login untuk menghindari error
                $view->with('globalReminderCount', 0);
            }
        });
    }
}
