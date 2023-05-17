<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Custom Auth Laravel')</title>
    @vite('resources/css/app.css')
</head>

<body>
    @if (auth()->check())
        @include('include.header')
    @endif
    @yield('content')
</body>

</html>
