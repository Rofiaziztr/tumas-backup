<div class="mb-3">
    <label for="title" class="form-label">Judul Tugas *</label>
    <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $task->title ?? '') }}"
        required>
</div>

<div class="mb-3">
    <label for="description" class="form-label">Deskripsi</label>
    <textarea class="form-control" id="description" name="description" rows="3">{{ old('description', $task->description ?? '') }}</textarea>
</div>

<div class="mb-3">
    <label for="course" class="form-label">Mata Kuliah *</label>
    <input type="text" class="form-control" id="course" name="course"
        value="{{ old('course', $task->course ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="category" class="form-label">Kategori Tugas</label>
    <select class="form-select" id="category" name="category">
        <option value="">Pilih Kategori</option>
        <option value="Tugas" {{ old('category', $task->category ?? '') == 'Tugas' ? 'selected' : '' }}>Tugas
        </option>
        <option value="Kuis" {{ old('category', $task->category ?? '') == 'Kuis' ? 'selected' : '' }}>Kuis</option>
        <option value="UTS" {{ old('category', $task->category ?? '') == 'UTS' ? 'selected' : '' }}>UTS</option>
        <option value="UAS" {{ old('category', $task->category ?? '') == 'UAS' ? 'selected' : '' }}>UAS</option>
        <option value="Projek" {{ old('category', $task->category ?? '') == 'Projek' ? 'selected' : '' }}>Projek
        </option>
        <option value="Lainnya" {{ old('category', $task->category ?? '') == 'Lainnya' ? 'selected' : '' }}>Lainnya
        </option>
    </select>
</div>

@php
    $deadlineValue = old('deadline');
    if (isset($task) && empty($deadlineValue)) {
        $deadlineValue = $task->deadline->setTimezone('Asia/Jakarta')->format('Y-m-d\TH:i');
    }
@endphp

<div class="mb-3">
    <label for="deadline" class="form-label">Deadline *</label>
    <input type="datetime-local" class="form-control" id="deadline" name="deadline" value="{{ $deadlineValue }}"
        required>
</div>

<div class="mb-3">
    <label for="priority" class="form-label">Prioritas *</label>
    <select class="form-select" id="priority" name="priority" required>
        <option value="low" {{ old('priority', $task->priority ?? '') == 'low' ? 'selected' : '' }}>Rendah
        </option>
        <option value="medium" {{ old('priority', $task->priority ?? '') == 'medium' ? 'selected' : '' }}>Sedang
        </option>
        <option value="high" {{ old('priority', $task->priority ?? '') == 'high' ? 'selected' : '' }}>Tinggi
        </option>
    </select>
</div>

<div class="mb-3">
    <label for="status" class="form-label">Status *</label>
    <select class="form-select" id="status" name="status" required>
        <option value="todo" {{ old('status', $task->status ?? '') == 'todo' ? 'selected' : '' }}>Belum Dikerjakan
        </option>
        <option value="in_progress" {{ old('status', $task->status ?? '') == 'in_progress' ? 'selected' : '' }}>
            Sedang Dikerjakan</option>
        <option value="completed" {{ old('status', $task->status ?? '') == 'completed' ? 'selected' : '' }}>Selesai
        </option>
    </select>
</div>
