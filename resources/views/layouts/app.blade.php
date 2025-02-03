<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Character encoding and viewport settings for responsive design -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shoe Store</title>

    <!-- Link to the external CSS file -->
    @vite(['resources/css/general_style.css']) <!-- Vite directive for CSS -->
    <!-- Stack for additional styles -->
    @stack('styles')

</head>
<body style="background-image: url('{{ asset('images/background.jpg') }}');">

    <!-- Header with logo and navigation links -->
    <header>
        <div class="header-content">
            <!-- Shoe Logo on the left side -->
            <div class="logo">
                <img src="{{ asset('images/logo.png') }}" alt="Shoe Store Logo" class="logo-img">
            </div>

            <!-- Navigation bar on the right side -->
            <nav>
                <a href="{{ route('home') }}">Home</a>

                <!-- Only show 'Create' link if the user is an admin -->
                @if(Auth::check() && Auth::user()->role === 'admin')
                    <a href="{{ route('create') }}">Create</a>
                @endif

                <a href="{{ route('search') }}">Search</a>

                <!-- Account Dropdown -->
                <div class="dropdown">
                    @if(Auth::check())
                        <!-- Show username if logged in -->
                        <a href="#" class="dropbtn">{{ Auth::user()->username }}</a>
                        <div class="dropdown-content">
                            <!-- Logout option -->
                            <a href="{{ route('logout') }}"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    @else
                        <!-- Show login option if not logged in -->
                        <a href="#" class="dropbtn">Account</a>
                        <div class="dropdown-content">
                            <a href="{{ route('login') }}">Login</a>
                        </div>
                    @endif
                </div>
            </nav>
        </div>
    </header>

    <!-- Main content section where page-specific content will be injected -->
    <main>
        @yield('content')
    </main>

    <!-- Footer section with a centered copyright message -->
    <footer>
        <div class="text-center">
            © {{ date('Y') }} Shoe Store. All rights reserved by Shoeshop.
        </div>
    </footer>

    <!-- Stack for additional scripts -->
    @stack('scripts')

</body>
</html>
