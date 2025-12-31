<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BWP Bakery</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* Optional: Make the background slightly grey so white cards pop out */
        body { background-color: #f8f9fa; }
        .navbar { margin-bottom: 20px; }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">🍞 BWP Bakery</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
    <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Home</a></li>

    @auth
        <li class="nav-item">
            <span class="nav-link text-warning">Hello, {{ Auth::user()->name }}!</span>
        </li>
        <li class="nav-item">
            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                @csrf
                <button class="btn btn-link nav-link" style="text-decoration: none;">Logout</button>
            </form>
        </li>
    @else
        <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Register</a></li>
    @endauth
</ul>
            </div>
        </div>
    </nav>

    <div class="container">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
