<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignedTask extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'task_id', 'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function task()
    {
        return $this->belongsTo(Task::class);
    }

//    protected static function booted()
//    {
//        static::updating(function ($assignedTask) {
//            $assignedTask->task->update(['status' => $assignedTask->status]);
//        });
//    }

}
