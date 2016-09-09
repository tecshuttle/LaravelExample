@extends('layouts.master')

@section('title', 'LaravelExample')

@section('sidebar')
    @parent

    <div>
        sidebar
    </div>
@endsection

@section('content')
    <h3>变量的使用</h3>
    <p>目前的 UNIX 时间戳为 {{ $time }}。
    <p>目前的 UNIX 时间戳为 {{ time() }}。
    <p>目前的 UNIX 时间戳为 @{{ time() }}。
    <p>My name is {{ $name or 'Default' }}.
    <p>My name is {{ $html or 'html' }}.
    <p>My name is {!! $html or 'html' !!}.

    {{-- @符号如何显示 --}}

    <h3>include</h3>
    @include('usersList')

    <h3>each</h3>
    @each('userInfo', $users, 'name')

    {{-- 服务注入 --}}

    <h3>自定义模板指令</h3>
    @datetime(new Datetime())
@endsection