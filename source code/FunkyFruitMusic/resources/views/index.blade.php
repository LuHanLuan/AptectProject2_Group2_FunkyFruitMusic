@extends('layouts.layout')


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
@section('content')
<!-- modal for booking ticket form -->

<!-- wrapper -->
<div class="wrapper" id="home">

    <!-- banner area -->
    <div class="banner" style="padding-top: 20px">
        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox" >
                <div class="item active">
                    <img src="img/banner/b1.jpg" alt="..." style="z-index: -1">
                    <div class="container">
                        <!-- banner caption -->
                        <div class="carousel-caption slide-one">
                            <!-- heading -->
                            <h2 class="animated fadeInLeftBig"><i class="fa fa-music"></i> Melodi For You!</h2>
                            <!-- paragraph -->
                            <h3 class="animated fadeInRightBig">Find More Innovative &amp; Creative Music Albums.</h3>
                            <!-- button -->
                            <a href="{{ url('album') }}" class="animated fadeIn btn btn-theme" style="color: white">View More</a>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <img src="img/banner/b2.jpg" alt="..." style="z-index: -1">
                    <div class="container">
                        <!-- banner caption -->
                        <div class="carousel-caption slide-two">
                            <!-- heading -->
                            <h2 class="animated fadeInLeftBig"><i class="fa fa-headphones"></i> Listen It...</h2>
                            <!-- paragraph -->
                            <h3 class="animated fadeInRightBig">Music brings harmony to the world.</h3>
                            <!-- button -->
                            <a href="{{ url('new-release') }}" class="animated fadeIn btn btn-theme" style="color: white">Listen Now</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Controls -->
            <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                <span class="fa fa-arrow-left" aria-hidden="true"></span>
            </a>
            <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                <span class="fa fa-arrow-right" aria-hidden="true"></span>
            </a>
        </div>
    </div>
    <!--/ banner end -->
    
    <!-- block for animate navigation menu -->
    <div class="nav-animate"></div>
    
    
    <!-- featured abbum -->
    <?php
        $albums = DB::select('select * from albums limit 6');
    ?>
    <div class="featured pad" id="featuredalbum">
        <div class="container">
            <!-- default heading -->
            <div class="default-heading">
                <!-- heading -->
                <h2>Featured Album</h2>
            </div>
            <!-- featured album elements -->
            <div class="featured-element">
                <div class="row">
                    @foreach ($albums as $album)
                    <div class="col-md-4 col-sm-6">
                        <!-- featured item -->
                        <div class="featured-item ">
                            <!-- image container -->
                            <div class="figure">
                                <!-- image -->
                                <a href="{{  url('album/'. $album->id)}}">
                                    <img class="img-responsive" src="{{ Voyager::image($album->image) }}" style="max-height: 200px;" alt="" />
                                </a>
                                
                            </div>
                            <!-- featured information -->
                            <div class="featured-item-info">
                                <!-- featured title -->
                                <a href="{{  url('album/'. $album->id)}}">
                                    <h4>{{ $album->name }}</h4>
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- features end -->
    
    <!-- events -->
    {{-- <div class="events parallax-three pad" id="events">
        <div class="container">
            <!-- default heading -->
            <div class="default-heading-shadow">
                <!-- heading -->
                <h2>LATEST NEWS</h2>
            </div>
            <!-- events element -->
            <div class="events-element">
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <!-- event item -->
                        <div class="events-item ">
                            <!-- image container -->
                            <div class="figure">
                                <!-- event date -->
                                <div class="event-date">
                                    24 <span class="emonth">Jan</span>
                                    <div class="clearfix"></div>
                                    <!-- time -->
                                    <span class="etime">06:30 pm</span>
                                </div>
                                <!-- event location -->
                                <span class="event-location"><i class="fa fa-map-marker"></i> New York</span>
                                <!-- image -->
                                <img class="img-responsive" src="img/event/1.jpg" alt="" />
                                <!-- image hover -->
                                <div class="img-hover">
                                    <!-- hover icon -->
                                    <a href="#"><i class="fa fa-play-circle"></i></a>
                                </div>
                            </div>
                            <!-- event information -->
                            <div class="event-info">
                                <!-- event title -->
                                <h3>Sound Of melodi In Instrumesnts</h3>
                                <!-- horizontal line --><hr />
                                <!-- paragraph -->
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua, sed doconsect etur eiusmod teme et dolore magna aliqua... <a href="#">more</a></p>
                                <!-- buy ticket button link -->
                                <button href="#bookTicket" class="btn btn-lg btn-theme" data-toggle="modal" >Read more</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <!-- event item -->
                        <div class="events-item ">
                            <!-- image container -->
                            <div class="figure">
                                <!-- event date -->
                                <div class="event-date">
                                    31 <span class="emonth">Jan</span>
                                    <div class="clearfix"></div>
                                    <!-- time -->
                                    <span class="etime">09:45 pm</span>
                                </div>
                                <!-- event location -->
                                <span class="event-location"><i class="fa fa-map-marker"></i> Romania</span>
                                <!-- image -->
                                <img class="img-responsive" src="img/event/2.jpg" alt="" />
                                <!-- image hover -->
                                <div class="img-hover">
                                    <!-- hover icon -->
                                    <a href="#"><i class="fa fa-play-circle"></i></a>
                                </div>
                            </div>
                            <!-- event information -->
                            <div class="event-info">
                                <!-- event title -->
                                <h3>Rock Music Festival at City Life Mall</h3>
                                <!-- horizontal line --><hr />
                                <!-- paragraph -->
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua, sed doconsect etur eiusmod teme et dolore magna aliqua... <a href="#">more</a></p>
                                <!-- buy ticket button link -->
                                <button href="#bookTicket" class="btn btn-lg btn-theme" data-toggle="modal" >Read more</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <!-- event item -->
                        <div class="events-item ">
                            <!-- image container -->
                            <div class="figure">
                                <!-- event date -->
                                <div class="event-date">
                                    14 <span class="emonth">Feb</span>
                                    <div class="clearfix"></div>
                                    <!-- time -->
                                    <span class="etime">10:30 am</span>
                                </div>
                                <!-- event location -->
                                <span class="event-location"><i class="fa fa-map-marker"></i> New Delhi</span>
                                <!-- image -->
                                <img class="img-responsive" src="img/event/3.jpg" alt="" />
                                <!-- image hover -->
                                <div class="img-hover">
                                    <!-- hover icon -->
                                    <a href="#"><i class="fa fa-play-circle"></i></a>
                                </div>
                            </div>
                            <!-- event information -->
                            <div class="event-info">
                                <!-- event title -->
                                <h3>Fashion Show Light At Hollywood</h3>
                                <!-- horizontal line --><hr />
                                <!-- paragraph -->
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua, sed doconsect etur eiusmod teme et dolore magna aliqua... <a href="#">more</a></p>
                                <!-- buy ticket button link -->
                                <button href="#bookTicket" class="btn btn-lg btn-theme" data-toggle="modal" >Read more</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <!-- event item -->
                        <div class="events-item ">
                            <!-- image container -->
                            <div class="figure">
                                <!-- event date -->
                                <div class="event-date">
                                    31 <span class="emonth">Mar</span>
                                    <div class="clearfix"></div>
                                    <!-- time -->
                                    <span class="etime">10:00 pm</span>
                                </div>
                                <!-- event location -->
                                <span class="event-location"><i class="fa fa-map-marker"></i> New Delhi</span>
                                <!-- image -->
                                <img class="img-responsive" src="img/event/4.jpg" alt="" />
                                <!-- image hover -->
                                <div class="img-hover">
                                    <!-- hover icon -->
                                    <a href="#"><i class="fa fa-play-circle"></i></a>
                                </div>
                            </div>
                            <!-- event information -->
                            <div class="event-info">
                                <!-- event title -->
                                <h3>Fashion Show Light At Hollywood</h3>
                                <!-- horizontal line --><hr />
                                <!-- paragraph -->
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua, sed doconsect etur eiusmod teme et dolore magna aliqua... <a href="#">more</a></p>
                                <!-- buy ticket button link -->
                                <button href="#bookTicket" class="btn btn-lg btn-theme" data-toggle="modal" >Read more</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- events end --> --}}
    
    <!-- meet -->
    <div class="meet parallax-four pad" id="meet">
        <div class="container">
            <!-- default heading -->
            <div class="default-heading-shadow">
                <h2>Available Worldwide</h2>
            </div>
            <!-- meet location image -->
            <div class="meet-map">
                <img class="img-responsive img-map" src="img/flat/map.png" alt="" />
                <!-- map marker for India  -->
                <p  class="map-marker india " data-toggle="tooltip" data-placement="top" title="India"><img class="img-responsive" src="img/flat/map-marker.png" alt="" /></p>
                <!-- map marker for United States  -->
                <p  class="map-marker usa " data-toggle="tooltip" data-placement="top" title="United States"><img class="img-responsive" src="img/flat/map-marker.png" alt="" /></p>
                <!-- map marker for South Africa  -->
                <p  class="map-marker sa " data-toggle="tooltip" data-placement="top" title="South Africa"><img class="img-responsive" src="img/flat/map-marker.png" alt="" /></p>
                <!-- map marker for Russia  -->
                <p  class="map-marker russia " data-toggle="tooltip" data-placement="top" title="Russia"><img class="img-responsive" src="img/flat/map-marker.png" alt="" /></p>
                <!-- map marker for Brazil  -->
                <p  class="map-marker brazil " data-toggle="tooltip" data-placement="top" title="Brazil"><img class="img-responsive" src="img/flat/map-marker.png" alt="" /></p>
                <!-- map marker for Brazil  -->
                <p  class="map-marker vn " data-toggle="tooltip" data-placement="top" title="Vietnam"><img class="img-responsive" src="img/flat/map-marker.png" alt="" /></p>

                
            </div>
        </div>
    </div>
    <!-- meet end -->
    
    <!-- footer -->
    
    <!-- footer end -->
    
    <!-- Scroll to top -->
    <span class="totop"><a href="#"><i class="fa fa-chevron-up"></i></a></span> 
    
</div>
@endsection