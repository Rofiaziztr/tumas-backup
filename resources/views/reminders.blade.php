@extends('layouts.app')

@section('content')
    <div class="row mb-3">
        <div class="col-md-6">
            <h2>Pengingat Deadline</h2>
        </div>
    </div>

    @php
        $totalReminders = $nearingDeadlineTasks->count() + $overdueTasks->count();
    @endphp

    @if ($totalReminders === 0)
        <div class="alert alert-info">
            Tidak ada tugas yang perlu diperhatikan. Bagus!
        </div>
    @else
        {{-- Tampilkan tugas overdue --}}
        @if (!$overdueTasks->isEmpty())
            <div class="alert alert-danger">
                <i class="bi bi-exclamation-triangle"></i> Anda memiliki {{ $overdueTasks->count() }} tugas yang sudah lewat
                deadline!
            </div>

            @include('partials.card-task', [
                'tasks' => $overdueTasks,
                'header' => 'Tugas Terlambat (Overdue)',
                'headerClass' => 'bg-danger text-white',
                'borderClass' => 'border-danger mb-4',
                'timeColumn' => [
                    'label' => 'Keterlambatan',
                    'type' => 'overdue',
                ],
            ])
        @endif

        {{-- Tampilkan tugas yang mendekati deadline --}}
        @if (!$nearingDeadlineTasks->isEmpty())
            <div class="alert alert-warning">
                <i class="bi bi-exclamation-triangle"></i> Anda memiliki {{ $nearingDeadlineTasks->count() }} tugas yang
                mendekati deadline!
            </div>

            @include('partials.card-task', [
                'tasks' => $nearingDeadlineTasks,
                'header' => 'Deadline Mendekati (3 Hari Ke Depan)',
                'headerClass' => 'bg-warning text-white',
                'borderClass' => 'border-warning',
                'timeColumn' => [
                    'label' => 'Sisa Waktu',
                    'type' => 'nearing',
                ],
            ])
        @endif
    @endif
@endsection
