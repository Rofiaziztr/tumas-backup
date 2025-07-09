@extends('layouts.app')
@section('title', 'Profil Pengguna')

@section('content')
    @include('partials.page-header', [
        'title' => 'Profil Pengguna',
        'subtitle' => 'Kelola informasi dan preferensi akun Anda.',
    ])

    <div class="row justify-content-center">
        <div class="col-lg-8">
            @include('partials.alerts')

            {{-- Kartu Profil Pengguna --}}

            <div class="card">
                <form action="{{ route('profile.update') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        {{-- Nama --}}
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input id="name" type="text" class="form-control" name="name"
                                value="{{ old('name', $user->name) }}" required>
                        </div>
                        {{-- Email --}}
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input id="email" type="email" class="form-control" value="{{ $user->email }}" disabled
                                style="background-color: #e9ecef;">
                            <div class="form-text">Email tidak dapat diubah.</div>
                        </div>
                        {{-- Ingatkan Saya --}}
                        <div class="mb-3">
                            <label for="reminder_days_before" class="form-label">Ingatkan Saya (H-)</label>
                            <select name="reminder_days_before" id="reminder_days_before" class="form-select">
                                @for ($i = 1; $i <= 7; $i++)
                                    <option value="{{ $i }}"
                                        {{ old('reminder_days_before', $user->reminder_days_before) == $i ? 'selected' : '' }}>
                                        {{ $i }} hari sebelum deadline
                                    </option>
                                @endfor
                            </select>
                            <div class="form-text">Notifikasi akan dikirim setiap hari pada pukul 08:00 pagi dalam rentang
                                waktu yang Anda pilih.</div>
                        </div>
                        {{-- Terdaftar Pada --}}
                        <div>
                            <label class="form-label">Terdaftar Pada</label>
                            <p class="text-muted">{{ $user->created_at->timezone('Asia/Jakarta')->format('d M Y H:i') }} WIB
                            </p>
                        </div>
                    </div>
                    {{-- Tombol Aksi --}}
                    <div class="card-footer bg-transparent">
                        <div class="d-flex justify-content-between align-items-center">
                            <a href="{{ route('dashboard') }}" class="btn btn-secondary">Kembali</a>
                            <button type="submit" class="btn btn-success">
                                <i class="bi bi-save"></i> Simpan Perubahan
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
