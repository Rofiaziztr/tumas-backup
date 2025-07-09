@if ($overdueTasks->isNotEmpty() || $nearingDeadlineTasks->isNotEmpty())
    <div class="row">
        {{-- Kartu untuk Tugas Terlambat --}}
        @if ($overdueTasks->isNotEmpty())
            <div class="col-lg-6 mb-4">
                <div class="alert alert-danger h-100 d-flex flex-column justify-content-center">
                    <div class="d-flex align-items-center">
                        <div class="fs-1 fw-bold me-3">{{ $overdueTasks->count() }}</div>
                        <div class="flex-grow-1">
                            <h5 class="alert-heading mb-0">Tugas Terlambat</h5>
                            <a href="{{ route('reminders') }}" class="alert-link small">Segera kerjakan sebelum
                                menumpuk!</a>
                        </div>
                        <i class="bi bi-exclamation-triangle-fill fs-2 opacity-25"></i>
                    </div>
                </div>
            </div>
        @endif

        {{-- Kartu untuk Tugas Mendekati Deadline --}}
        @if ($nearingDeadlineTasks->isNotEmpty())
            <div class="col-lg-6 mb-4">
                <div class="alert alert-warning h-100 d-flex flex-column justify-content-center">
                    <div class="d-flex align-items-center">
                        <div class="fs-1 fw-bold me-3">{{ $nearingDeadlineTasks->count() }}</div>
                        <div class="flex-grow-1">
                            <h5 class="alert-heading mb-0">Mendekati Deadline</h5>
                            <a href="{{ route('reminders') }}" class="alert-link small">Jangan sampai terlewat!</a>
                        </div>
                        <i class="bi bi-clock-fill fs-2 opacity-25"></i>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endif
