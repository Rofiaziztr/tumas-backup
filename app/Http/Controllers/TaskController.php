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

        $query = Task::where('user_id', Auth::id());

        // Filter berdasarkan status
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        // Filter berdasarkan mata kuliah
        if ($request->has('course') && $request->course != '') {
            $query->where('course', 'like', '%' . $request->course . '%');
        }

        $tasks = $query->orderBy('deadline')->get();

        // Ambil pengingat
        $reminders = Task::where('user_id', Auth::id())
            ->where('deadline', '<=', now()->addDays(3))
            ->where('status', '!=', 'completed')
            ->get();

        // Hitung jumlah reminder untuk navbar
        $reminderCount = Task::where('user_id', Auth::id())
            ->where('deadline', '<=', now()->addDays(3))
            ->where('status', '!=', 'completed')
            ->count();

        return view('dashboard', compact('tasks', 'reminders', 'reminderCount'));
    }

    public function showReminders()
    {
        $reminders = Task::where('user_id', Auth::id())
            ->where('deadline', '<=', now()->addDays(3))
            ->where('status', '!=', 'completed')
            ->orderBy('deadline')
            ->get();

        $reminderCount = $reminders->count();

        return view('reminders', compact('reminders', 'reminderCount'));
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

    public function destroy(Task $task)
    {
        if ($task->user_id !== Auth::id()) {
            abort(403);
        }

        $task->delete();
        return redirect()->route('dashboard')->with('success', 'Tugas berhasil dihapus!');
    }
}
