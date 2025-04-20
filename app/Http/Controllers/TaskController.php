<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;


class TaskController extends Controller
{
    // Nampilin konten halaman mytasks
    public function index(Request $request)
    {
        $tasks = Task::where('user_id', Auth::id())
            ->orderBy('is_complete', 'asc')
            ->orderBy('priority', 'desc')
            ->orderBy('created_at', 'asc')
            ->get();

        // mencari deadline hari ini dan besok
        $reminderTask = Task::where('user_id', Auth::id())
            ->where('is_complete', false)
            ->whereDate('deadline', '<=', Carbon::now()->addDays(1))
            ->whereDate('deadline', '>=', Carbon::now())
            ->get();

        $taskLampau = Task::where('user_id', Auth::id())
            ->where('is_complete', false)
            ->whereDate('deadline', '<', Carbon::now()->endOfDay())
            ->get();

        return view('mytasks', compact('tasks', 'reminderTask', 'taskLampau'));
    }
    public function getReminderTask()
    {
        // mencari deadline hari ini dan besok
        $reminderTask = Task::where('user_id', Auth::id())
            ->where('is_complete', false)
            ->whereDate('deadline', '<=', Carbon::now()->addDays(1))
            ->whereDate('deadline', '>=', Carbon::now())
            ->get();

        $lateTask = Task::where('user_id', Auth::id())
            ->where('is_complete', false)
            ->whereDate('deadline', '<', Carbon::now()->endOfDay())
            ->get();

        return response()->json([
            'reminderTask' => $reminderTask,
            'lateTask' => $lateTask
        ]);
    }
    // create subtask
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
            'deadline' => 'required|date',
            'priority' => 'required|string|in:low,medium,high',
        ]);

        Task::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'deadline' => $request->deadline,
            'priority' => $request->priority,
            'is_complete' => false,
        ]);
        return redirect()->route('mytasks.page')->with('success', 'Task created successfully');
    }
    // button task status
    public function toggleStatus(Task $task)
    {
        $task->is_complete = !$task->is_complete;
        // jika status true maka waktu ditambahkan ke complete_at
        $task->complete_at = $task->is_complete ? now() : null;
        $task->save();

        $isReminder = !$task->is_complete && Carbon::parse($task->deadline)->isSameDay(Carbon::tomorrow());

        // untuk ajax respons
        return response()->json([
            'success' => true,
            'is_complete' => $task->is_complete,
            'is_reminder' => $isReminder
        ]);
    }
    // memunculkan form edit
    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }
    // update / edit task
    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'deadline' => 'required|date',
            'priority' => 'required|in:low,medium,high',
        ]);
        $task->update([
            'title' => $request->title,
            'description' => $request->description,
            'deadline' => $request->deadline,
            'priority' => $request->priority,
        ]);

        return response()->json(['message' => 'Task updated successfully']);
    }
    // hapus task (soft delete)
    public function destroy(string $id)
    {
        $task = Task::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();
        if ($task->complete_at) {
            // sudah selesai soft delete
            $task->delete();
        } else {
            // kalo belum selesai hard delete
            $task->forceDelete();
        }

        return redirect()->route('mytasks.page')->with('success', 'Task delete successfully');
    }
    // hapus task (hard delete)
    public function forceDelete(string $id)
    {
        $task = Task::withTrashed('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $task->forceDelete();


        return redirect()->route('history.page')->with('success', 'Task delete successfully');
    }
    // menampilkan task history
    public function showHistory()
    {
        $tasks = Task::withTrashed('user_id', Auth::id())
            ->whereNotNull('complete_at')
            ->get();

        return view('history', compact('tasks'));
    }
}
