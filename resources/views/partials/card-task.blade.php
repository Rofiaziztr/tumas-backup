<div class="card {{ $borderClass ?? '' }}">
    @if (isset($header))
        <div class="card-header {{ $headerClass ?? '' }}">{!! $header !!}</div>
    @endif
    <div class="card-body card-body-table">

        @if ($tasks->count() == 0)
            <div class="text-center py-4">
                <i class="bi bi-check2-circle fs-1 text-success mb-2"></i>
                <p class="text-muted mb-0">Tidak ada tugas dalam kategori ini.</p>
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr class="text-center">
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
                            <tr class="text-center">
                                {{-- Gunakan key dari paginator untuk nomor urut yang benar --}}
                                <td>{{ $tasks->firstItem() + $loop->index }}</td>
                                <td>
                                    <a href="{{ route('tasks.show', $task->id) }}">{{ $task->title }}</a>
                                </td>
                                <td>{{ $task->course }}</td>
                                <td>{{ $task->category }}</td>
                                <td>{{ \Carbon\Carbon::parse($task->deadline)->setTimezone('Asia/Jakarta')->format('d M Y H:i') }}
                                    WIB</td>

                                @if (isset($timeColumn))
                                    <td>
                                        @php
                                            $diff = $task->deadline->diffForHumans(null, true);
                                        @endphp
                                        {{ $diff }}
                                    </td>
                                @endif

                                <td>
                                    <span
                                        class="badge bg-{{ $task->priority == 'high' ? 'danger' : ($task->priority == 'medium' ? 'warning' : 'success') }}">
                                        @if ($task->priority == 'high')
                                            Tinggi
                                        @elseif($task->priority == 'medium')
                                            Sedang
                                        @else
                                            Rendah
                                        @endif
                                    </span>
                                </td>
                                <td>
                                    <span
                                        class="badge bg-{{ $task->status == 'completed' ? 'success' : ($task->status == 'in_progress' ? 'primary' : 'secondary') }}">
                                        @if ($task->status == 'completed')
                                            Selesai
                                        @elseif($task->status == 'in_progress')
                                            Sedang Dikerjakan
                                        @else
                                            Belum Dikerjakan
                                        @endif
                                    </span>
                                </td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Aksi Tugas">
                                        {{-- Tombol Selesaikan --}}
                                        @if ($task->status != 'completed')
                                            <form action="{{ route('tasks.complete', $task->id) }}" method="POST"
                                                onsubmit="return confirm('Tandai tugas ini sebagai selesai?')">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-sm btn-success me-1"
                                                    title="Tandai Selesai">
                                                    <i class="bi bi-check-lg"></i> <span
                                                        class="d-none d-md-inline">Selesai</span>
                                                </button>
                                            </form>
                                        @endif

                                        {{-- Tombol Edit --}}
                                        <a href="{{ route('tasks.edit', $task->id) }}"
                                            class="btn btn-sm btn-warning me-1">
                                            <i class="bi bi-pencil"></i> <span class="d-none d-md-inline">Edit</span>
                                        </a>

                                        {{-- Tombol Hapus --}}
                                        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus tugas ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="bi bi-trash"></i> <span
                                                    class="d-none d-md-inline">Hapus</span>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    @if ($tasks instanceof \Illuminate\Pagination\LengthAwarePaginator && $tasks->hasPages())
        <div class="card-footer bg-transparent pt-3 pb-3">
            <div class="d-flex justify-content-between align-items-center">
                <div class="text-muted">
                    <small>
                        Showing {{ $tasks->firstItem() }} to {{ $tasks->lastItem() }} of {{ $tasks->total() }}
                        results
                    </small>
                </div>

                <div>
                    {!! $tasks->withQueryString()->links('vendor.pagination.custom') !!}
                </div>
            </div>
        </div>
    @endif
</div>
