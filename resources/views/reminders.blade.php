@extends('layouts.app')
@section('title', 'Pengingat Deadline')

@section('content')
    <div class="page-header mb-4">
        <h1 class="page-title">Pengingat Deadline</h1>
        <p class="page-subtitle">Lihat tugas yang perlu perhatian lebih.</p>
    </div>

    <ul class="nav nav-tabs mb-3" id="reminderTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="nearing-tab" data-bs-toggle="tab" data-bs-target="#nearing-tab-pane"
                type="button" role="tab" aria-controls="nearing-tab-pane" aria-selected="true">
                Mendekati Deadline <span
                    class="badge rounded-pill bg-warning text-dark">{{ $nearingDeadlineTasks->total() }}</span>
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="overdue-tab" data-bs-toggle="tab" data-bs-target="#overdue-tab-pane" type="button"
                role="tab" aria-controls="overdue-tab-pane" aria-selected="false">
                Tugas Terlambat <span class="badge rounded-pill bg-danger">{{ $overdueTasks->total() }}</span>
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
                    'header' => 'Tugas yang Akan Berakhir dalam ' . $reminderDays . ' Hari ke Depan',
                    'timeColumn' => ['label' => 'Sisa Waktu', 'type' => 'nearing'],
                ])
            @else
                <div class="card">
                    <div class="card-body text-center py-5">
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
                {{-- Gunakan !isEmpty() --}}
                @include('partials.card-task', [
                    'tasks' => $overdueTasks,
                    'header' => 'Tugas yang Sudah Melewati Deadline',
                    'timeColumn' => ['label' => 'Keterlambatan', 'type' => 'overdue'],
                ])
            @else
                <div class="card">
                    <div class="card-body text-center py-5">
                        <i class="bi bi-calendar-x-fill fs-1 text-info mb-3"></i>
                        <h4>Luar Biasa!</h4>
                        <p class="text-muted">Tidak ada tugas yang terlambat.</p>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const urlParams = new URLSearchParams(window.location.search);
            const tab = urlParams.get('tab');

            if (tab) {
                let tabElement;
                if (tab === 'overdue') {
                    tabElement = document.querySelector('#overdue-tab');
                } else if (tab === 'nearing') {
                    tabElement = document.querySelector('#nearing-tab');
                }

                if (tabElement) {
                    // Gunakan instance Bootstrap Tab untuk mengaktifkannya
                    const bsTab = new bootstrap.Tab(tabElement);
                    bsTab.show();
                }
            }
        });
    </script>
@endpush
