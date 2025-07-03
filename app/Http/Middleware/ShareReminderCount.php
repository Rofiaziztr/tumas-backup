<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Symfony\Component\HttpFoundation\Response;

class ShareReminderCount
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        $reminderCount = 0;

        if (Auth::check()) {
            // Periksa apakah tabel tasks ada
            if (Schema::hasTable('tasks')) {
                $overdueCount = Task::where('user_id', Auth::id())
                    ->where('deadline', '<', now()->utc())
                    ->where('status', '!=', 'completed')
                    ->count();

                $nearingCount = Task::where('user_id', Auth::id())
                    ->where('deadline', '>=', now()->utc())
                    ->where('deadline', '<=', now()->utc()->addDays(3))
                    ->where('status', '!=', 'completed')
                    ->count();

                $reminderCount = $overdueCount + $nearingCount;
            }
        }

        // Bagikan variabel ke semua view
        view()->share('globalReminderCount', $reminderCount);

        return $next($request);
    }
}
