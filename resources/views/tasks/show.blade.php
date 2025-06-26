@extends('layouts.app')

@section('content')
    <div class="row mb-4">
        <div class="col-md-6">
            <h2>Detail Tugas</h2>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-warning">Edit</a>
            <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Hapus tugas?')">Hapus</button>
            </form>
            <a href="{{ route('dashboard') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-8">
                    <h3>{{ $task->title }}</h3>
                    <p class="text-muted">{{ $task->course }} • {{ $task->category ?? 'Tanpa Kategori' }}</p>

                    @if ($task->description)
                        <div class="mb-4">
                            <h5>Deskripsi:</h5>
                            <p>{{ $task->description }}</p>
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <h5>Deadline:</h5>
                                <p>{{ $task->deadline->setTimezone('Asia/Jakarta')->format('d M Y H:i') }} WIB</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <h5>Prioritas:</h5>
                                <span
                                    class="badge bg-{{ $task->priority == 'high' ? 'danger' : ($task->priority == 'medium' ? 'warning' : 'success') }}">
                                    {{ ucfirst($task->priority) }}
                                </span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <h5>Status:</h5>
                                <span
                                    class="badge bg-{{ $task->status == 'completed' ? 'success' : ($task->status == 'in_progress' ? 'primary' : 'secondary') }}">
                                    {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                                </span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <h5>Dibuat pada:</h5>
                                <p>{{ $task->created_at->setTimezone('Asia/Jakarta')->format('d M Y H:i') }} WIB</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-light">
                        <div class="card-header">Info Waktu</div>
                        <div class="card-body">
                            @if ($task->deadline < now())
                                <div class="alert alert-danger">
                                    <strong>Terlambat!</strong><br>
                                    @php
                                        $diff = now()->diff($task->deadline);
                                    @endphp
                                    Telat {{ $diff->d }} hari, {{ $diff->h }} jam
                                </div>
                            @elseif($task->deadline <= now()->addDays(3))
                                <div class="alert alert-warning">
                                    <strong>Deadline Mendekati!</strong><br>
                                    @php
                                        $diff = $task->deadline->diff(now());
                                    @endphp
                                    Sisa waktu: {{ $diff->d }} hari, {{ $diff->h }} jam
                                </div>
                            @else
                                <div class="alert alert-success">
                                    <strong>Masih Ada Waktu</strong><br>
                                    @php
                                        $diff = $task->deadline->diff(now());
                                    @endphp
                                    Sisa waktu: {{ $diff->d }} hari, {{ $diff->h }} jam
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
