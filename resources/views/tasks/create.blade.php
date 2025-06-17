<<x-layout>

    <h1>Form pengisian tugas</h1>

    @if ($message = Session::get('error'))
        <div class="alert alert-danger">
            <p>{{ $message }}</p>
        </div>
    @endif

    <form action="{{ route('task.store') }}" method="post">
        @csrf

        <div class="mb-3">
            <label for="">Judul Tugas</label>
            <input type="text" name="title" class="form-comtrol">
        </div>

        <div class="mb-3">
            <label for="">Deskripsi Tugas</label>
            <input type="text" name="description" class="form-comtrol">
        </div>

        <div class="mb-3">
            <label for="">Status</label>
            <input type="text" name="status" class="form-comtrol">
        </div>

        <div class="mb-3">
            <label for="">Dateline</label>
            <input type="text" name="due_date" class="form-comtrol">
        </div>

        <div class="mb-3">
            <input type="submit" value="simpan" class="btn btn-success float-end">
        </div>
    </form>

    </x-layout>
