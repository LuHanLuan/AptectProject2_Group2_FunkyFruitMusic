@extends('layouts.layout')
@section('content')
<!-- Team-->
<style>
   .team-member {
	text-align: center;
	max-width: 400px;
	margin: 0 auto;
	margin-top: 30px;
}



.team-member .member-img .social {
	position: absolute;
	top: 50%;
	left: 0;
	margin-top: -20px;
	z-index: 10;
	width: 100%;
	opacity: 0;
	-webkit-transition: all 0.25s linear;
	-moz-transition: all 0.25s linear;
	-ms-transition: all 0.25s linear;
	-o-transition: all 0.25s linear;
	transition: all 0.25s linear;
}

.team-member:hover .member-img .social {
	opacity: 1;
	-webkit-transition: all 0.25s linear;
	-moz-transition: all 0.25s linear;
	-ms-transition: all 0.25s linear;
	-o-transition: all 0.25s linear;
	transition: all 0.25s linear;
}
</style>
<section class="page-section bg-light" id="team">
   <div class="container">
      <div class="text-center">
         <h2 class="section-heading text-uppercase">Our Team</h2>
         
      </div>
      <div class="row">
         <div class="col-lg-4">
            <div class="team-member">
               <img class="mx-auto rounded-circle" src="{{ Voyager::image(setting('site.Aboutus1')) }}" alt="" style="width: 300px; height: 300px;"/>
               <h4>Lư Hán Luân</h4>
               <p class="text-muted">Leader</p>
               <a class="btn btn-dark btn-social mx-2" href="https://www.facebook.com/snow.ace.94"><i class="fab fa-facebook-f"></i></a>
            </div>
         </div>
         <div class="col-lg-4">
            <div class="team-member">
               <img class="mx-auto rounded-circle" src="{{ Voyager::image(setting('site.Aboutus2')) }}" alt="" style="width: 300px; height: 300px;"/>
               <h4>Đào Nguyễn Duy Khang</h4>
               <p class="text-muted">Member</p>
               <a class="btn btn-dark btn-social mx-2" href="https://www.facebook.com/duykhang.bjw"><i class="fab fa-facebook-f"></i></a>
            </div>
         </div>
         <div class="col-lg-4">
            <div class="team-member">
               <img class="mx-auto rounded-circle" src="{{ Voyager::image(setting('site.Aboutus3')) }}" alt="" style="width: 300px; height: 300px;"/>
               <h4>Châu Đức Thịnh</h4>
               <p class="text-muted">Member</p>
               <a class="btn btn-dark btn-social mx-2" href="https://www.facebook.com/ChauDucThinh"><i class="fab fa-facebook-f"></i></a>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-lg-8 mx-auto text-center">
            <p class="large text-muted">We are from T1.1910M3 class</p>
         </div>
      </div>
   </div>
</section>
@endsection