<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        // Bagikan data notifikasi hanya ke view 'partials.navbar'
        View::composer('partials.navbar', function ($view) {
            if (Auth::check()) {
                // Ambil 5 notifikasi terbaru yang belum dibaca
                $notifications = Auth::user()->unreadNotifications->take(5);
                $view->with('globalNotifications', $notifications);
            }
        });
    }
}