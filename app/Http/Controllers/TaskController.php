<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
// use Illuminate\Container\Attributes\Auth;
use Illuminate\Support\Facades\Auth;


class TaskController extends Controller
{
    // Nampilin konten halaman mytasks
    public function index(Request $request)
    {
        $tasks = Task::where('user_id', Auth::id())
            ->orderBy('priority', 'desc')
            ->orderBy('created_at', 'asc')
            ->get();

        return view('mytasks', compact('tasks'));
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

        // untuk ajax respons
        return response()->json(['success' => true, 'is_complete' => $task->is_complete]);
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
