@extends('layouts.main')

@section('title', 'LaravelExample')

@section('sidebar')
    <div>
        sidebar
    </div>
@endsection

@section('content')
    <h3>paging - user list</h3>

    @foreach ($users as $user)
        <li>{{ $user->name }}</li>
    @endforeach

    {{ $users->appends(['sort' => 'votes'])->links() }}
@endsection