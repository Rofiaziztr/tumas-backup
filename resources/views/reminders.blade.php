@extends('layouts.app')
@section('title', 'Pengingat Deadline')

@section('content')
    <h1 class="mb-4">Pengingat Deadline</h1>

    <ul class="nav nav-tabs mb-3" id="reminderTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="nearing-tab" data-bs-toggle="tab" data-bs-target="#nearing-tab-pane"
                type="button" role="tab" aria-controls="nearing-tab-pane" aria-selected="true">
                Mendekati Deadline <span
                    class="badge rounded-pill bg-warning text-dark">{{ $nearingDeadlineTasks->count() }}</span>
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="overdue-tab" data-bs-toggle="tab" data-bs-target="#overdue-tab-pane" type="button"
                role="tab" aria-controls="overdue-tab-pane" aria-selected="false">
                Tugas Terlambat <span class="badge rounded-pill bg-danger">{{ $overdueTasks->count() }}</span>
            </button>
        </li>
    </ul>

    <div class="tab-content" id="reminderTabsContent">
        {{-- Konten untuk Tugas Mendekati Deadline --}}
        <div class="tab-pane fade show active" id="nearing-tab-pane" role="tabpanel" aria-labelledby="nearing-tab"
            tabindex="0">
            @if (!$nearingDeadlineTasks->isEmpty())
                @include('partials.card-task', [
                    'tasks' => $nearingDeadlineTasks,
                    'header' => 'Tugas yang Akan Berakhir dalam 3 Hari ke Depan',
                    'timeColumn' => ['label' => 'Sisa Waktu', 'type' => 'nearing'],
                ])
            @else
                <div class="card">
                    <div class="card-body text-center">
                        <i class="bi bi-check-circle-fill fs-1 text-success mb-3"></i>
                        <h4>Kerja Bagus!</h4>
                        <p class="text-muted">Tidak ada tugas yang mendekati deadline.</p>
                    </div>
                </div>
            @endif
        </div>

        {{-- Konten untuk Tugas Terlambat --}}
        <div class="tab-pane fade" id="overdue-tab-pane" role="tabpanel" aria-labelledby="overdue-tab" tabindex="0">
            @if (!$overdueTasks->isEmpty())
                @include('partials.card-task', [
                    'tasks' => $overdueTasks,
                    'header' => 'Tugas yang Sudah Melewati Deadline',
                    'timeColumn' => ['label' => 'Keterlambatan', 'type' => 'overdue'],
                ])
            @else
                <div class="card">
                    <div class="card-body text-center">
                        <i class="bi bi-calendar-x-fill fs-1 text-info mb-3"></i>
                        <h4>Luar Biasa!</h4>
                        <p class="text-muted">Tidak ada tugas yang terlambat.</p>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
