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
        姓名: <input name="name" value="{{old('name')}}">
        性别: <input name="gender" value="{{old('gender')}}">
        年龄: <input name="old" value="{{old('old')}}">
        长寿原因: <input name="reason" value="{{old('reason')}}">
        <input type="submit"/>
    </form>
@endsection