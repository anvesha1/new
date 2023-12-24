<!-- resources/views/users/member.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Hello</h1>
        <p>View your assigned tasks:</p>
        <a href="{{ route('assigned_tasks.blade.php') }}" class="btn btn-primary">Assigned Tasks</a>
    </div>
@endsection
