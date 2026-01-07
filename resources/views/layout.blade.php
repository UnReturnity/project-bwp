<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BWP Bakery</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@300;400;700&display=swap" rel="stylesheet">

    <style>
        /* 1. THE BAKERY BACKGROUND */
        body {
            /* A warm cream color (looks like dough) */
            background-color: #FFF8E7;
            /* The Fancy Font */
            font-family: 'Merriweather', serif;
            color: #5A3A22; /* Dark Coffee Color for text */
        }

        /* 2. THE NAVBAR (Bread Crust Color) */
        .navbar-bakery {
            background-color: #8B4513 !important; /* SaddleBrown */
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        /* 3. BUTTONS (Override the default blue buttons) */
        .btn-primary {
            background-color: #D2691E; /* Chocolate Color */
            border-color: #D2691E;
        }
        .btn-primary:hover {
            background-color: #A0522D; /* Darker Chocolate on hover */
        }

        /* 4. NAVBAR LINKS */
        .nav-link {
            color: #FFDEAD !important; /* NavajoWhite (Light cream) */
        }
        .nav-link:hover {
            color: #fff !important; /* White on hover */
        }

        /* Custom Text Colors for Admin Links */
        .text-admin-dashboard { color: #ff9999 !important; }
        .text-admin-report { color: #99ff99 !important; }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark navbar-bakery">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">🍞 BWP Bakery</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">

                    <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Home</a></li>

                    @auth
                        @if(Auth::user()->is_admin)
                            <li class="nav-item">
                                <a class="nav-link fw-bold text-admin-dashboard" href="{{ route('admin.dashboard') }}">🔥 Dashboard</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link fw-bold text-admin-report" href="{{ route('admin.report') }}">📊 Report</a>
                            </li>

                        @else
                            <li class="nav-item">
                                <a class="nav-link fw-bold" href="{{ route('cart.show') }}">My Cart</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('history.index') }}">History</a>
                            </li>
                        @endif

                        <li class="nav-item ms-2">
                            <span class="nav-link" style="color: #fff !important;">Hello, {{ Auth::user()->name }}!</span>
                        </li>

                        <li class="nav-item">
                            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-link nav-link" style="text-decoration: none;">Logout</button>
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

    <div class="container py-4">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
