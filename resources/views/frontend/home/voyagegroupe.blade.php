@php
$bcategory = App\Models\BlogCategory::latest()->get();
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
$locale = Session::get('local') ?? 'fr';
Session::put('local',$locale);
App::setLocale($locale);
@endphp

<div class="space-top space-extra-bottom blog-wrapper1 shape-mockup-wrap">
    <div class="shape-mockup d-none d-xl-block spin z-index-negative" data-top="-5%" data-left="-5%">
      <img src="{{asset('frontend/assets/img/shape/circle1.png')}}" alt="circle">
    </div>
    <div class="shape-mockup d-none d-xl-block jump z-index-negative" data-bottom="5%" data-right="5%">
      <img src="{{asset('frontend/assets/img/shape/Dot.png')}}" alt="Dots">
    </div>
    <div class="container">
      <div class="row justify-content-center text-center">
        <div class="col-xxl-6 col-xl-7 col-lg-8 wow fadeInUp" data-wow-delay="0.3s">

            @if ($locale == 'fr')
                <div class="title-area">
                  <span class="sec-subtitle">Nos Dates 2025 - 2026</span>
                  <h2 class="sec-title h1">Voyage en Goupres .</h2>
                </div>
            @endif

    

         
        </div>
      </div>
     

        @if ($locale == 'fr')

            @foreach ( $voyage as $item)
            <div class="blog-style4">
              <div class="blog-image">
                <img src="{{asset($item->image_cap)}} " alt="blog image">
                <div class="category-tag"><a href="#"><i class="fas fa-tag"></i> {{$item->nombre_participant}} Participants </a></div>
              </div>
              <div class="blog-content" data-bg-src="assets/img/shape/blog-bg.png">
                {{-- <a class="blog-date" href="blog-details.html"><i class="far fa-calendar-alt "></i> July 21, 2023</a> --}}
                <h3 class="blog-title"><a href="blog-details.html">{{$item->name}} </a></h3>
                <p class="blog-text">{!!$item->short_descp!!}</p>
                <a class="vs-btn style4" href="{{ url('voyage/detail/'.$item->id) }}">Voir Plus</a>
              </div>
            </div>
            @endforeach
            
        @endif

  

      
    </div>
  </div>