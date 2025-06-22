@extends('layouts.app')

@section('content')
    <div class="row mb-3">
        <div class="col-md-6">
            <h2>Dashboard Tugas</h2>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('tasks.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Tambah Tugas
            </a>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Filter -->
    <div class="card mb-4">
        <div class="card-header">Filter Tugas</div>
        <div class="card-body">
            <form method="GET" action="{{ route('dashboard') }}">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select name="status" id="status" class="form-select">
                            <option value="">Semua</option>
                            <option value="todo" {{ request('status') == 'todo' ? 'selected' : '' }}>Belum Selesai
                            </option>
                            <option value="in_progress" {{ request('status') == 'in_progress' ? 'selected' : '' }}>Sedang
                                Dikerjakan</option>
                            <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Selesai
                            </option>
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="course" class="form-label">Mata Kuliah</label>
                        <input type="text" name="course" id="course" class="form-control"
                            value="{{ request('course') }}" placeholder="Nama mata kuliah">
                    </div>
                    <div class="col-md-4 d-flex align-items-end mb-3">
                        <button type="submit" class="btn btn-primary">Filter</button>
                        <a href="{{ route('dashboard') }}" class="btn btn-secondary ms-2">Reset</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Daftar Tugas -->
    <div class="card">
        <div class="card-header">Daftar Tugas</div>
        <div class="card-body">
            @if ($tasks->isEmpty())
                <p class="text-muted">Belum ada tugas.</p>
            @else
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Judul</th>
                                <th>Mata Kuliah</th>
                                <th>Deadline</th>
                                <th>Prioritas</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tasks as $task)
                                <tr>
                                    <td>{{ $task->title }}</td>
                                    <td>{{ $task->course }}</td>
                                    <td>{{ $task->deadline->format('d M Y H:i') }}</td>
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
@endsection
