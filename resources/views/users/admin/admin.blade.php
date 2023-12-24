@extends('Layouts.app')

@section('content')
    <div class="container text-center">
        <h1>Welcome Admin</h1>
        <div class="btn-container">
            <a href="{{ route('users.admin.create_task') }}">
                <button type="button" class="btn btn-primary">Create Task</button>
            </a>
            <a href="{{ route('users.admin.view_users') }}">
                <button type="button" class="btn btn-primary">View Users</button>
            </a>
            <a href="{{ route('users.admin.view.task_assigned') }}">
                <button type="button" class="btn btn-primary">View Tasks Assigned</button>
            </a>

<div>
    </div>
@endsection
