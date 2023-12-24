<?php

// app/Http/Controllers/AdminController.php

namespace App\Http\Controllers;

use App\Models\AssignedTask;
use App\Models\Role;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function createTask()
    {

            // Your existing logic for creating a task

            // Assign "admin" role to a user (example: user with ID 4)
            $user = User::find(2); // Replace 4 with the actual user ID you want to assign as admin
            $adminRole = Role::where('name', 'admin')->first();



            // Retrieve tasks from the database (adjust this query based on your model and database structure)
            $tasks = Task::all();

            // Pass tasks to the view
            return view('users.admin.create_task', ['tasks' => $tasks]);

    }


    public function viewUsers()
    {
        // Retrieve users with necessary fields from the database
        $users = User::select('id', 'name', 'email')->get();

        // Pass users to the view
        return view('users.admin.view_users', ['users' => $users]);
    }


    public function assignTask(Request $request)
    {
        // Validate the form data
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'task_id' => 'required|exists:tasks,id',
        ]);

        // Retrieve the task and user
        $task = Task::findOrFail($request->input('task_id'));
        $user = User::findOrFail($request->input('user_id'));

        // Perform the task assignment logic
        $assignedTask = new AssignedTask([
            'user_id' => $user->id,
            'task_id' => $task->id,
            'status' => 0, // You can set the default status as needed
        ]);

        // Save the assigned task to the database
        DB::transaction(function () use ($assignedTask, $task) {
            $assignedTask->save();
            // Optionally, update the task status here if needed
            $task->update(['status' => $assignedTask->status]);
        });

        // Redirect back with success message
        return redirect()->route('users.admin.view.task_assigned')->with('success', 'Task assigned successfully.');
    }

    // app/Http/Controllers/AdminController.php

    public function viewTaskAssigned()
    {
        // Retrieve assigned tasks
        $assignedTasks = Task::whereNotNull('user_id')->with('user')->get();

        // Retrieve users from the database (if needed)
        $users = User::select('id', 'name', 'email')->get();

        // Retrieve all tasks for the form
        $tasks = Task::all();

        // Pass assigned tasks, users, and tasks to the view
        return view('users.admin.view_task_assigned', ['assignedTasks' => $assignedTasks, 'users' => $users, 'tasks' => $tasks]);
    }


    public function submitTask(Request $request)
    {
        // Validate the form data
        $request->validate([
            'heading' => 'required|string|max:255',
            'description' => 'required|string',
            'priority' => 'required|string',
            'due_date' => 'required|date',
            // Add any other validation rules you need
        ]);

        // Create a new task
        $task = new Task();
        $task->user_id = auth()->id();
        $task->task_heading = $request->input('heading');
        $task->description = $request->input('description');
        $task->priority = $request->input('priority');
        $task->due_date = $request->input('due_date');

        // Save the task to the database
        $task->save();

        // Redirect back with success message
        return redirect()->route('users.admin.create_task')->with('success', 'Task submitted successfully.');
    }


    public function deleteTask($id): RedirectResponse
    {
        // Find the task
        $task = Task::findOrFail($id);

        // Perform soft delete
        $task->delete();

        // Redirect back with success message
        return redirect()->route('users.admin.create_task')->with('success', 'Task deleted successfully.');
    }
}
