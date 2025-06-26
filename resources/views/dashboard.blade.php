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

    {{-- Filter --}}
    <div class="card mb-4">
        <div class="card-header">Filter Tugas</div>
        <div class="card-body">
            <form method="GET" action="{{ route('dashboard') }}">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Status</label>
                        <div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="status[]" id="status_todo"
                                    value="todo" {{ in_array('todo', request('status', [])) ? 'checked' : '' }}>
                                <label class="form-check-label" for="status_todo">Belum Dikerjakan</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="status[]" id="status_in_progress"
                                    value="in_progress"
                                    {{ in_array('in_progress', request('status', [])) ? 'checked' : '' }}>
                                <label class="form-check-label" for="status_in_progress">Sedang Dikerjakan</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="status[]" id="status_completed"
                                    value="completed" {{ in_array('completed', request('status', [])) ? 'checked' : '' }}>
                                <label class="form-check-label" for="status_completed">Selesai</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="course" class="form-label">Mata Kuliah</label>
                        <input type="text" name="course" id="course" class="form-control"
                            value="{{ request('course') }}" placeholder="Nama mata kuliah">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="category" class="form-label">Kategori</label>
                        <select class="form-select" id="category" name="category">
                            <option value="">Semua</option>
                            <option value="Tugas" {{ request('category') == 'Tugas' ? 'selected' : '' }}>Tugas</option>
                            <option value="Kuis" {{ request('category') == 'Kuis' ? 'selected' : '' }}>Kuis</option>
                            <option value="UTS" {{ request('category') == 'UTS' ? 'selected' : '' }}>UTS</option>
                            <option value="UAS" {{ request('category') == 'UAS' ? 'selected' : '' }}>UAS</option>
                            <option value="Projek" {{ request('category') == 'Projek' ? 'selected' : '' }}>Projek</option>
                            <option value="Lainnya" {{ request('category') == 'Lainnya' ? 'selected' : '' }}>Lainnya
                            </option>
                        </select>
                    </div>
                    <div class="col-md-4 d-flex align-items-end mb-3">
                        <button type="submit" class="btn btn-primary">Filter</button>
                        <a href="{{ route('dashboard') }}" class="btn btn-secondary ms-2">Reset</a>
                    </div>
                </div>
            </form>
        </div>
    </div>



    <!-- Tugas Utama -->
    @include('partials.card-task', [
        'tasks' => $tasks,
        'header' => 'Daftar Tugas',
    ])
@endsection
