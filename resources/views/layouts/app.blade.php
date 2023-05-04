<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>AlumnConnect</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <style>
        body {
            background-image: url('http://minsu.edu.ph/template/images/slides/slides_2.jpg');
            background-repeat: no-repeat;
            background-size: cover;
            background-position: top center;
            border-top-right-radius: 8px;
            border-top-left-radius: 8px;
            height: 100vh !important;
        }
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet@1.7.1/dist/leaflet.css" />
    <script src="https://cdn.jsdelivr.net/npm/leaflet@1.7.1/dist/leaflet.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
    <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head>

<body>
    <div id="app" style="overflow-y: scroll; height:100vh">
        <nav class="navbar navbar-expand-md navbar-light bg-success shadow-sm">
            <div class="container">
                <a class="navbar-brand text-white " onclick="updateTitle('Welcome to MinSU-AlumnConnect')"
                    href="{{ url('/home') }}">
                    AlumnConnect
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link text-white" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link text-white" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#"
                                    role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                    v-pre>
                                    {{ Auth::user()->name }}
                                </a>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                    <a class="dropdown-item" href="{{ route('userprofile.index') }}">
                                        Profile
                                    </a>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <div class="jumbotron jumbotron-fluid text-white">
            <div class="container">
                <h1 class="display-4 text-center" id="page-title">Welcome to MinSU-AlumConnect</h1>
                <p class="lead text-center">Discover the latest job opportunities and announcements.</p>
                <div class="d-flex justify-content-center mt-4">
                    @if (!auth()->user()->approved)
                        <p class="text-center">Please wait for admin approval.</p>
                    @else
                        @if (auth()->user()->hasRole('admin'))
                            <a href="{{ route('jobs.index') }}" class="btn btn-outline-light mx-3 mb-4"
                                onclick="updateTitle('Job Offers')" id="job-offers-link">Job Offers</a>
                            <a href="{{ route('userprofile.userIndex') }}" class="btn btn-outline-light mx-3 mb-4"
                                onclick="updateTitle('Users')" id="users-link">Users</a>
                            <a href="{{ route('socialmedia.index') }}" class="btn btn-outline-light mx-3 mb-4"
                                onclick="updateTitle('AlumnConnect')" id="alumnconnect-link">AlumnConnect</a>
                            <a href="{{ route('admin.pending-users') }}" class="btn btn-outline-light mx-3 mb-4"
                                onclick="updateTitle('Pending Users')" id="pending-users-link">View Pending Users</a>
                            <a href="{{ route('announcements.index') }}" class="btn btn-outline-light mx-3 mb-4"
                                onclick="updateTitle('Announcements')" id="announcements-link">Announcements</a>
                                <a href="{{ route('messages.index') }}" class="btn btn-outline-light mx-3 mb-4"
                                onclick="updateTitle('Message')" id="announcements-link">Chat Room</a>
                        @endif
                        @if (auth()->user()->hasRole('alumni'))
                            <a href="{{ route('jobs.index') }}" class="btn btn-outline-light mx-3 mb-4"
                                onclick="updateTitle('Job Offers')" id="job-offers-link">Job Offers</a>
                            <a href="{{ route('socialmedia.index') }}" class="btn btn-outline-light mx-3 mb-4"
                                onclick="updateTitle('AlumnConnect')" id="alumnconnect-link">AlumnConnect</a>
                            <a href="{{ route('announcements.index') }}" class="btn btn-outline-light mx-3 mb-4"
                                onclick="updateTitle('Announcements')" id="announcements-link">Announcements</a>
                        @endif
                        @if (auth()->user()->hasRole('employer'))
                            <a href="{{ route('jobs.index') }}" class="btn btn-outline-light mx-3 mb-4"
                                onclick="updateTitle('Job Offers')" id="job-offers-link">Job Offers</a>
                            <a href="{{ route('userprofile.userIndex') }}" class="btn btn-outline-light mx-3 mb-4"
                                onclick="updateTitle('Users')" id="users-link">Users</a>
                        @endif
                    @endif
                </div>
            </div>
        </div>

        <script>
            function updateTitle(newTitle) {
                document.getElementById("page-title").innerHTML = newTitle;
                localStorage.setItem("page-title", newTitle);
            }

            document.addEventListener("DOMContentLoaded", function() {
                var pageTitle = localStorage.getItem("page-title");
                if (pageTitle !== null) {
                    document.getElementById("page-title").innerHTML = pageTitle;
                }
            });
        </script>



        <main class="py-4 container">
            @yield('content')
        </main>

</body>


</html>
