@extends('layouts.main')

@section('title', 'LaravelExample')

@section('sidebar')
    <div>
        sidebar
    </div>
@endsection

@section('content')
    <h3>Input Example</h3>

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="post" action="/store">
        name: <input name="name" value="{{old('name')}}">
        old: <input name="old" value="{{old('old')}}">
        reason: <input name="reason" value="{{old('reason')}}">
        <input type="submit"/>
    </form>
@endsection