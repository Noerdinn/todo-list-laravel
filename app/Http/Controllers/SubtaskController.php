<?php

namespace App\Http\Controllers;

use App\Models\Subtask;
use App\Models\Task;
use Illuminate\Http\Request;

class SubtaskController extends Controller
{
    // untuk menampilkan detail list
    public function show($id)
    {
        $task = Task::with('subtasks')->findOrFail($id);

        if (!$task) {
            return response()->json(['error' => 'Task not found'], 404);
        }

        return response()->json([
            'title' => $task->title,
            'description' => $task->description,
            'deadline' => $task->deadline,
            'is_complete' => $task->is_complete,
            'priority' => $task->priority,
            'subtasks' => $task->subtasks->map(function ($subtask) {
                return [
                    'id' => $subtask->id,
                    'title' => $subtask->title,
                    'is_complete' => $subtask->is_complete,
                ];
            }),
        ]);
    }

    // tambah subtak baru
    public function storeSubtask(Request $request, Task $task)
    {
        // $task = Task::findOrFail($taskId);

        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $subtask = $task->subtasks()->create([
            'title' => $request->title,
            'is_complete' => false,
        ]);

        $task->is_complete = $task->allSubtasksComplete();
        $task->save();

        return response()->json(
            [
                'subtask' =>
                [
                    'id' => $subtask->id,
                    'title' => $subtask->title,
                    'is_complete' => $subtask->is_complete,
                ],
                'task' =>
                [
                    'id' => $task->id,
                    'is_complete' => $task->is_complete,
                ]
            ],
            201
        );
    }

    // togggle status subtask (selesai / belum)
    public function toggleStatusSubtask(Subtask $subtask)
    {
        $subtask->update(['is_complete' => !$subtask->is_complete]);

        $task = $subtask->task;
        $task->is_complete = $task->allSubtasksComplete();
        $task->save();

        return response()->json([
            'message' => 'Subtask status updated successfully',
            'is_complete' => $subtask->is_complete,
            'task' => [
                'id' => $task->id,
                'is_complete' => $task->is_complete,
            ]
        ]);
    }

    // hapus subtask
    public function deleteSubtask(Subtask $subtask)
    {
        $task = $subtask->task;
        $subtask->delete();

        $task->is_complete = $task->allSubtasksComplete();
        $task->save();



        return response()->json([
            'message' => 'Subtask delete successfully',
            'task'    => [
                'id' => $task->id,
                'is_complete' => $task->is_complete,
            ]
        ]);
    }

    // public function addsubtask(Request $request, $task)
    // {
    //     $request->validate([
    //         'title' => 'required|string|max:255',
    //     ]);

    //     // Pastikan task ada
    //     $task = Task::findOrFail($task);

    //     // Simpan subtask
    //     $subtask = Subtask::create([
    //         'task_id' => $task->id,
    //         'title' => $request->title,
    //         'is_complete' => false,
    //     ]);

    //     return response()->json(['message' => 'Subtask added successfully', 'subtask' => $subtask]);
    // }
}
