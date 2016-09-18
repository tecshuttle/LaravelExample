@extends('layouts.master')

@section('title', 'LaravelExample')

@section('sidebar')
    <div>
        sidebar
    </div>
@endsection

@section('content')
    <h3>Input Example</h3>

    <form method="post">
        name: <input name="name" value="{{old('name')}}">
        old: <input name="old" value="{{old('old')}}">
        <input type="submit"/>
    </form>
@endsection