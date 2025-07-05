<?php

namespace App\Notifications;

use App\Models\Task;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DeadlineReminder extends Notification
{
    use Queueable;

    protected $task;

    /**
     * Buat instance notifikasi baru.
     */
    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    /**
     * Tentukan channel pengiriman notifikasi.
     * Kita akan menggunakan 'database'. Channel lain seperti 'mail' bisa ditambahkan nanti.
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Ubah notifikasi menjadi array untuk disimpan di database.
     */
    public function toArray(object $notifiable): array
    {
        return [
            'task_id' => $this->task->id,
            'title' => $this->task->title,
            'course' => $this->task->course,
            'deadline' => $this->task->deadline->format('d F Y'),
            'message' => "Tugas '{$this->task->title}' akan berakhir besok!",
        ];
    }
}