<?php

namespace App\Console\Commands;

use App\Models\Task;
use App\Models\User;
use App\Notifications\DeadlineReminder;
use Illuminate\Console\Command;
use Carbon\Carbon;

class SendDeadlineReminders extends Command
{
    protected $signature = 'reminders:send';
    protected $description = 'Kirim notifikasi pengingat untuk tugas berdasarkan preferensi pengguna.';

    public function handle()
    {
        $this->info('Mulai memeriksa dan mengirim pengingat deadline...');

        // Ambil semua user yang punya preferensi reminder
        $users = User::whereNotNull('reminder_days_before')->get();

        foreach ($users as $user) {
            $reminderDays = $user->reminder_days_before;

            // Batas waktu paling jauh untuk pengingat
            $reminderCutoff = now()->addDays($reminderDays);

            // Ambil SEMUA tugas (baik yang sudah terlambat maupun yang mendekati deadline)
            // dalam satu query. Logikanya:
            // - Belum selesai
            // - Deadline-nya adalah SEBELUM batas waktu pengingat
            $tasksToRemind = Task::where('user_id', $user->id)
                ->where('status', '!=', 'completed')
                ->where('deadline', '<=', $reminderCutoff)
                ->get();

            if ($tasksToRemind->isEmpty()) {
                $this->line("Tidak ada tugas untuk diingatkan kepada {$user->email}.");
                continue;
            }

            $this->info("Menyiapkan {$tasksToRemind->count()} notifikasi untuk: {$user->email}");

            foreach ($tasksToRemind as $task) {
                // Kirim notifikasi untuk setiap tugas.
                // Laravel akan memasukkannya ke dalam antrian.
                $user->notify(new DeadlineReminder($task));
            }
        }

        $this->info('Semua notifikasi pengingat berhasil dimasukkan ke dalam antrian.');
        return 0;
    }
}
