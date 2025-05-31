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
                  <span class="sec-subtitle">Hébergement & Location de Vehicule</span>
                  <h2 class="sec-title h1">Hébergements abordables et paradisiaques.</h2>
                </div>
            @endif

            @if ($locale == 'en')
              <div class="title-area">
                <span class="sec-subtitle">Accommodation and car hire</span>
                <h2 class="sec-title h1">Heavenly accommodation at an affordable price.</h2>
              </div>
            @endif

            @if ($locale == 'es')
              <div class="title-area">
                <span class="sec-subtitle">Alojamiento y alquiler de coches</span>
                <h2 class="sec-title h1">Alojamiento asequible en el paraíso.</h2>
              </div>
            @endif

         
        </div>
      </div>
      <div class="blog-style4">
        <div class="blog-image">
          <img src="{{asset('assets/img/about/hebergement.jpg')}}" alt="blog image">
     
          
          @if ($locale == 'fr')
                @foreach ($bcategory as $cat)
                @if ($cat->category_slug == 'hébergement')
                  <div class="category-tag"><a href="{{url('blog/cat/list',$cat->id)}}"><i class="fas fa-tag"></i> Hébergement</a></div>

                @endif
                @endforeach
          @endif

          @if ($locale == 'en')
              @foreach ($bcategory as $cat)
              @if ($cat->category_slug == 'hébergement')
                <div class="category-tag"><a href="{{url('blog/cat/list',$cat->id)}}"><i class="fas fa-tag"></i> accommodation</a></div>

              @endif
              @endforeach
          @endif

          @if ($locale == 'es')
              @foreach ($bcategory as $cat)
              @if ($cat->category_slug == 'hébergement')
                <div class="category-tag"><a href="{{url('blog/cat/list',$cat->id)}}"><i class="fas fa-tag"></i> Alojamiento </a></div>

              @endif
              @endforeach
          @endif
          
        </div>
        <div class="blog-content" data-bg-src="{{asset('assets/img/shape/blog-bg.png')}}">
          {{-- <a class="blog-date" href="blog-details.html"><i class="far fa-calendar-alt "></i> July 21, 2023</a> --}}

          
           @if ($locale == 'fr')
           <h3 class="blog-title"><a href="{{url('blog/cat/list',$cat->id)}}">Hébergement typique.</a></h3>
           <p class="blog-text">Nous offrons aux voyageurs une approche autonome pour leur séjour, 
             qu'il s'agisse d'un campement, d'une résidence privée, d'une maison d'hôtes, d'un hôtel, voire même d'un hébergement solidaire.</p>
           <a class="vs-btn style4" href="{{url('blog/cat/list',$cat->id)}}">Voir Plus</a>
           @endif

          @if ($locale == 'en')
          <h3 class="blog-title"><a href="{{url('blog/cat/list',$cat->id)}}">Typical accommodation.</a></h3>
          <p class="blog-text">We offer travelers an autonomous approach to their stay,  whether it's a camp, a private residence, a guest house, a hotel, or even a shared accommodation.</p>
          <a class="vs-btn style4" href="{{url('blog/cat/list',$cat->id)}}">View More</a>
          @endif

          @if ($locale == 'es')
          <h3 class="blog-title"><a href="{{url('blog/cat/list',$cat->id)}}">Alojamiento típico.</a></h3>
          <p class="blog-text">Ofrecemos a los viajeros un enfoque autónomo de su estancia,  ya sea un campamento, una residencia privada, una pensión, un hotel o incluso un alojamiento compartido..</p>
          <a class="vs-btn style4" href="{{url('blog/cat/list',$cat->id)}}">Ver más</a>
          @endif

        
            
        </div>
      </div>

        @if ($locale == 'fr')
            <div class="blog-style4">
              <div class="blog-image">
                <img src="{{asset('assets/img/about/herbergement221.jpg')}} " alt="blog image">
                <div class="category-tag"><a href="#"><i class="fas fa-tag"></i> Voitures</a></div>
              </div>
              <div class="blog-content" data-bg-src="assets/img/shape/blog-bg.png">
                {{-- <a class="blog-date" href="blog-details.html"><i class="far fa-calendar-alt "></i> July 21, 2023</a> --}}
                <h3 class="blog-title"><a href="blog-details.html">Location de Véhicules </a></h3>
                <p class="blog-text">Nous proposons une large gamme de véhicules incluant des bus, des minibus climatisés et des 4x4 pour vos excursions, circuits, transferts et autres événements...</p>
                <a class="vs-btn style4" href="{{route('vehicule')}}">Voir Plus</a>
              </div>
            </div>
        @endif

        @if ($locale == 'en')
            <div class="blog-style4">
              <div class="blog-image">
                <img src="{{asset('frontend/assets/img/about/herbergement221.jpg')}} " alt="blog image">
                <div class="category-tag"><a href="#"><i class="fas fa-tag"></i> Cars</a></div>
              </div>
              <div class="blog-content" data-bg-src="assets/img/shape/blog-bg.png">
                {{-- <a class="blog-date" href="blog-details.html"><i class="far fa-calendar-alt "></i> July 21, 2023</a> --}}
                <h3 class="blog-title"><a href="blog-details.html">Rent a Car</a></h3>
                <p class="blog-text">We offer a wide range of vehicles including buses, air-conditioned minibuses and 4x4s for your excursions, tours, transfers and other events.</p>
                <a class="vs-btn style4" href="{{route('vehicule')}}">View More</a>
              </div>
            </div>
        @endif

        @if ($locale == 'es')
            <div class="blog-style4">
              <div class="blog-image">
                <img src="{{asset('frontend/assets/img/about/herbergement221.jpg')}} " alt="blog image">
                <div class="category-tag"><a href="#"><i class="fas fa-tag"></i>Vehículos</a></div>
              </div>
              <div class="blog-content" data-bg-src="assets/img/shape/blog-bg.png">
                {{-- <a class="blog-date" href="blog-details.html"><i class="far fa-calendar-alt "></i> July 21, 2023</a> --}}
                <h3 class="blog-title"><a href="blog-details.html">Alquiler de vehículos </a></h3>
                <p class="blog-text">Le ofrecemos una amplia gama de vehículos que incluye autobuses, minibuses con aire acondicionado y 4x4 para sus excursiones, visitas, traslados y otros eventos...</p>
                <a class="vs-btn style4" href="{{route('vehicule')}}">Ver más</a>
              </div>
            </div>
        @endif

      
    </div>
  </div>