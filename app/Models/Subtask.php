<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subtask extends Model
{
    protected $fillable = [
        'task_id',
        'title',
        'is_complete'
    ];

    // casting field is_complete agar menjadi boolean
    protected $casts = [
        'is_complete' => 'boolean'
    ];

    // relasi ke table tasks
    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}
