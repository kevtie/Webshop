<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">

                <div class="collapse navbar-collapse d-flex justify-content-between" id="navbarSupportedContent">
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        @foreach ($navbars as $navbarItem)
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route($navbarItem->route) }}">{{ $navbarItem->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                    <ul class="navbar-nav">
                      <li class="navbar-text">
                        <form method="post" action="{{ route('showSearch') }}">
                          @csrf
                        <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Search..." id="search" name="search">
                        <div class="input-group-append">
                        <input class="btn btn-outline-secondary" type="submit" value="search">
                        </div>
                      </div>
                    </form>
                      </li>
                      <li class="navbar-text">
                        <span class="navbar-text row mx-2">Welcome!<a href="{{route('profile', ['name' => Auth::user()->name])}}" style="text-decoration: none; color: inherit;">{{Auth::user()->name}}</a></span>
                      </li>
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
