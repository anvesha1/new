<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'task_heading',
        'description',
        'priority',
        'due_date',
    ];


    // In the Task model
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // app/Models/Task.php

    public function assignedUsers()
    {
        return $this->hasMany(AssignedTask::class);
    }


    public function assignedTasks()
    {
        return $this->hasMany(AssignedTask::class, 'task_id', 'id');
    }



}
