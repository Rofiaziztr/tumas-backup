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
        $this->info('Mulai mengirim pengingat deadline...');

        // Ambil semua user yang punya preferensi reminder
        $users = User::whereNotNull('reminder_days_before')->get();

        foreach ($users as $user) {
            $daysBefore = $user->reminder_days_before;

            // Cari tugas user yg belum selesai & deadline-nya berada dalam rentang preferensi user
            $tasksToRemind = Task::where('user_id', $user->id)
                ->where('status', '!=', 'completed')
                // Logika: deadline harus di antara sekarang dan `daysBefore` dari sekarang
                ->whereBetween('deadline', [Carbon::now(), Carbon::now()->addDays($daysBefore)])
                ->get();
            
            // Logika tambahan untuk tugas yang terlambat (tetap dikirim notifikasi)
            $overdueTasks = Task::where('user_id', $user->id)
                ->where('status', '!=', 'completed')
                ->whereDate('deadline', '<', Carbon::today()) // Cek yang sudah lewat hari
                ->get();
            
            $allTasks = $tasksToRemind->merge($overdueTasks)->unique('id');


            if ($allTasks->isEmpty()) {
                $this->line("Tidak ada tugas untuk diingatkan kepada {$user->email}.");
                continue;
            }

            $this->info("Mengirim {$allTasks->count()} notifikasi ke: {$user->email}");
            foreach ($allTasks as $task) {
                // Kirim notifikasi untuk setiap tugas
                // (Laravel cukup pintar untuk tidak mengirim notifikasi yang sama berulang kali jika sudah ada)
                $user->notify(new DeadlineReminder($task));
            }
        }

        $this->info('Semua notifikasi pengingat berhasil diproses.');
        return 0;
    }
}