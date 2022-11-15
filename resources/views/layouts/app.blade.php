<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<header>
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
                    <ul class="navbar-nav align-items-center">
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
                        <span class="navbar-text flex row mx-2">
                          @if(Auth::check() == true)
                            <div class="dropdown">
                              <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                {{Auth::user()->name}}
                              </button>
                              <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <li><a class="dropdown-item" href="{{route('profile', ['name' => Auth::user()->name])}}">Profile</a></li>
                                @if(Auth::user()->role_id === 1)
                                  <li><a class="dropdown-item" href="{{route('admin')}}">Admin</a></li>
                                @endif
                                <li><a class="dropdown-item" href="{{route('settings')}}">Settings</a></li>
                                <li><a class="dropdown-item" href="{{route('logout')}}">logout</a></li>
                              </ul>
                            </div>
                            @else
                            <div class="show">
                              <a class="btn" href="{{route('login')}}">Login</a>
                            </div>
                            @endif
                        </span>

                      </li>
                    </ul>
                </div>
            </div>
        </nav>

    </div>
</header>
<main class="py-4">
  @yield('content')
</main>
</html>
