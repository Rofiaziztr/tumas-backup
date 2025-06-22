@extends('layouts.app')

@section('content')
    <div class="row mb-3">
        <div class="col-md-6">
            <h2>Edit Tugas</h2>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('tasks.update', $task->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="title" class="form-label">Judul Tugas *</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $task->title) }}"
                required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi</label>
            <textarea class="form-control" id="description" name="description" rows="3">{{ old('description', $task->description) }}</textarea>
        </div>
        <div class="mb-3">
            <label for="course" class="form-label">Mata Kuliah *</label>
            <input type="text" class="form-control" id="course" name="course"
                value="{{ old('course', $task->course) }}" required>
        </div>
        <div class="mb-3">
            <label for="deadline" class="form-label">Deadline *</label>
            <input type="datetime-local" class="form-control" id="deadline" name="deadline"
                value="{{ old('deadline', isset($task) ? $task->deadline->setTimezone('Asia/Jakarta')->format('Y-m-d\TH:i') : '') }}"
                required>
        </div>
        <div class="mb-3">
            <label for="priority" class="form-label">Prioritas *</label>
            <select class="form-select" id="priority" name="priority" required>
                <option value="low" {{ old('priority', $task->priority) == 'low' ? 'selected' : '' }}>Rendah</option>
                <option value="medium" {{ old('priority', $task->priority) == 'medium' ? 'selected' : '' }}>Sedang</option>
                <option value="high" {{ old('priority', $task->priority) == 'high' ? 'selected' : '' }}>Tinggi</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">Status *</label>
            <select class="form-select" id="status" name="status" required>
                <option value="todo" {{ old('status', $task->status) == 'todo' ? 'selected' : '' }}>Belum Dikerjakan
                </option>
                <option value="in_progress" {{ old('status', $task->status) == 'in_progress' ? 'selected' : '' }}>Sedang
                    Dikerjakan</option>
                <option value="completed" {{ old('status', $task->status) == 'completed' ? 'selected' : '' }}>Selesai
                </option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('dashboard') }}" class="btn btn-secondary">Batal</a>
    </form>
@endsection
