<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// database/seeders/AssignedTasksSeeder.php

use App\Models\AssignedTask;

class AssignedTasksSeeder extends Seeder
{

    public function run()
    {
        // Get all users and tasks
        $users = \App\Models\User::all();
        $tasks = \App\Models\Task::all();

        // Loop through users and assign a random task to each
        foreach ($users as $user) {
            // Get a random task
            $task = $tasks->random();

            // Create an assigned task for the user
            AssignedTask::create([
                'user_id' => $user->id,
                'task_id' => $task->id,
                'status' => 0, // You can set the default status as needed
            ]);

            }

}

}


