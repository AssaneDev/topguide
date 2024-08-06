@php
  use Illuminate\Support\Facades\App;
  use Illuminate\Support\Facades\Session;
       $locale = Session::get('local') ?? 'fr';
        Session::put('local',$locale);
        App::setLocale($locale);

        
@endphp


@if ($locale == 'en')
     
<section class="hero-layout1">
  <div>
    <div class="vs-carousel hero-slider2" data-slide-show="1" data-fade="true">
      <div class="hero-slide hero-mask" data-bg-src=" {{asset('frontend/assets/img/banner/bgSNeCP.png')}} ">
        <div class="container">
          <div class="row align-items-center justify-content-between">
            <div class="col-lg-6">
              <div class="hero-content">
                {{-- <span class="hero-subtitle">Le Bureau du Guides shoot </span> --}}
                <h1 class="hero-title">Tailor-made trips to Senegal with expert guides</h1>
                {{-- <p class="hero-text">Découvrez la magie du Sénégal avec des guides locaux passionnés, prêts à vous faire vivre une expérience inoubliable.</p> --}}
                <a href="{{route('apropos')}}" class="vs-btn style4">Read More</a>
              </div>
            </div>
           
          </div>
        </div>
      </div>
      <div class="hero-slide hero-mask" data-bg-src=" {{asset('frontend/assets/img/banner/hero2-bg2.jpg')}} ">
        <div class="container">
          <div class="row align-items-center justify-content-between">
            <div class="col-lg-6">
              <div class="hero-content">
                {{-- <span class="hero-subtitle">Bureau Du Guide</span> --}}
                <h1 class="hero-title">Cultural inter-exchange</h1>
                <p class="hero-text">Immerse yourself in the heart of Senegalese culture with our expert guides, for authentic and enriching visits.</p>
                <a href="{{route('apropos')}}" class="vs-btn style4">Read More</a>
              </div>
            </div>
       
          </div>
        </div>
      </div>
      <div class="hero-slide hero-mask" data-bg-src=" {{asset('frontend/assets/img/banner/touriste.jpg')}} ">
        <div class="container">
          <div class="row align-items-center justify-content-between">
            <div class="col-lg-6">
              <div class="hero-content">
                {{-- <span class="hero-subtitle">Bureau Du Guide</span> --}}
                <h1 class="hero-title">Explore Senegal </h1>
                <p class="hero-text">Explore Senegal Experience a tailor-made adventure in Senegal with our attentive guides, and immerse yourself in the richness of our traditions and stories.</p>
                <a href="{{route('apropos')}}" class="vs-btn style4">Read More</a>
              </div>
            </div>
           
          </div>
        </div>
      </div>
    </div>
    <div>
      <button class="icon-btn prev-btn" data-slick-prev=".hero-slider2"><i class="fas fa-chevron-left"></i></button>
      <button class="icon-btn next-btn" data-slick-next=".hero-slider2"><i class="fas fa-chevron-right"></i></button>
    </div>
  </div>
</section>
@else 
<section class="hero-layout1">
  <div>
    <div class="vs-carousel hero-slider2" data-slide-show="1" data-fade="true">
      <div class="hero-slide hero-mask" data-bg-src=" {{asset('frontend/assets/img/banner/bgSNeCP.png')}} ">
        <div class="container">
          <div class="row align-items-center justify-content-between">
            <div class="col-lg-6">
              <div class="hero-content">
                {{-- <span class="hero-subtitle">Le Bureau du Guides shoot </span> --}}
                <h1 class="hero-title">Voyage sur mesure au Sénégal avec des guides expert</h1>
                {{-- <p class="hero-text">Découvrez la magie du Sénégal avec des guides locaux passionnés, prêts à vous faire vivre une expérience inoubliable.</p> --}}
                <a href="{{route('apropos')}}" class="vs-btn style4">Voir Plus</a>
              </div>
            </div>
           
          </div>
        </div>
      </div>
      <div class="hero-slide hero-mask" data-bg-src=" {{asset('frontend/assets/img/banner/hero2-bg2.jpg')}} ">
        <div class="container">
          <div class="row align-items-center justify-content-between">
            <div class="col-lg-6">
              <div class="hero-content">
                {{-- <span class="hero-subtitle">Bureau Du Guide</span> --}}
                <h1 class="hero-title">Inter-échange culturel</h1>
                <p class="hero-text">Plongez au cœur de la culture sénégalaise avec nos guides experts, pour des visites authentiques et enrichissantes.</p>
                <a href="{{route('apropos')}}" class="vs-btn style4">Voir plus</a>
              </div>
            </div>
       
          </div>
        </div>
      </div>
      <div class="hero-slide hero-mask" data-bg-src=" {{asset('frontend/assets/img/banner/touriste.jpg')}} ">
        <div class="container">
          <div class="row align-items-center justify-content-between">
            <div class="col-lg-6">
              <div class="hero-content">
                {{-- <span class="hero-subtitle">Bureau Du Guide</span> --}}
                <h1 class="hero-title">Explorez le Sénegal </h1>
                <p class="hero-text">Vivez une aventure sur mesure au Sénégal avec nos guides attentifs, et laissez-vous surprendre par la richesse de nos traditions et de notre histoire..</p>
                <a href="{{route('apropos')}}" class="vs-btn style4">Voir Plus</a>
              </div>
            </div>
           
          </div>
        </div>
      </div>
    </div>
    <div>
      <button class="icon-btn prev-btn" data-slick-prev=".hero-slider2"><i class="fas fa-chevron-left"></i></button>
      <button class="icon-btn next-btn" data-slick-next=".hero-slider2"><i class="fas fa-chevron-right"></i></button>
    </div>
  </div>
</section>

@endif;