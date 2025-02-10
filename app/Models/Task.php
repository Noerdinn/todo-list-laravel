<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $table = 'tasks';

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'due_date',
        'category',
        'priority',
        'status',
    ];

    // relasi ke table user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // relasi ke table subtasks
    public function subtasks()
    {
        return $this->hasMany(Subtask::class);
    }

    // fungsi untuk mengecek semua status dari subtask 
    public function allSubtasksComplete()
    {
        return $this->subtasks->every(function ($subtask) {
            return $subtask->is_complete;
        });
    }
}
