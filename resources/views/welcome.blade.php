@extends('layouts.master')

@section('title', 'LaravelExample')

@section('sidebar')
    @parent

    <div>
        sidebar
    </div>
@endsection

@section('content')
    <p>这是主要内容

    <p>目前的 UNIX 时间戳为 {{ time() }}。
    <p>目前的 UNIX 时间戳为 @{{ time() }}。
    <p>My name is {{ $name or 'Default' }}.
    <p>My name is {{ $html or 'html' }}.
@endsection