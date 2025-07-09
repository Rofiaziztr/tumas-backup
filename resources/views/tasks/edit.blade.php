@extends('layouts.app')

@section('content')
    @include('partials.page-header', [
        'title' => 'Edit Tugas',
        'subtitle' => 'Edit sesuai yang anda inginkan.',
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
        <div class="col-lg-8"> {{-- BATASI LEBAR FORM --}}
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('tasks.update', $task->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        @include('tasks.form')
                        <button type="submit" class="btn btn-primary">Update</button>
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
