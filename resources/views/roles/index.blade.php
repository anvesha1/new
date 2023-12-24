@extends('layouts.app')

@section('content')
    <h1>Roles</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <ul>
        @foreach ($roles as $role)
            <li>
                {{ $role->name }}

                <!-- Add a button to choose/assign the role -->
                <form method="POST" action="{{ route('roles.chooseRole', $role->id) }}" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn btn-primary btn-sm">Choose</button>
                </form>
            </li>
        @endforeach
    </ul>
@endsection
