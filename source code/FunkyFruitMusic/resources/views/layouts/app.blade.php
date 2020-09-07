<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Funky Fruit Music</title>

    <!-- Scripts -->
    
    	
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- Styles -->
    
    
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">	
    <!-- Animate CSS -->
	<link href="{{ asset('css/animate.min.css') }}" rel="stylesheet">
    <!-- Basic stylesheet -->
	<link rel="stylesheet" href="{{ asset('css/owl.carousel.css') }}">
    <!-- Font awesome CSS -->
	<link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">		
    <!-- Custom CSS -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
	<link href="{{ asset('css/style-color.css') }}" rel="stylesheet">
    <link href="{{ asset('css/frontend.css') }}" rel="stylesheet">
	<!-- Favicon -->
    <link rel="shortcut icon" href="{{ Voyager::image(setting('site.Logo')) }}">
    <script src="{{ asset('js/jquery.js') }}"></script>
    <!-- Bootstrap JS -->
	<script src="{{ asset('js/bootstrap.min.js') }}"></script>
	<!-- WayPoints JS -->
    <script src="{{ asset('js/waypoints.min.js') }}"></script>
	<!-- Include js plugin -->
    <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
	<!-- One Page Nav -->
    <script src="{{ asset('js/jquery.nav.js') }}"></script>
	<!-- Respond JS for IE8 -->
    <script src="{{ asset('js/respond.min.js') }}"></script>
	<!-- HTML5 Support for IE -->
    <script src="{{ asset('js/html5shiv.js') }}"></script>
	<!-- Custom JS -->
    <script src="{{ asset('js/custom.js') }}"></script>
    
</head>
<body>
    <div id="app">
        <div id="app">
            <header>
                <!-- secondary menu -->
                <nav class="secondary-menu">
                    <div class="container">
                        <!-- secondary menu left link area -->
                        <div class="sm-left">
                            <strong>Phone</strong>:&nbsp; <a href="tel:555555555">555 555 555</a>&nbsp;&nbsp;&nbsp;&nbsp;
                            <strong>E-mail</strong>:&nbsp; <a href="mailto:funkyfruimusic1@gmail.com">funkyfruimusic1@gmail.com</a>
                        </div>
                        <!-- secondary menu right link area -->
                        <div class="sm-right">
                            <!-- social link -->
                            <div class="sm-social-link">
                                @guest
                                
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                <span> | </span>
                                @if (Route::has('register'))
                                    
                                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                    
                                @endif
                            @else
                                <div class="dropdown">
                                    <span>Welcome {{ Auth::user()->name }}</span>
                                    
                                    <div class="dropdown-content">
                                        <ul>
                                            <li>
                                                <a href="#">Profile</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="{{ route('logout') }}"
                                                    onclick="event.preventDefault();
                                                                    document.getElementById('logout-form').submit();">
                                                    {{ __('Logout') }}
                                                </a>
            
                                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                    @csrf
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                              
                            @endguest
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </nav>
                <!-- primary menu -->
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <div class="container">
                        <!-- Brand and toggle get grouped for better mobile display -->
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <!-- logo area -->
                            <a class="navbar-brand" href="http://localhost:8080/FunkyFruitMusic/public/">
                                <!-- logo image -->
                                <img class="img-responsive" src="{{ Voyager::image(setting('site.Logo')) }}" alt="" style="width: 50px"/>
                            </a>
                        </div>

                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            <ul class="nav navbar-nav navbar-right">
                                <li><a href="new-release">New Release</a></li>
                                <li><a href="#">Album</a></li>
                                <li><a href="#">Category</a></li>
                                <li><a href="#">Nation</a></li>
                                <li><a href="#">News</a></li>
                                <li><a href="#">About us</a></li>
                                <li><a href="#">Contact</a></li>
                            </ul>
                        </div><!-- /.navbar-collapse -->
                    </div><!-- /.container-fluid -->
                </nav>
            </header>
            

        <main class="py-4">
            @yield('content')
        </main>
    </div>

</body>
</html>
