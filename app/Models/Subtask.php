<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subtask extends Model
{

    protected $fillable = [
        'task_id',
        'title',
        'is_complete'
    ];
    // relasi ke table tasks
    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}
