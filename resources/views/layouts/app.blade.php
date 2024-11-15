<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer',"{{config('app.GTM_ID')}}");</script>
    <!-- End Google Tag Manager -->
    

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id={{config('app.GA4_MEASUREMENT_ID')}}"></script>

    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag("js", new Date());

    gtag("config", "{{config('app.GA4_MEASUREMENT_ID')}}");
    </script>



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


    <script type="text/javascript" async src="{{ secure_asset('js/test.js') }}" rel="stylesheet"></script>
    
    <!-- Evergage 
    <script type="text/javascript" async src="//cdn.evgnet.com/beacon/{{config('app.EVERGAGE_ACCOUNT')}}/{{config('app.EVERGAGE_DATASET')}}/scripts/evergage.min.js"></script>
    It's not possible to use MCP SiteMap and Data Cloud SiteMap in the same site.
    -->

    <!-- Data CloudDmlghk Web Integration -->
    <script type="text/javascript" src="https://cdn.c360a.salesforce.com/beacon/c360a/{{config('app.DC_WEBSITE_ID')}}/scripts/c360a.min.js"></script>
    
    <!-- Einstein Recommendation -->
    <script type="text/javascript" async src="//{{config('app.MID')}}.collect.igodigital.com/collect.js"></script>

</head>
<script language="javascript">
        //Set the number of days before your cookie should expire
        var ExpireDays = 90;
        //Do not change anything below this line
        qstr = document.location.search;
        qstr = qstr.substring(1, qstr.length);
        function SetCookie(cookieName, cookieValue, nDays) {
            var today = new Date();
            var expire = new Date();
            if (nDays == null || nDays == 0) nDays = 1;
            expire.setTime(today.getTime() + 3600000 * 24 * nDays);
            document.cookie = cookieName + "=" + escape(cookieValue) + "; expires=" + expire.toGMTString() + "; path=/";
        }
        thevars = qstr.split("&");
        for (i = 0; i < thevars.length; i++) {
            cookiecase = thevars[i].split("=");
            switch (cookiecase[0]) {
                case "sfmc_sub":
                    sfmc_sub = cookiecase[1];
                    SetCookie("SubscriberID", sfmc_sub, ExpireDays);
                    break;
                case "e":
                    e = cookiecase[1];
                    SetCookie("EmailAddr_", e, ExpireDays);
                    break;
                case "j":
                    j = cookiecase[1];
                    SetCookie("JobID", j, ExpireDays);
                    break;
                case "l":
                    l = cookiecase[1];
                    SetCookie("ListID", l, ExpireDays);
                    break
                case "jb":
                    jb = cookiecase[1];
                    SetCookie("BatchID", jb, ExpireDays);
                    break;
                case "u":
                    u = cookiecase[1];
                    SetCookie("UrlID", u, ExpireDays);
                    break;
                case "mid":
                    mid = cookiecase[1];
                    SetCookie("MemberID", mid, ExpireDays);
                    break;
                default:
                    break;
            }

        }
    </script>
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
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id={{config('app.GTM_ID')}}"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    <div id="app">
        <header class="site-header">
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
                            <a class="dropdown-item" href="/wishlist" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ __('WISHLIST') }}
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
        <div class="rec1"></div>
        <div class="rec2"></div>
        <div class="rec3"></div>

        <footer class="footer">
            <div class="container">
                <form class="email-signup"> 
                    <input type="text" id="dwfrm_mcsubscribe_email" placeholder="メールはこないよ!" action="email-signin">
                    <input type="submit">
                </form>
                <div class="footer-brand">
                </div>
                this website is created for private study and no order will be processed.
            </div>
            
        </footer>


    </div>

    <!-- モーダル(Popup WindowのようなUI)-->
    @yield('modal')

    @yield('javascript')

</body>

</html>