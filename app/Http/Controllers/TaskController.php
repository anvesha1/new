<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function assignedTasks()
    {
        // Retrieve the logged-in user with their assigned tasks
        $user = auth()->user();

        // Load the user's assigned tasks eagerly
        $user->load('assignedTasks.task');

        // You can customize the view name and data as per your application structure
        return view('users.assigned_tasks', compact('user'));
    }
}
