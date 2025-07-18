<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Ambil ID tugas yg masuk kategori pengingat (terlambat & mendekati)
        $overdueTasks = $this->getOverdueTasks();
        $nearingDeadlineTasks = $this->getNearingDeadlineTasks();

        $excludedIds = $overdueTasks->pluck('id')->merge($nearingDeadlineTasks->pluck('id'));

        // Query tugas utama: tidak terlambat dan tidak mendekati deadline.
        $query = Task::where('user_id', Auth::id())
            ->whereNotIn('id', $excludedIds);

        $this->applyFilters($query, $request);
        $tasks = $query->orderBy('deadline')->paginate(10);

        return view('dashboard', compact('tasks', 'nearingDeadlineTasks', 'overdueTasks'));
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'course' => 'required|max:100',
            'deadline' => 'required|date',
            'priority' => 'required|in:low,medium,high',
            'status' => 'required|in:todo,in_progress,completed'
        ]);

        $task = new Task($request->all());
        $task->user_id = Auth::id();
        $task->deadline = $request->deadline;
        $task->save();

        return redirect()->route('dashboard')->with('success', 'Tugas berhasil ditambahkan!');
    }

    public function edit(Task $task)
    {
        // Pastikan tugas milik user yang login
        if ($task->user_id !== Auth::id()) {
            abort(403);
        }
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        if ($task->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'title' => 'required|max:255',
            'course' => 'required|max:100',
            'deadline' => 'required|date',
            'priority' => 'required|in:low,medium,high',
            'status' => 'required|in:todo,in_progress,completed'
        ]);

        $task->deadline = $request->deadline;
        $task->update($request->all());
        return redirect()->route('dashboard')->with('success', 'Tugas berhasil diperbarui!');
    }

    public function show(Task $task)
    {
        // Pastikan tugas milik user yang login
        if ($task->user_id !== Auth::id()) {
            abort(403);
        }

        return view('tasks.show', compact('task'));
    }

    public function destroy(Task $task)
    {
        if ($task->user_id !== Auth::id()) {
            abort(403);
        }

        $task->delete();
        return redirect()->route('dashboard')->with('success', 'Tugas berhasil dihapus!');
    }

    /**
     * Menandai tugas sebagai selesai.
     */
    public function complete(Task $task)
    {
        // Pastikan tugas milik user yang login
        if ($task->user_id !== Auth::id()) {
            abort(403);
        }

        // Update status menjadi 'completed'
        $task->status = 'completed';
        $task->save();

        // FIX: Redirect ke dashboard, bukan kembali ke halaman sebelumnya.
        // Ini memastikan tombol "Kembali" di halaman lain berfungsi dengan benar.
        return redirect()->route('dashboard')->with('success', 'Tugas "' . $task->title . '" telah ditandai selesai!');
    }

    public function showReminders()
    {
        $user = Auth::user(); // Ambil data user yang sedang login

        $overdueTasks = $this->getOverdueTasks(true);
        $nearingDeadlineTasks = $this->getNearingDeadlineTasks(true);

        $reminderCount = $overdueTasks->total() + $nearingDeadlineTasks->total();

        // Kirim data reminderDays ke view
        return view('reminders', [
            'nearingDeadlineTasks' => $nearingDeadlineTasks,
            'overdueTasks' => $overdueTasks,
            'reminderCount' => $reminderCount,
            'reminderDays' => $user->reminder_days_before ?? 3
        ]);
    }

    private function getOverdueTasks($paginate = false)
    {
        // 1. Bangun query untuk tugas terlambat, gunakan timezone aplikasi
        $query = Task::where('user_id', Auth::id())
            ->where('deadline', '<', now()) // FIX: Menggunakan now() sesuai timezone app
            ->where('status', '!=', 'completed')
            ->orderBy('deadline');

        // 2. Eksekusi query
        return $paginate ? $query->paginate(10, ['*'], 'overdue_page') : $query->get();
    }

    private function getNearingDeadlineTasks($paginate = false)
    {
        $user = Auth::user();
        // Ambil preferensi user, jika tidak ada, default ke 3 hari
        $reminderDays = $user->reminder_days_before ?? 3;

        // 1. Bangun query untuk tugas mendekati deadline
        $query = Task::where('user_id', $user->id)
            ->where('status', '!=', 'completed')
            // FIX: Gunakan whereBetween, preferensi user, dan timezone app
            ->whereBetween('deadline', [now(), now()->addDays($reminderDays)])
            ->orderBy('deadline');

        // 2. Eksekusi query
        return $paginate ? $query->paginate(10, ['*'], 'nearing_page') : $query->get();
    }

    /**
     * Helper method untuk menerapkan filter
     */
    private function applyFilters($query, Request $request)
    {
        // Filter status
        if ($request->filled('status')) {
            $query->whereIn('status', $request->status);
        }

        // Filter mata kuliah
        if ($request->filled('course')) {
            $query->where('course', 'like', '%' . $request->course . '%');
        }

        // Filter kategori
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }
    }
}
