@extends('layouts.app')

@section('content')
    <div class="row mb-3">
        <div class="col-md-6">
            <h2>Pengingat Deadline</h2>
        </div>
    </div>

    @if ($reminders->isEmpty())
        <div class="alert alert-info">
            Tidak ada tugas dengan deadline dekat. Bagus!
        </div>
    @else
        <div class="alert alert-warning">
            <i class="bi bi-exclamation-triangle"></i> Anda memiliki {{ $reminders->count() }} tugas yang mendekati deadline!
        </div>

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Judul</th>
                                <th>Mata Kuliah</th>
                                <th>Deadline</th>
                                <th>Sisa Waktu</th>
                                <th>Prioritas</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reminders as $task)
                                <tr>
                                    <td>{{ $task->title }}</td>
                                    <td>{{ $task->course }}</td>
                                    <td>{{ $task->deadline->format('d M Y H:i') }}</td>
                                    <td>
                                        @php
                                            $diff = $task->deadline->diff(now());
                                        @endphp
                                        {{ $diff->d }} hari, {{ $diff->h }} jam
                                    </td>
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
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif
@endsection
