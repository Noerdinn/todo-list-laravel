<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Carbon\Carbon;
// use Illuminate\Container\Attributes\Auth;
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
            ->whereDate('deadline', '<=', Carbon::now()->addDays(1))
            ->whereDate('deadline', '>=', Carbon::now())
            ->get();

        // dd([
        //     'carbon_tomorrow' => Carbon::tomorrow()->toDateString(),
        //     'task_deadlines' => Task::where('user_id', Auth::id())->pluck('deadline'),
        // ]);

        return view('mytasks', compact('tasks', 'reminderTask'));
    }

    // create subtask
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
            'deadline' => 'nullable|date',
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
            'deadline' => 'nullable|date',
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

    // hapus task
    public function destroy(string $id)
    {
        $task = Task::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $task->delete();

        return redirect()->route('mytasks.page')->with('success', 'Task delete successfully');
    }

    // menampilkan task history
    public function showHistory()
    {
        $tasks = Task::where('user_id', Auth::id())->where('is_complete', true)->get();

        return view('history', compact('tasks'));
    }
}
