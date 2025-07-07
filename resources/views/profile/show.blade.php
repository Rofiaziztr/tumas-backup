@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">Profil Pengguna</div>

                    <div class="card-body">
                        <form action="{{ route('profile.update') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label" for="name">Nama</label>
                                <input type="text" id="name" name="name" class="form-control"
                                    value="{{ old('name', $user->name) }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="email">Email</label>
                                <input type="email" id="email" class="form-control" value="{{ $user->email }}"
                                    disabled>
                                <div class="form-text">Email tidak dapat diubah.</div>
                            </div>
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
                                <div class="form-text">Notifikasi akan dikirim setiap hari pada pukul 08:00 pagi dalam
                                    rentang waktu yang Anda pilih.</div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Terdaftar Pada</label>
                                <p class="form-control-static">
                                    {{ $user->created_at->timezone('Asia/Jakarta')->format('d M Y H:i') }} WIB
                                </p>
                            </div>
                            <button type="submit" class="btn btn-success">
                                <i class="bi bi-save"></i> Simpan Perubahan
                            </button>
                            <a href="{{ route('dashboard') }}" class="btn btn-secondary">
                                Kembali ke Dashboard
                            </a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
