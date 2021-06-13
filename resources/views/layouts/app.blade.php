<!DOCTYPE html>
<!--
	Soul by TEMPLATE STOCK
	templatestock.co @templatestock
	Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
-->


<html>
    <head>
        <title>Soul Free HTML5 Responsive Template | Template Stock</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width">
        <meta name="viewport" content="initial-scale = 1.0, maximum-scale = 1.0, user-scalable = no, width = device-width">


        <!-- Pace.js -->
        <script src="{{ secure_asset('js/pace.js') }}" type="text/javascript"> </script>

        <!-- Foundations 5 Stylesheet-->
        <link href="{{ secure_asset('css/foundation.css') }}" type="text/css" rel="stylesheet" media="screen" />

        <!-- Normalize-->
        <link href="{{ secure_asset('css/normalize.css') }}" type="text/css" rel="stylesheet" media="screen" />

        <!-- Source Sans Pro Google Web Font-->
        <link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,600,700,400italic,600italic,700italic&subset=latin,vietnamese,latin-ext' rel='stylesheet' type='text/css'>

        <!-- Font Awesome Web Font Icons-->
        <link href="{{ secure_asset('css/font-awesome.min.css') }}" type="text/css" rel="stylesheet" media="screen" />

        <!-- General Stylesheet-->
        <link href="{{ secure_asset('css/style.css') }}" type="text/css" rel="stylesheet" media="screen" />

        <!-- jQuery Library 1.11.0 -->
        <script type="text/javascript" src="{{ secure_asset('js/jquery-1.11.0.min.js') }}"> </script>

        <!-- Modernizr v2.7.1 -->
        <script src="{{ secure_asset('js/modernizr.js') }}" type="text/javascript"> </script>

        <!-- Foundations 5 -->
        <script src="{{ secure_asset('js/foundation.min.js') }}" type="text/javascript"> </script>

        <!-- Caroufredsel jQuery Plugin -->
        <script src="{{ secure_asset('js/jquery.carouFredSel-6.2.1-packed.js') }}" type="text/javascript"> </script>

        <!-- Isotope jQuery Plugin -->
        <script src="{{ secure_asset('js/jquery.isotope.js') }}" type="text/javascript"> </script>

        <!-- Appear Plugin -->
        <script src="{{ secure_asset('js/appear.js') }}" type="text/javascript"> </script>

        <!-- General Initialization -->
        <script src="{{ secure_asset('js/general.js') }}" type="text/javascript"> </script>

        <!-- Evergage -->
        <script type="text/javascript" src="//cdn.evgnet.com/beacon/ekim1482497/engage/scripts/evergage.min.js"></script>

    </head>

    <body id="home">

       <!-- Back to Top Button -->
       <a href="#home" class="scroll backtotop">
           <i class="fa fa-angle-up"> </i>
       </a>

       <!-- Start of Header -->
       <header>
           <div class="row">
               <div class="large-4 medium-12 column">
                   <div class="logoholder">
                       <a href="#home" class="scroll"><img src="images/logo.png" alt="" title=""></a>
                   </div>
               </div>
               <div class="large-8 medium-12 column">
                   <nav>
                       <ul>
                           <li><a href="#home" class="scroll">Home</a></li>
                           <li>/</li>
                           <li><a href="#about" class="scroll">About</a></li>
                           <li>/</li>
                           <li><a href="#services" class="scroll">Services</a></li>
                           <li>/</li>
                           <li><a href="#team" class="scroll">Team</a></li>
                           <li>/</li>
                           <li><a href="#works" class="scroll">Works</a></li>
                           <li>/</li>
                           <li><a href="#contact" class="scroll">Contact</a></li>
                       </ul>
                   </nav>
               </div>

               <div class="large-12 column">
                   <div class="sep"> </div>
               </div>

           </div>
       </header>
       <!-- End of Header -->

       <!-- Start of About -->
       <section class="about" id="about">
           <div class="row">

               <div class="large-8 large-centered column">
                   @yield('content')
               </div>


           </div>
       </section>
       <!-- End of About -->

       <!-- Start of Parallax -->
       <section class="parallax" style="background-image: url(images/parallax.jpg);" data-type="background" data-speed="9"></section>
       <!-- End of Parallax -->

       <!-- Start of Footer -->
       <footer>
           <div class="row">
               <div class="large-6 medium-12 column">
                   <ul class="social fa-ul">
                        <li><a href="#"><i class="fa fa-li fa-dribbble"> </i> <span>DRIBBLE<span></a></li>
                        <li><a href="#"><i class="fa fa-li fa-twitter"> </i> <span>TWITTER<span></a></li>
                        <li><a href="#"><i class="fa fa-li fa-skype"> </i> <span>SKYPE<span></a></li>
                   </ul>
               </div>
               <div class="large-6 medium-12 column">
                   <div class="copyright">
                       © Soul 2015. ALL RIGHTS RESERVED Create By <a href="http://templatestock.co">Template Stock</a>
                   </div>
               </div>
           </div>
       </footer>
       <!-- End of Footer -->

    </body>
</html>
