@extends('frontend.main_master')
@section('main')
      <!--==============================
	  Hero area Start
	==============================-->
  <div class="breadcumb-wrapper" data-bg-src=" {{asset('frontend/assets/img/breadcumb/desti.png')}} " style="width: 1280;height: 800;">
    <div class="container z-index-common">
      <div class="breadcumb-content">
        <h1 class="breadcumb-title" style="display: none" >Destinations</h1>
        <div class="breadcumb-menu-wrap">
          <ul class="breadcumb-menu">
            <li><a href="index.html" style="display: none">Home</a></li>
            <li style="display: none">Destinations</li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <!--==============================
	  Hero Area End
	==============================-->

  <!--==============================
     Destiniations Area Start 
  ==============================-->
  <section class="space-top space-extra-bottom">
    <div class="container">
      <div class="row justify-content-center">
        @foreach ($destination as $desti)
            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12">
              <div class="destination-style1">
                <a href="destination-details.html">
                  <img src="{{asset($desti->image_cap)}}" alt="destination image" /></a>
                {{-- <span class="destination-price">$299</span> --}}
                <div class="destination-info">
                  <h4 class="destination-name"><a href="{{ url('destination/detail/'.$desti->id) }}">{{$desti->name}}</a></h4>
                  <p class="destination-text">Explorez</p>
                </div>
              </div>
            </div>
        @endforeach
      
        
      </div>
      {{-- <div class="vs-pagination pt-lg-2">
           
        {{$destination->links('vendor.pagination.custom')}}


    
  </div> --}}
    </div>
  </section>
  <!--==============================
     Destiniations Area End 
  ==============================-->

  <!--==============================
     Tour Package Area Start 
  ==============================-->
  {{-- <section class="space bg-light">
    <div class="container ">
      <div class="row justify-content-center text-center">
        <div class="col-xl-6 col-lg-8 wow fadeInUp" data-wow-delay="0.3s">
          <div class="title-area">
            <span class="sec-subtitle">Awesome Tours</span>
            <h2 class="sec-title h1">Best Holiday Package</h2>
            <p class="sec-text">Curabitur aliquet quam id dui posuere blandit. Vivamus magna justo, lacinia eget
              consectetur sed,
              convgallis at tellus. Vestibulum ac diam sit.</p>
          </div>
        </div>
      </div>
      <div class="row vs-carousel" data-slide-show="4" data-arrows="false" data-lg-slide-show="3" data-md-slide-show="2"
        data-sm-slide-show="1">
        <div class="col-xl-3 col-lg-6 col-sm-6">
          <div class="package-style1">
            <div class="package-img">
              <a href="tour-booking.html"><img class="w-100" src="assets/img/tours/tour-1-1.jpg" alt="Package Image"></a>
            </div>
            <div class="package-content">
              <div class="package-review">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="far fa-star"></i>
                <i class="far fa-star"></i>
              </div>
              <h3 class="package-title"><a href="tour-booking.html">Peek Mountain View</a></h3>
              <p class="package-text">Las Vegas, Nevada</p>
              <div class="package-meta">
                <a href="#"><i class="fas fa-calendar-alt"></i> Days: 4</a>
                <a href="#"><i class="fas fa-user"></i> People: 3</a>
              </div>
              <div class="package-footer">
                <span class="package-price">$299</span>
                <a href="tour-booking.html" class="vs-btn style4">View Details</a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-sm-6">
          <div class="package-style1">
            <div class="package-img">
              <a href="tour-booking.html"><img class="w-100" src="assets/img/tours/tour-1-2.jpg" alt="Package Image"></a>
            </div>
            <div class="package-content">
              <div class="package-review">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="far fa-star"></i>
                <i class="far fa-star"></i>
              </div>
              <h3 class="package-title"><a href="tour-booking.html">Peek Mountain View</a></h3>
              <p class="package-text">Las Vegas, Nevada</p>
              <div class="package-meta">
                <a href="#"><i class="fas fa-calendar-alt"></i> Days: 4</a>
                <a href="#"><i class="fas fa-user"></i> People: 3</a>
              </div>
              <div class="package-footer">
                <span class="package-price">$299</span>
                <a href="tour-booking.html" class="vs-btn style4">View Details</a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-sm-6">
          <div class="package-style1">
            <div class="package-img">
              <a href="tour-booking.html"><img class="w-100" src="assets/img/tours/tour-1-3.jpg" alt="Package Image"></a>
            </div>
            <div class="package-content">
              <div class="package-review">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="far fa-star"></i>
                <i class="far fa-star"></i>
              </div>
              <h3 class="package-title"><a href="tour-booking.html">Peek Mountain View</a></h3>
              <p class="package-text">Las Vegas, Nevada</p>
              <div class="package-meta">
                <a href="#"><i class="fas fa-calendar-alt"></i> Days: 4</a>
                <a href="#"><i class="fas fa-user"></i> People: 3</a>
              </div>
              <div class="package-footer">
                <span class="package-price">$299</span>
                <a href="tour-booking.html" class="vs-btn style4">View Details</a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-sm-6">
          <div class="package-style1">
            <div class="package-img">
              <a href="tour-booking.html"><img class="w-100" src="assets/img/tours/tour-1-4.jpg" alt="Package Image"></a>
            </div>
            <div class="package-content">
              <div class="package-review">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="far fa-star"></i>
                <i class="far fa-star"></i>
              </div>
              <h3 class="package-title"><a href="tour-booking.html">Peek Mountain View</a></h3>
              <p class="package-text">Las Vegas, Nevada</p>
              <div class="package-meta">
                <a href="#"><i class="fas fa-calendar-alt"></i> Days: 4</a>
                <a href="#"><i class="fas fa-user"></i> People: 3</a>
              </div>
              <div class="package-footer">
                <span class="package-price">$299</span>
                <a href="tour-booking.html" class="vs-btn style4">View Details</a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-sm-6">
          <div class="package-style1">
            <div class="package-img">
              <a href="tour-booking.html"><img class="w-100" src="assets/img/tours/tour-1-2.jpg" alt="Package Image"></a>
            </div>
            <div class="package-content">
              <div class="package-review">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="far fa-star"></i>
                <i class="far fa-star"></i>
              </div>
              <h3 class="package-title"><a href="tour-booking.html">Peek Mountain View</a></h3>
              <p class="package-text">Las Vegas, Nevada</p>
              <div class="package-meta">
                <a href="#"><i class="fas fa-calendar-alt"></i> Days: 4</a>
                <a href="#"><i class="fas fa-user"></i> People: 3</a>
              </div>
              <div class="package-footer">
                <span class="package-price">$299</span>
                <a href="#" class="vs-btn style4">View Details</a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-sm-6">
          <div class="package-style1">
            <div class="package-img">
              <a href="tour-booking.html"><img class="w-100" src="assets/img/tours/tour-1-3.jpg" alt="Package Image"></a>
            </div>
            <div class="package-content">
              <div class="package-review">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="far fa-star"></i>
                <i class="far fa-star"></i>
              </div>
              <h3 class="package-title"><a href="tour-booking.html">Peek Mountain View</a></h3>
              <p class="package-text">Las Vegas, Nevada</p>
              <div class="package-meta">
                <a href="#"><i class="fas fa-calendar-alt"></i> Days: 4</a>
                <a href="#"><i class="fas fa-user"></i> People: 3</a>
              </div>
              <div class="package-footer">
                <span class="package-price">$299</span>
                <a href="tour-booking.html" class="vs-btn style4">View Details</a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="text-center pt-lg-2">
        <a href="tours.html" class="vs-btn">View More</a>
      </div>
    </div>
  </section> --}}
  <!--==============================
     Tour Package Area End 
  ==============================-->
  
@endsection