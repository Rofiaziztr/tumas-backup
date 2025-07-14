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
    <<<<<<< HEAD @include('partials.task-summary')=======@if ($overdueTasks->count() > 0 || $nearingDeadlineTasks->count() > 0)
        <div class="row">
            {{-- Overdue Tasks Alert --}}
            <div class="col-lg-6 mb-4">
                <div class="alert alert-danger h-100 d-flex flex-column justify-content-center">
                    <div class="d-flex align-items-center">
                        <div class="fs-1 fw-bold me-3">{{ $overdueTasks->count() }}</div>
                        <div class="flex-grow-1">
                            <h5 class="alert-heading mb-0">Tugas Terlambat</h5>
                            <small>Segera kerjakan sebelum menumpuk!</small>
                        </div>
                        <i class="bi bi-exclamation-triangle-fill fs-2 opacity-25"></i>
                    </div>
                </div>
            </div>

            {{-- Nearing Deadline Tasks Alert --}}
            <div class="col-lg-6 mb-4">
                <div class="alert alert-warning h-100 d-flex flex-column justify-content-center">
                    <div class="d-flex align-items-center">
                        <div class="fs-1 fw-bold me-3">{{ $nearingDeadlineTasks->count() }}</div>
                        <div class="flex-grow-1">
                            <h5 class="alert-heading mb-0">Mendekati Deadline</h5>
                            <small>Jangan sampai terlewat!</small>
                        </div>
                        <i class="bi bi-clock-fill fs-2 opacity-25"></i>
                    </div>
                </div>
            </div>
        </div>
        @endif
        >>>>>>> 00ebd00b80177db8a8a0e18f671af4a9400545ee

        {{-- Filter --}}
        @include('partials.task-filter')



        <!-- Tugas Utama -->
        @include('partials.card-task', [
            'tasks' => $tasks,
            'header' => 'Daftar Tugas Anda',
        ])
    @endsection
