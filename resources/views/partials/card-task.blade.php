<div class="card {{ $borderClass ?? '' }}">
    @if (isset($header))
        <div class="card-header {{ $headerClass ?? '' }}">{!! $header !!}</div>
    @endif
    <div class="card-body">
        @if ($tasks->isEmpty())
            <p class="text-muted">Belum ada tugas.</p>
        @else
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul</th>
                            <th>Mata Kuliah</th>
                            <th>Kategori</th>
                            <th>Deadline</th>
                            @if (isset($timeColumn))
                                <th>{{ $timeColumn['label'] }}</th>
                            @endif
                            <th>Prioritas</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tasks as $task)
                            <tr class="{{ $rowClass ?? '' }}">
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <a href="{{ route('tasks.show', $task->id) }}">{{ $task->title }}</a>
                                </td>
                                <td>{{ $task->course }}</td>
                                <td>{{ $task->category }}</td>
                                <td>{{ $task->deadline->setTimezone('Asia/Jakarta')->format('d M Y H:i') }} WIB</td>

                                @if (isset($timeColumn))
                                    <td>
                                        @php
                                            $diff =
                                                $timeColumn['type'] === 'overdue'
                                                    ? now()->diff($task->deadline)
                                                    : $task->deadline->diff(now());
                                        @endphp
                                        {{ $diff->d }} hari, {{ $diff->h }} jam
                                    </td>
                                @endif

                                <td>
                                    <span
                                        class="badge bg-{{ $task->priority == 'high' ? 'danger' : ($task->priority == 'medium' ? 'warning' : 'success') }}">
                                        {{ ucfirst($task->priority) }}
                                    </span>
                                </td>
                                <td>
                                    <span
                                        class="badge bg-{{ $task->status == 'completed' ? 'success' : ($task->status == 'in_progress' ? 'primary' : 'secondary') }}">
                                        {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                                    </span>
                                </td>

                                <td>
                                    <a href="{{ route('tasks.edit', $task->id) }}"
                                        class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{ route('tasks.destroy', $task->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Hapus tugas?')">Hapus</button>
                                    </form>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>
