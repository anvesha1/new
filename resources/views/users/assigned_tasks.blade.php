<!-- resources/views/users/assigned_tasks.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Assigned Tasks</h1>

        @if ($user->assignedTasks->count() > 0)
            <table class="table mt-4">
                <thead>
                <tr>
                    <th scope="col">S.N</th>
                    <th scope="col">Task Name</th>
                    <th scope="col">Assigned Date</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th> <!-- New column for the dropdown menu -->
                </tr>
                </thead>
                <tbody>
                @foreach ($user->assignedTasks as $assignedTask)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $assignedTask->task->task_heading }}</td>
                        <td>{{ $assignedTask->created_at->format('Y-m-d H:i:s') }}</td>
                        <td>{{ $assignedTask->status == 0 ? 'Pending' : 'Complete' }}</td>
                        <td>
                            @if($assignedTask->status == 0)
                                <!-- Display dropdown only if status is pending -->
                                <form action="{{ route('users.assigned_tasks.update_status', ['taskId' => $assignedTask->id]) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <select name="status" class="form-control" onchange="this.form.submit()">
                                        <option value="0" {{ $assignedTask->status == 0 ? 'selected' : '' }}>Pending</option>
                                        <option value="1" {{ $assignedTask->status == 1 ? 'selected' : '' }}>Complete</option>
                                    </select>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <p>No tasks assigned yet.</p>
        @endif
    </div>
@endsection
