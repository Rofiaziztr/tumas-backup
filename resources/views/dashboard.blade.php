@extends('layouts.app')

@section('content')
    @include('partials.page-header', [
        'title' => 'Dashboard Tugas',
        'actions' =>
            '
                                        <a href="' .
            route('tasks.create') .
            '" class="btn btn-primary">
                                            <i class="bi bi-plus-circle"></i> Tambah Tugas
                                        </a>
                                    ',
    ])

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Ringkasan Notifikasi --}}
    @include('partials.task-summary')

    {{-- Filter --}}
    @include('partials.task-filter')

    <!-- Tugas Utama -->
    @include('partials.card-task', [
        'tasks' => $tasks,
        'header' => 'Daftar Tugas Anda',
    ])
@endsection
