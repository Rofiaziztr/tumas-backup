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
        View::composer('partials.navbar', function ($view) {
            if (Auth::check() && Schema::hasTable('tasks')) {
                $user = Auth::user();

                // Ambil 5 notifikasi terbaru yang belum dibaca
                $notifications = $user->unreadNotifications()->take(5)->get();

                // Hitung jumlah reminder (terlambat + mendekati deadline)
                $overdueCount = Task::where('user_id', $user->id)
                    ->where('deadline', '<', now())
                    ->where('status', '!=', 'completed')
                    ->count();

                $nearingCount = Task::where('user_id', $user->id)
                    ->whereBetween('deadline', [now(), now()->addDays(3)])
                    ->where('status', '!=', 'completed')
                    ->count();

                $reminderCount = $overdueCount + $nearingCount;

                $view->with([
                    'globalNotifications' => $notifications,
                    'globalReminderCount' => $reminderCount,
                ]);
            }
        });
    }
}
