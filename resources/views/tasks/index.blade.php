@extends('layouts.main')

@section('main-content')
    <div class="container">
        <h1 class="mt-5">Tasks</h1>
        <p class="lead">Here you can manage your tasks.</p>
        <p>To get started, you can create a new task or view existing tasks.</p>
        {{-- <div class="mb-3">
        <a href="{{ route('tasks.create') }}" class="btn btn-primary">Create New Task</a>
    </div> --}}
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tasks as $task)
                    <tr>
                        <td>{{ $task->id }}</td>
                        <td>{{ $task->title }}</td>
                        <td>{{ $task->description }}</td>
                        <td>{{ $task->status }}</td>
                        {{-- <td>
                        <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td> --}}
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
