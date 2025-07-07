<?php

namespace App\Console\Commands;

use App\Models\Task;
use App\Models\User;
use App\Notifications\DeadlineReminder;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Notification;

class SendDeadlineReminders extends Command
{
    /**
     * Nama dan signature dari perintah konsol.
     */
    protected $signature = 'reminders:send';

    /**
     * Deskripsi perintah konsol.
     */
    protected $description = 'Kirim notifikasi pengingat untuk tugas yang akan segera berakhir.';

    /**
     * Jalankan perintah konsol.
     */
    public function handle()
    {
        $this->info('Mencari tugas yang mendekati deadline...');

        // Cari semua tugas yang belum selesai dan akan berakhir besok.
        $tasks = Task::where('status', '!=', 'completed')
            ->whereBetween('deadline', [now(), now()->addDays(3)])
            ->get();

        if ($tasks->isEmpty()) {
            $this->info('Tidak ada tugas yang perlu diingatkan hari ini.');
            return 0; // Berhasil, tidak ada tugas
        }

        $this->info("Ditemukan {$tasks->count()} tugas. Mengelompokkan per pengguna...");

        // Kelompokkan tugas berdasarkan user_id agar efisien
        $tasksByUser = $tasks->groupBy('user_id');

        foreach ($tasksByUser as $userId => $userTasks) {
            $user = User::find($userId);
            if ($user) {
                $this->info("Mengirim {$userTasks->count()} notifikasi ke: {$user->email}");
                // Kirim notifikasi untuk setiap tugas
                foreach ($userTasks as $task) {
                    $user->notify(new DeadlineReminder($task));
                }
            }
        }

        $this->info('Semua notifikasi pengingat berhasil dikirim.');
        return 0; // Berhasil
    }
}
