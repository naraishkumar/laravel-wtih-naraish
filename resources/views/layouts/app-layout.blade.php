<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Laravel With Naraish</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
</head>
<body>

    @foreach (['success', 'error', 'warning', 'info'] as $type)
        @if(session($type))
            <div class="alert alert-{{ $type }} alert-dismissible fade show mt-3 mx-3" role="alert">
                {{ session($type) }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    @endforeach

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Laravel</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <!-- Empty for now -->
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('app.home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact</a>
                    </li>

                    <!-- Dropdown for User -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            @auth
                                {{ Auth::user()->name }}
                            @else
                                Account
                            @endauth
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            @auth
                                <li><a class="dropdown-item" href="#">Profile</a></li>
                                <li><a class="dropdown-item" href="#">Settings</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <a class="dropdown-item" href="#"
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>
                                </li>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            @else
                                <li><a class="dropdown-item" href="{{ route('login') }}">Login</a></li>
                                <li><a class="dropdown-item" href="{{ route('register') }}">Register</a></li>
                            @endauth
                        </ul>
                    </li>

                    <!-- Search Bar -->
                    <li class="nav-item d-none d-md-block">
                        <form class="d-flex" action="#" method="GET">
                            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                            <button class="btn btn-light" type="submit">Search</button>
                        </form>
                    </li>
                </ul>

            </div>
        </div>
    </nav>

    <!-- Main content area -->
    <header>
        <div class="container py-4">
            <h1 class="display-4 text-center">Welcome to the User Home Page!</h1>
            <p class="lead text-center">This is the main content of the app. You can add more sections here as needed.</p>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <footer class="bg-dark text-white text-center py-3 mt-5">
        <p>&copy; 2025 UserApp. All Rights Reserved.</p>
    </footer>

    <!-- Bootstrap JS (optional, for dropdowns, etc.) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gybP7Y8kfjK2O3Hf37nZpfsBzVck3d5xyFfakfpLVV4xooClEC" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-cn7l7gDP1mXn6M+X5orOHBxkV6HfsGhCzv2XkPksL5p6g5fN6A8j7D7c7kwHBo5d" crossorigin="anonymous"></script>

</body>
</html>
