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
      <div class="hero-slide hero-mask" data-bg-src=" {{asset('assets/img/banner/bgSNeCP.png')}} ">
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
      <div class="hero-slide hero-mask" data-bg-src=" {{asset('assets/img/banner/hero2-bg2.jpg')}} ">
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
      <div class="hero-slide hero-mask" data-bg-src=" {{asset('assets/img/banner/touriste.jpg')}} ">
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
@endif;


@if ($locale == 'fr')
<section class="hero-layout3" data-bg-src=" {{asset('assets/img/bg/bg-1.jpg')}} ">
  <div class="hero-mask">
    <div class="container">
      <div class="row align-items-center justify-content-start">
        <div class="col-lg-10">
          <div class="row">
            <div class="col-lg-7">
              <div class="hero-content">
                <span class="hero-subtitle">Agence local Sénégalaise </span>
                <h1 class="hero-title">Explorez le Sénegal avec des guides pationnés!</h1>
              </div>
            </div>
            <div class="col-lg-5">
              <div class="vs-carousel" id="hero-slider" data-slide-show="1" autoplay="false">
                <div class="hero-slide">
                  <div class="hero-img">
                    <img class="img1" src=" {{asset('assets/img/banner/hero-slide-1-1.jpg')}} " alt="hero">
                  </div>
                </div>
                <div class="hero-slide">
                  <div class="hero-img">
                    <img class="img1" src=" {{asset('assets/img/banner/hero-slide-1-2.jpg')}} " alt="hero">
                  </div>
                </div>
                <div class="hero-slide">
                  <div class="hero-img">
                    <img class="img1" src=" {{asset('assets/img/banner/hero-slide-1-3.jpg')}} " alt="hero">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
     
    </div>
    
  </div>
</section>
@endif;


@if ($locale == 'es')
<section class="hero-layout1">
  <div>
    <div class="vs-carousel hero-slider2" data-slide-show="1" data-fade="true">
      <div class="hero-slide hero-mask" data-bg-src=" {{asset('assets/img/banner/bgSNeCP.png')}} ">
        <div class="container">
          <div class="row align-items-center justify-content-between">
            <div class="col-lg-6">
              <div class="hero-content">
                {{-- <span class="hero-subtitle">Le Bureau du Guides shoot </span> --}}
                <h1 class="hero-title">Viajes a medida a Senegal con guías expertos</h1>
                {{-- <p class="hero-text">Découvrez la magie du Sénégal avec des guides locaux passionnés, prêts à vous faire vivre une expérience inoubliable.</p> --}}
                <a href="{{route('apropos')}}" class="vs-btn style4">Ver más</a>
              </div>
            </div>
           
          </div>
        </div>
      </div>
      <div class="hero-slide hero-mask" data-bg-src=" {{asset('assets/img/banner/hero2-bg2.jpg')}} ">
        <div class="container">
          <div class="row align-items-center justify-content-between">
            <div class="col-lg-6">
              <div class="hero-content">
                {{-- <span class="hero-subtitle">Bureau Du Guide</span> --}}
                <h1 class="hero-title">Intercambio cultural</h1>
                <p class="hero-text">Sumérjase en el corazón de la cultura senegalesa con nuestros guías expertos, para realizar visitas auténticas y enriquecedoras..</p>
                <a href="{{route('apropos')}}" class="vs-btn style4">Ver más</a>
              </div>
            </div>
       
          </div>
        </div>
      </div>
      <div class="hero-slide hero-mask" data-bg-src=" {{asset('assets/img/banner/touriste.jpg')}} ">
        <div class="container">
          <div class="row align-items-center justify-content-between">
            <div class="col-lg-6">
              <div class="hero-content">
                {{-- <span class="hero-subtitle">Bureau Du Guide</span> --}}
                <h1 class="hero-title">Explorar Senegal </h1>
                <p class="hero-text">Disfrute de una aventura a medida en Senegal con nuestros atentos guías, y déjese sorprender por la riqueza de nuestras tradiciones e historia.</p>
                <a href="{{route('apropos')}}" class="vs-btn style4">Ver más</a>
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
