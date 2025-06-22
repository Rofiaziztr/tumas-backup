@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Profil Pengguna</div>

                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Nama</label>
                            <p class="form-control-static">{{ $user->name }}</p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <p class="form-control-static">{{ $user->email }}</p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Terdaftar Pada</label>
                            <p class="form-control-static">
                                {{ $user->created_at->timezone('Asia/Jakarta')->format('d M Y H:i') }} WIB
                            </p>
                        </div>
                        <a href="{{ route('dashboard') }}" class="btn btn-primary">
                            <i class="bi bi-arrow-left"></i> Kembali ke Dashboard
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
