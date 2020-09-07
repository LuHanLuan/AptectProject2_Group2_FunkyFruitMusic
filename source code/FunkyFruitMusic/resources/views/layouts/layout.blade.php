<!doctype html>
<html lang="en">
  <head>
    <title>Funky Fruit Music</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- Optional Toastr -->
    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
      
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link href="{{ asset('css/frontend.css') }}" rel="stylesheet">
    <script src="https://kit.fontawesome.com/35b30f169a.js" crossorigin="anonymous"></script>
    <style>
        .dropdown:hover>.dropdown-menu{
            display: block;
        }
        .container-fluid{
          width: 80%;
        }
        nav ul li a{
          padding: 10px;
        }
    </style>
    </head>
    <body>
      <div class="container-fluid">
        <nav class="nav-area">
          <ul>
              <li>
                <a class="navbar-brand" href="{{ url('/') }}">
                  <img class="img-responsive" src="{{ Voyager::image(setting('site.Logo')) }}" alt="" style="width: 30px">
                </a>
              </li>
              <li><a href="{{ url('/') }}">HOME</a></li>
              <li><a href="{{ url('new-release') }}">NEW-RELEASE</a></li>
              <li><a href="{{ url('album') }}">ALBUM</a></li>
              <li><a href="{{ url('artist') }}">ARTISTS</a>
                <ul>
                  <li><a class="dropdown-item" href="{{ url('singer') }}" style="font-size: 16px">SINGER</a></li>
                  <li><a class="dropdown-item" href="{{ url('musician') }}" style="font-size: 16px">MUSICIAN</a></li>
                </ul>
              </li>
              <li><a href="{{ url('category') }}">CATEGORY</a>
                  <ul>
                    <?php 
                    $categories = DB::select('select * from categories');
                    ?>
                    @foreach ($categories as $category)
                    <li><a class="dropdown-item" href="{{  url('category/'. $category->id)}}" style="font-size: 16px">{{ $category->name }}</a></li>
                    @endforeach
                  </ul> 
              </li>
              <li><a href="{{ url('nation') }}">NATION</a>
                <ul>
                  <?php 
                  $nations = DB::select('select * from nations');
                  ?>
                  @foreach ($nations as $nation)
                  <li><a class="dropdown-item" href="{{  url('nation/'. $nation->id)}}" style="font-size: 16px">{{ $nation->name }}</a></li>
                  @endforeach
                </ul> 
              </li>
              {{-- <li><a href="">NEWS</a></li> --}}
              <li><a href="{{ url('aboutus') }}">ABOUT US</a></li>
              @guest
                <li><a href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <img src="{{ Voyager::image(setting('site.user-logo')) }}" alt="" style="width: 30px">
                  GUEST
                </a>
                  <ul>
                    <li><a href="{{ route('login') }}">Login</a></li>
                    <li><a href="{{ route('register') }}">Register</a></li>
                  </ul>
                </li>
                
                
              @else
                <li>
                  <a href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img src="{{ Voyager::image(setting('site.user-logo')) }}" alt="" style="width: 30px">
                    {{ Auth::user()->name }}
                  </a>
                
                    <ul>
                      <li><a href="{{ url('recent') }}">Recent songs</a></li>
                      <li><a href="{{ url('lsongs') }}">Liked songs</a></li>
                      <li>
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">  {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                        </form>
                      </li>
                    </ul>
                </li>
              @endguest
              <li>
                <form action="{{ url('searchall') }}" method="get" class="form-inline" style="padding-top: 10px; float: right; padding-left:30px">
                  <input class="form-control mr-xl-5" type="search" placeholder="Search" aria-label="Search" style="font-size: 16px" name="search">
                  <button class="btn btn-outline-success my-2 my-sm-0" type="submit" style="font-size: 16px">Search</button>
                </form>
              </li>
          </ul>
        </nav>
        
      </div>
      <br>
      @yield('content')
      
      <br>
      
      {{-- <footer>
        <div class="container">
            <!-- social media links -->
            <div class="social">
                <a class="h-facebook" href="#"><i class="fa fa-facebook"></i></a>
                <a class="h-google" href="#"><i class="fa fa-google-plus"></i></a>
                <a class="h-linkedin" href="#"><i class="fa fa-linkedin"></i></a>
                <a class="h-twitter" href="#"><i class="fa fa-twitter"></i></a>
            </div>
            <!-- copy right -->
            <p class="copy-right">&copy; copyright 2018, All rights are reserved.</p>
        </div>
    </footer> --}}

    <!-- Footer-->
    {{-- <footer class="footer py-4">
      <div class="container">
         <div class="row align-items-center">
            <div class="col-lg-4 text-lg-left">Copyright © FPT Aptech 2020</div>
            <div class="col-lg-4 my-3 my-lg-0">
               <a class="btn btn-dark btn-social mx-2" href="#!"><i class="fab fa-twitter"></i></a>
               <a class="btn btn-dark btn-social mx-2" href="#!"><i class="fab fa-facebook-f"></i></a>
               <a class="btn btn-dark btn-social mx-2" href="#!"><i class="fab fa-linkedin-in"></i></a>
            </div>
            <div class="col-lg-4 text-lg-right">
               <a class="mr-3" href="#!">Privacy Policy</a>
               <a href="#!">Terms of Use</a>
            </div>
         </div>
      </div>
   </footer> --}}
   <footer class="footer" style="background: white;">
		<div class="footer_content">
			<div class="container">
				<div class="row">
					<div class="col">
						<div class="footer_logo text-center"><a href="#"><img src="images/logo_3.png" alt=""></a></div>
					</div>
				</div>
				<div class="row footer_row">
					<div class="col-lg-4 footer_col">
						<div class="footer_item text-center">
							<div class="footer_icon d-flex flex-column align-items-center justify-content-center ml-auto mr-auto">
								<div><img src="{{ Voyager::image(setting('site.footer3')) }}" alt=""></div>
							</div>
							<div class="footer_title"  style="font-size: 20px; font-weight: bold">TALK TO US</div>
							<div class="footer_list">
								<ul>
									<li style="font-size: 20px">+84 901234567</li>
									<li style="font-size: 20px">+84 902345678</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="col-lg-4 footer_col">
						<div class="footer_item text-center">
							<div class="footer_icon d-flex flex-column align-items-center justify-content-center ml-auto mr-auto">
								<div><img src="{{ Voyager::image(setting('site.footer2')) }}" alt=""></div>
							</div>
							<div class="footer_title" style="font-size: 20px; font-weight:bold;">EMAIL</div>
							<div class="footer_list">
								<ul>
									<li style="font-size: 20px">funkyfruitmusic@gmail.com</li>
									<li style="font-size: 20px">officefunky@gmail.com</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="col-lg-4 footer_col">
						<div class="footer_item text-center">
							<div class="footer_icon d-flex flex-column align-items-center justify-content-center ml-auto mr-auto">
								<div><img src="{{ Voyager::image(setting('site.footer1')) }}" alt=""></div>
							</div>
							<div class="footer_title" style="font-size: 20px; font-weight:bold;">LOCATION</div>
							<div class="footer_list">
								<ul>
									<li style="font-size: 20px">590 Cach Mang Thang 8 </li>
									<li style="font-size: 20px">District 3 HCMC</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="footer_bar d-flex flex-row align-items-center justify-content-center">
			<div class="copyright"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved 
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></div>
		</div>
	</footer>
        

    <script>
      @if(Session::has('message'))
          var type="{{Session::get('alert-type','info')}}"
  
      
          switch(type){
              case 'info':
                   toastr.info("{{ Session::get('message') }}");
                   break;
              case 'success':
                  toastr.success("{{ Session::get('message') }}");
                  break;
               case 'warning':
                  toastr.warning("{{ Session::get('message') }}");
                  break;
              case 'error':
                  toastr.error("{{ Session::get('message') }}");
                  break;
          }
      @endif
  </script>
    </body>
</html>