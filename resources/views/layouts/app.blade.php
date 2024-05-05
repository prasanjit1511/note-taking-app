<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Note Taking App</title>
        <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.2/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    </head>
    <body class="bg-light">
        <div class="container-fluid shadow-lg header">
            <div class="container">
                <div class="d-flex justify-content-between">
                    <h1 class="text-center">
                    
                        @if (Auth::check())
                        <a href="{{ route('account.list') }}" class="h3 text-white text-decoration-none">Note Taking App</a>
                        @else
                        <a href="{{ route('account.login') }}" class="h3 text-white text-decoration-none">Note Taking App</a>
                        @endif
                    </h1>
                    <div class="d-flex align-items-center navigation">

                        @if (Auth::check())
                        <a href="{{ route('account.list') }}" class="text-white">Welcome, {{ Auth::user()->name }} , <a href="{{ route('account.logout') }}" class="text-white"><b>Logout</b></a>
                        @else
                        <a href="{{ route('account.login') }}" class="text-white">Login</a>
                        <a href="{{ route('account.register') }}" class="text-white ps-2">Register</a>
                        @endif
                        
                    </div>
                </div>
            </div>
        </div>
        

        @yield('main')

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    </body>
</html>