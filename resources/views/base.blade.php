<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>FlixTick</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

</head>

<body class="antialiased">
    <nav class="navbar navbar-expand-sm navbar-light bg-light mb-2">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ url('/') }}">FlixTick</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <!-- TODO: convert nav links to its own component -->
                    <a class="nav-link @if(url()->current() === url('/')) active @endif" aria-current="page" href="{{ url('/') }}">Home</a>
                    <a class="nav-link @if(url()->current() === url('about')) active @endif" aria-current="page" href="{{ url('about') }}">About</a>
                    @if(auth()->check())
                    <form action="{{ url('auth/logout') }}" method="post">
                        @csrf
                        <button type="submit" class="btn btn-link">Sign Out</button>
                    </form>
                    <span class="navbar-text">Hello {{ auth()->user()->username }}</span>
                    @else
                    <a class="nav-link @if(url()->current() === url('auth/login')) active @endif" href="{{ url('auth/login') }}">Log In</a>
                    <a class="nav-link @if(url()->current() === url('auth/signup')) active @endif" href="{{ url('auth/signup') }}">Sign Up</a>
                    @endif
                </div>
            </div>

        </div>
    </nav>
    <div class="container">
        @if(session('flash'))
        <div class="alert alert-primary">
            {{ session('flash') }}
        </div>
        @endif

        @if(session('flash-success'))
        <div class="alert alert-success">
            {{ session('flash-success') }}
        </div>
        @endif

        @if(session('flash-warning'))
        <div class="alert alert-warning">
            {{ session('flash-warning') }}
        </div>
        @endif

        @if(session('flash-danger'))
        <div class="alert alert-danger">
            {{ session('flash-danger') }}
        </div>
        @endif

        @yield('content')
    </div>

    <!-- Bootstrap JS and Popper bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>

</html>