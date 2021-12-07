<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Fast Business</title>
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>

<body>

    @if (Route::has('login'))
    <nav class="guest-navigation">
        @auth
        <a href="{{ url('/dashboard') }}" class="guest-nav-link">Dashboard</a>
        @else
            @if (Route::current()->getName() == "register")
                <a href="{{ route('login') }}" class="guest-nav-link">Log in</a>
            @endif

            @if (Route::current()->getName() == "login")
                <a href="{{ route('register') }}" class="guest-nav-link">Register</a>
            @endif
        @endauth
    </nav>
    @endif

    <div class="container">
        @yield('content')
    </div>
</body>

</html>