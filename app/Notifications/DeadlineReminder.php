<?php

namespace App\Notifications;

use App\Models\Task;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Carbon;

class DeadlineReminder extends Notification implements ShouldQueue // Implementasikan ShouldQueue
{
    use Queueable;

    protected $task;

    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    /**
     * Tentukan channel pengiriman notifikasi.
     * Sekarang kita tambahkan 'mail' untuk pengiriman via email.
     */
    public function via(object $notifiable): array
    {
        return ['database', 'mail']; // Tambahkan 'mail'
    }

    /**
     * Buat representasi email dari notifikasi.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $deadline = Carbon::parse($this->task->deadline)->setTimezone('Asia/Jakarta');
        $url = route('tasks.show', $this->task->id);

        return (new MailMessage)
                    ->subject('Pengingat Deadline Tugas: ' . $this->task->title)
                    ->greeting('Halo, ' . $notifiable->name . '!')
                    ->line("Ini adalah pengingat bahwa tugas Anda \"{$this->task->title}\" untuk mata kuliah {$this->task->course} akan segera berakhir.")
                    ->line("Deadline: {$deadline->format('l, d F Y, H:i')} WIB.")
                    ->action('Lihat Detail Tugas', $url)
                    ->line('Segera selesaikan tugasmu ya. Semangat!');
    }

    /**
     * Ubah notifikasi menjadi array untuk disimpan di database.
     */
    public function toArray(object $notifiable): array
    {
        // Pesan ini untuk notifikasi di dalam aplikasi (database)
        $timeDiff = $this->task->deadline->diffForHumans();

        return [
            'task_id' => $this->task->id,
            'title' => $this->task->title,
            'course' => $this->task->course,
            'deadline' => $this->task->deadline->format('d F Y'),
            'message' => "Deadline tugas '{$this->task->title}' {$timeDiff}.",
        ];
    }
}