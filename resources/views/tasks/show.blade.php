@extends('layouts.app')
@section('title', 'Detail Tugas')

@section('content')
    {{-- Menggunakan partials page-header untuk judul halaman --}}
    @include('partials.page-header', [
        'title' => 'Detail Tugas',
        'subtitle' => 'Rincian lengkap dari tugas yang Anda pilih.',
    ])


    <div class="card shadow-sm">
        <div class="card-header bg-white">
            <div class="d-flex justify-content-between align-items-center">
                {{-- Judul Tugas --}}
                <h4 class="card-title mb-0">{{ $task->title }}</h4>

                {{-- Grup Tombol Aksi --}}
                <div class="btn-group" role="group">
                    {{-- BARU: Tombol Selesaikan (jika tugas belum selesai) --}}
                    @if ($task->status != 'completed')
                        <form action="{{ route('tasks.complete', $task->id) }}" method="POST"
                            onsubmit="return confirm('Tandai tugas ini sebagai selesai?')">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-success me-2">
                                <i class="bi bi-check-circle-fill me-1"></i> Selesai
                            </button>
                        </form>
                    @endif

                    <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-warning">
                        <i class="bi bi-pencil-fill me-1"></i> Edit
                    </a>
                    <form action="{{ route('tasks.destroy', $task->id) }}" method="POST"
                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus tugas ini?')" class="ms-2">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="bi bi-trash-fill me-1"></i> Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                {{-- Kolom Kiri: Detail Tugas --}}
                <div class="col-lg-8">
                    <p class="text-muted mb-4">{{ $task->course }} • {{ $task->category ?? 'Tanpa Kategori' }}</p>

                    @if ($task->description)
                        <div class="mb-4">
                            <h6 class="text-uppercase text-muted small">Deskripsi</h6>
                            <p>{{ $task->description }}</p>
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <h6 class="text-uppercase text-muted small">Deadline</h6>
                            <p>{{ $task->deadline->setTimezone('Asia/Jakarta')->format('d M Y, H:i') }} WIB</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <h6 class="text-uppercase text-muted small">Prioritas</h6>
                            @php
                                $priorityClass = match ($task->priority) {
                                    'high' => 'danger',
                                    'medium' => 'warning',
                                    default => 'success',
                                };
                                $priorityText = match ($task->priority) {
                                    'high' => 'Tinggi',
                                    'medium' => 'Sedang',
                                    default => 'Rendah',
                                };
                            @endphp
                            <span class="badge bg-{{ $priorityClass }}">{{ $priorityText }}</span>
                        </div>
                        <div class="col-md-6 mb-3">
                            <h6 class="text-uppercase text-muted small">Status</h6>
                            @php
                                $statusClass = match ($task->status) {
                                    'completed' => 'success',
                                    'in_progress' => 'primary',
                                    default => 'secondary',
                                };
                                $statusText = match ($task->status) {
                                    'completed' => 'Selesai',
                                    'in_progress' => 'Sedang Dikerjakan',
                                    default => 'Belum Dikerjakan',
                                };
                            @endphp
                            <span class="badge bg-{{ $statusClass }}">{{ $statusText }}</span>
                        </div>
                        <div class="col-md-6 mb-3">
                            <h6 class="text-uppercase text-muted small">Dibuat Pada</h6>
                            <p>{{ $task->created_at->setTimezone('Asia/Jakarta')->format('d M Y, H:i') }} WIB</p>
                        </div>
                    </div>
                </div>

                {{-- Kolom Kanan: Info Waktu --}}
                <div class="col-lg-4">
                    <div class="card bg-light border-0">
                        <div class="card-header bg-transparent fw-bold">Info Waktu</div>
                        <div class="card-body">
                            @if ($task->status == 'completed')
                                <div class="alert alert-info mb-0">
                                    <strong>Selesai!</strong><br>
                                    Tugas ini telah Anda selesaikan.
                                </div>
                            @elseif ($task->deadline < now())
                                <div class="alert alert-danger mb-0">
                                    <strong>Terlambat!</strong><br>
                                    @php
                                        $diff = now()->diff($task->deadline);
                                    @endphp
                                    Telat {{ $diff->d }} hari, {{ $diff->h }} jam
                                </div>
                            @elseif($task->deadline <= now()->addDays(Auth::user()->reminder_days_before ?? 3))
                                <div class="alert alert-warning mb-0">
                                    <strong>Deadline Mendekati!</strong><br>
                                    @php
                                        $diff = $task->deadline->diff(now());
                                    @endphp
                                    Sisa waktu: {{ $diff->d }} hari, {{ $diff->h }} jam
                                </div>
                            @else
                                <div class="alert alert-success mb-0">
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
        <div class="card-footer bg-white text-end">
            <a href="{{ url()->previous() }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left me-1"></i> Kembali
            </a>
        </div>
    </div>
@endsection
