<!-- resources/views/users/admin/assign_task.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Assign Task</h1>

        {{-- Form to assign tasks --}}
        <div class="mb-4">
            <form action="{{ route('users.admin.assignTask') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="user_id">Select User:</label>
                    <select name="user_id" class="form-control" required>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="task_id">Select Task:</label>
                    <select name="task_id" class="form-control" required>
                        @foreach ($tasks as $task)
                            <option value="{{ $task->id }}">{{ $task->task_heading }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Assign Task</button>
            </form>
        </div>

        {{-- Display assigned tasks --}}
        <h2>Assigned Tasks</h2>
        @if ($assignedTasks->count() > 0)
            <ul>
                @foreach ($assignedTasks as $assignedTask)
                    <li>{{ $assignedTask->task_heading }} assigned to {{ $assignedTask->user->name }}</li>
                @endforeach
            </ul>
        @else
            <p>No tasks assigned yet.</p>
        @endif
    </div>
@endsection
