<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Definisikan jadwal perintah aplikasi.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();

        // Tambahkan baris ini untuk menjalankan perintah setiap hari pukul 08:00 pagi
        $schedule->command('reminders:send')->dailyAt('08:00');
    }

    /**
     * Daftarkan perintah untuk aplikasi.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}