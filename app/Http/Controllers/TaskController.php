<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
// use Illuminate\Container\Attributes\Auth;
use Illuminate\Support\Facades\Auth;

use function Illuminate\Foundation\Configuration\respond;
use function Pest\dd;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // Nampilin konten halaman mytasks
    public function index(Request $request)
    {
        $tasks = Task::where('user_id', Auth::id())->orderByRaw("CASE WHEN priority = 'high' THEN 1 ELSE 2 END")
            ->orderBy('deadline', 'desc')->get();

        $editTask = null;
        if ($request->has('edit')) {
            $editTask = Task::where('id', $request->edit)->where('user_id', Auth::id())->first();
        }

        return view('mytasks', compact('tasks'));
    }

    /**
     * Store a newly created resource in storage.
     */
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

    public function toggleStatus(Task $task)
    {
        $task->is_complete = !$task->is_complete;
        $task->save();

        // untuk ajax respons
        return response()->json(['success' => true, 'is_complete' => $task->is_complete]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $task = Task::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
            'deadline' => 'nullable|date',
            'priority' => 'required|string|in:low,medium,high',
        ]);

        $task->update($request->all());

        return redirect()->route('mytasks.page')->with('success', 'Task Update Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $task = Task::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $task->delete();

        return redirect()->route('mytasks.page')->with('success', 'Task delete successfully');
    }

    // menampilkan task history
    public function showHistory()
    {
        $tasks = Task::where('user_id', Auth::id())->get();

        return view('history', compact('tasks'));
    }
}
