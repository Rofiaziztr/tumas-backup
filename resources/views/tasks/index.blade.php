<x-layout :title="$title">
    <div class="container">
        <h1>Data Tugas</h1>

        <a href="{{ route('task.create') }}" class="btn btn-primary">Tambah Data</a>

        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>Deskripsi</th>
                    <th>status</th>
                    <th>dateline</th>
                </tr>

            </thead>

            <tbody>
                @foreach ($tasks as $task)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <a href="{{ route('task.show', $task->id) }}">{{ $task->code }}</a>
                        </td>
                        <td>{{ $task->name }}</td>
                        <td class="d-flex">
                            <a href="{{ route('task.edit', $task->id) }}" class="btn btn-warning btn-sm ms-2">Edit</a>
                            <form action="{{ route('task.destroy', $task->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <input type="submit" value="hapus" class="btn btn-danger btn-sm ms-2">
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-layout>
