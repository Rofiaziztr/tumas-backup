@extends('layouts.app')

@section('content')
    @include('partials.page-header', [
        'title' => 'Tambah Tugas Baru',
        'subtitle' => 'Isi detail tugas Anda di bawah ini.',
    ])

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('tasks.store') }}" method="POST">
                        @csrf
                        @include('tasks.form')
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('dashboard') }}" class="btn btn-secondary">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        flatpickr("#deadline-picker", {
            enableTime: true,
            dateFormat: "Y-m-d H:i",
            time_24hr: true
        });
    </script>
@endpush
