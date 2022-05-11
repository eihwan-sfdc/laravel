<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ secure_asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ secure_asset('css/app.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script type="text/javascript" src="//code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Evergage -->
    <script type="text/javascript" src="//cdn.evgnet.com/beacon/{{config('app.EVERGAGE_ACCOUNT')}}/{{config('app.EVERGAGE_DATASET')}}/scripts/evergage.min.js"></script>

    <!-- Einstein Recommendation -->
    <script type="text/javascript" async src="//{{config('app.MID')}}.collect.igodigital.com/collect.js"></script>
</head>
@guest
<script>
    var _etmc = [];
    _etmc.push(["setOrgId", "{{config('app.MID')}}"]);
    _etmc.push(["trackPageView"]);
</script>
@else
<script>
    var _etmc = [];
    _etmc.push(["setOrgId", "{{config('app.MID')}}"]);
    _etmc.push(["setUserInfo", {
        "email": "{{ Auth::user()->email }}"
    }]);
    _etmc.push(["trackPageView"]);
</script>
@endguest

<body>
    <div id="app">
        <header class="header">
            <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm ">
                <div class="container">
                    <a class="navbar-brand" href="{{ secure_url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav mr-auto">

                        </ul>

                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto">
                            <!-- Authentication Links -->
                            @guest
                            @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @endif

                            @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                            @endif
                            @else
                            <a class="dropdown-item" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>
                            <span class="logged-in-user-email" style="display:none">
                                {{ Auth::user()->email }}
                            </span>
                            <a class="dropdown-item" href="/cart" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ __('CART') }}
                            </a>
                            <a class="dropdown-item" href="/static" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ __('STATIC') }}
                            </a>
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>

                            @endguest
                        </ul>
                    </div>
                </div>
            </nav>
        </header>

        <main class="py-4">
            @yield('content')
        </main>

        <footer class="footer">
            <div class="container">
                <div class="footer-brand">
                </div>
                this website is created for private study and no order will be processed.
            </div>
        </footer>


    </div>

    @yield('javascript')

</body>

</html>