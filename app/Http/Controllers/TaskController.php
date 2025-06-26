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

        // Ambil tugas overdue dan nearing deadline
        $overdueTasks = $this->getOverdueTasks();
        $nearingDeadlineTasks = $this->getNearingDeadlineTasks();

        // Query tugas dengan filter
        $query = Task::where('user_id', Auth::id())
            ->whereNotIn('id', $overdueTasks->pluck('id')); // Hindari duplikasi dengan overdue

        $this->applyFilters($query, $request);
        $tasks = $query->orderBy('deadline')->get();

        // Hitung jumlah reminder
        $reminderCount = $nearingDeadlineTasks->count() + $overdueTasks->count();

        return view('dashboard', compact('tasks', 'nearingDeadlineTasks', 'overdueTasks', 'reminderCount'));
    }

    public function showReminders()
    {
        $overdueTasks = $this->getOverdueTasks();
        $nearingDeadlineTasks = $this->getNearingDeadlineTasks();
        $reminderCount = $nearingDeadlineTasks->count() + $overdueTasks->count();

        return view('reminders', compact('nearingDeadlineTasks', 'overdueTasks', 'reminderCount'));
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

    private function getOverdueTasks()
    {
        return Task::where('user_id', Auth::id())
            ->where('deadline', '<', now()->utc())
            ->where('status', '!=', 'completed')
            ->orderBy('deadline')
            ->get();
    }

    /**
     * Helper method untuk mendapatkan tugas mendekati deadline
     */
    private function getNearingDeadlineTasks()
    {
        return Task::where('user_id', Auth::id())
            ->where('deadline', '>=', now()->utc())
            ->where('deadline', '<=', now()->utc()->addDays(3))
            ->where('status', '!=', 'completed')
            ->orderBy('deadline')
            ->get();
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
