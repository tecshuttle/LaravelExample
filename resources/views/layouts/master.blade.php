<html>
<head>
    <title>Tom - @yield('title')</title>
    <style>
        .sidebar {
            width: 20%;
            float: left;
        }

        .container {
            width: 80%;
            float: left;
        }
    </style>
</head>
<body>

<div class="sidebar">
    @section('sidebar')
        这是主要的侧边栏。
    @show
</div>

<div class="container">
    @yield('content')
</div>

</body>
</html>