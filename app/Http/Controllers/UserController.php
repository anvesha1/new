<?php

namespace App\Http\Controllers;

use App\Models\AssignedTask;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
class UserController extends Controller
{


    public function admin()
    {
        // Logic and view for admin role
        return view('users.admin.admin');
    }

    public function manager()
    {
        // Logic and view for manager role
        return view('users.manager');
    }

    public function member()
    {
        // Retrieve the logged-in user
        $user = auth()->user();

        return view('users.member', compact('user'));
    }


    // UserController.php

    // UserController.php
    public function assignedTasks()
    {


        // Retrieve the logged-in user with their assigned tasks
        $user = auth()->user();

        // Load the user's assigned tasks eagerly
        $user->load('assignedTasks.task');

        // You can customize the view name and data as per your application structure
        return view('users.assigned_tasks', compact('user'));
    }


    public function updateTaskStatus(Request $request, $taskId)
    {
        // Validate the request

        \Illuminate\Support\Facades\Log::info('Request Data:', $request->all());

        $request->validate([
            'status' => 'required|in:0,1', // Ensure the status is either 0 or 1
        ]);

        // Find the assigned task by ID
        $assignedTask = AssignedTask::find($taskId);

        // Check if the assigned task exists
        if (!$assignedTask) {
            abort(404, 'Assigned task not found');
        }

        // Update the assigned task status
        $assignedTask->status = $request->input('status');
        $assignedTask->save();

        // Update the status in the tasks table as well
        $assignedTask->task->update(['status' => $request->input('status')]);

        return redirect()->back()->with('success', 'Task status updated successfully');
    }

    public function memberTasks()
    {
        // Retrieve the logged-in user
        $user = auth()->user();

        // Load the user's assigned tasks eagerly
        $user->load('assignedTasks.task');

        // Pass the user to the view
        return view('users.member', compact('user'));
    }




// Add or update other methods as needed


//    public function showAllAssignedTasks()
//    {
//        // Retrieve all users with their assigned tasks
//        $users = User::with('assignedTasks.task')->get();
//
//        // Pass the users to the view
//        return view('users.member', compact('users'));
//    }


//    public function showAssignedTasks()
//    {
//        // Retrieve the logged-in user with their assigned tasks
//        $user = auth()->user();
//
//        return view('tasks.assigned', compact('user'));
//    }


    // UserController.php
//    public function showMemberTasks()
//    {
//        // Retrieve the logged-in user
//        $users = User::with('assignedTasks.task')->get();
//
//        // Pass the users to the view
//        return view('users.member', ['users' => $users]);
//    }
}



