<!-- resources/views/auth/login.blade.php -->

@extends('layouts.app')

@section('content')
    <h2>Login</h2>

    <form action="{{ route('login') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" class="form-control">
        </div>

        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Login</button>
    </form>
@endsection
