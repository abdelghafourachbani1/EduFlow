<!DOCTYPE html>
<head>
    <title>EduFlow</title>
</head>
<body>
    <nav>
        <a href="/">Home</a>
        <a href="/login">Login</a>
        <a href="/register">Register</a>
    </nav>
    <hr>
    @yield('content')

    <script src="{{asset(js/app.js)}}"></script>
</body>