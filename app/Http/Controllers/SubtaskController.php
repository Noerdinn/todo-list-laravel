<?php

namespace App\Http\Controllers;

use App\Models\Subtask;
use App\Models\Task;
use Illuminate\Http\Request;

class SubtaskController extends Controller
{
    // untuk menampilkan detail task
    public function show($id)
    {
        try {
            $task = Task::with('subtasks')->findOrFail($id);

            if (request()->wantsJson()) {
                return response()->json([
                    'id' => $task->id,
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

            // return view('tasks.detail', compact('task'));
            return view('tasks.detail', ['task' => $task]);
        } catch (\Exception $e) {
            \Log::error('Error fetching task details: ' . $e->getMessage());
            return response()->json(['error' => 'Terjadi kesalahan pada server'], 500);
        }
    }

    // tambah subtask baru
    public function storeSubtask(Request $request, Task $task)
    {
        try {

            // validasi inputan
            $request->validate([
                'title' => 'required|string|max:255',
            ]);

            // menambahkan subtask ke db dengan relasi task
            $subtask = $task->subtasks()->create([
                'title' => $request->title,
                'is_complete' => false,
            ]);

            // mengembalikan response dalam bentuk json
            return response()->json(
                [
                    'message' => 'Subtask created successfully',
                    'subtask' => $subtask,
                    'html' => view('tasks.subtask', compact('subtask'))->render(),
                ],
                201
            );
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error creating subtask',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    // togggle status subtask (selesai / belum)
    public function toggleStatusSubtask(Subtask $subtask)
    {
        try {
            if (!$subtask) {
                return response()->json(['message' => 'Subtask not found'], 404);
            }

            $subtask->update(['is_complete' => !$subtask->is_complete]);

            return response()->json([
                'message' => 'Subtask status updated successfully',
                'is_complete' => $subtask->is_complete,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error updating subtask status',
                'error' => $e->getMessage(),
            ], 500);
        }
    }


    // merender component subtask, digunakan di fungsi handleToggleSubtask()
    public function getSubtaskHtml(Subtask $subtask)
    {
        return view('tasks.subtask', compact('subtask'))->render();
    }

    // hapus subtask
    public function deleteSubtask(Subtask $subtask)
    {
        $subtask->delete();

        return response()->json([
            'message' => 'Subtask delete successfully',
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
