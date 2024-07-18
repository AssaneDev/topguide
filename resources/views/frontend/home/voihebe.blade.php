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
          <div class="title-area">
            <span class="sec-subtitle">Hébergement & Location de Vehicule</span>
            <h2 class="sec-title h1">Hébergements abordables et paradisiaques.</h2>
          </div>
        </div>
      </div>
      <div class="blog-style4">
        <div class="blog-image">
          <img src="{{asset('frontend/assets/img/blog/Hebergement.jpg')}}" alt="blog image">
         @php
              $bcategory = App\Models\BlogCategory::latest()->get();
         @endphp
          
           @foreach ($bcategory as $cat)
               @if ($cat->category_slug == 'hébergement')
          <div class="category-tag"><a href="{{url('blog/cat/list',$cat->id)}}"><i class="fas fa-tag"></i> Hébergement</a></div>

             @endif
          @endforeach
        </div>
        <div class="blog-content" data-bg-src="{{asset('frontend/assets/img/shape/blog-bg.png')}}">
          {{-- <a class="blog-date" href="blog-details.html"><i class="far fa-calendar-alt "></i> July 21, 2023</a> --}}
          <h3 class="blog-title"><a href="blog-details.html">Hébergement typique.</a></h3>
          <p class="blog-text">Nous offrons aux voyageurs une approche autonome pour leur séjour, 
            qu'il s'agisse d'un campement, d'une résidence privée, d'une maison d'hôtes, d'un hôtel, voire même d'un hébergement solidaire.</p>
         
          @foreach ($bcategory as $cat)
          @if ($cat->category_slug == 'hébergement')
          <a class="vs-btn style4" href="{{url('blog/cat/list',$cat->id)}}">Voir Plus</a>
          


        @endif
     @endforeach
        </div>
      </div>
      <div class="blog-style4">
        <div class="blog-image">
          <img src="{{asset('frontend/assets/img/about/loc.jpg')}} " style="width: 1049px; height: 803px;" alt="blog image">
          <div class="category-tag"><a href="#"><i class="fas fa-tag"></i> Voitures</a></div>
        </div>
        <div class="blog-content" data-bg-src="assets/img/shape/blog-bg.png">
          {{-- <a class="blog-date" href="blog-details.html"><i class="far fa-calendar-alt "></i> July 21, 2023</a> --}}
          <h3 class="blog-title"><a href="blog-details.html">Location de Véhicules </a></h3>
          <p class="blog-text">Nous proposons une large gamme de véhicules incluant des bus, des minibus climatisés et des 4x4 pour vos excursions, circuits, transferts et autres événements...</p>
          <a class="vs-btn style4" href="{{route('vehicule')}}">Voir Plus</a>
        </div>
      </div>
    </div>
  </div>