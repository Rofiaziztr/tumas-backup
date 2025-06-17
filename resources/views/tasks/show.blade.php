<<x-layout>
    <p>Judul Tugas<b>{{ $task->title }}</b> </p>
    <p>Deskripsi<b>{{ $task->description }}</b> </p>
    <p>Status<b>{{ $task->status }}</b> </p>
    <p>Dateline<b>{{ $task->due_date }}</b> </p>
    <p>Tanggal dibuat<b>{{ date('d-M-Y', strtotime($task->created_at)) }}</b></p>
    </x-layout>
